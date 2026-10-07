/**
 * ATS Tekno — Machinery Fleet WebGL simulation (Three.js r128, UMD build).
 * Procedural, asset-free models: laser cutting, press-brake bending, turret punching,
 * guillotine shearing and a switchboard cabinet fallback. Exposes window.ATSFleetScene.create().
 */
(() => {
  'use strict';

  const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
  const lerp = (a, b, t) => a + (b - a) * t;
  const smooth = (a, b, x) => {
    const t = clamp((x - a) / (b - a), 0, 1);
    return t * t * (3 - 2 * t);
  };
  const easeOutCubic = t => 1 - Math.pow(1 - t, 3);

  const TITLES = {
    laser: 'FIBER LASER · NESTING PATH',
    bend: 'PRESS BRAKE · BEND SIMULATION',
    punch: 'TURRET PUNCH · TOOL SEQUENCE',
    shear: 'GUILLOTINE · SHEARING CYCLE',
    cabinet: 'SWITCHBOARD · ENCLOSURE SCAN',
    pickling: 'HCl PICKLING · RESIDUE REMOVAL',
    phosphate: 'LIME / PHOSPHATE · CONVERSION DIP',
    powder: 'ELECTROSTATIC POWDER · OVEN CURE',
    wiring: 'PANEL WIRING · LV ASSEMBLY',
  };

  // Camera framing per machine family
  const CAM = {
    laser: { az: 0.62, el: 0.64, r: 8.9, ty: 0.15 },
    bend: { az: 0.22, el: 0.36, r: 8.1, ty: 0.2 },
    punch: { az: 0.58, el: 0.7, r: 8.9, ty: 0.15 },
    shear: { az: 0.74, el: 0.46, r: 9.8, ty: 0.55 },
    cabinet: { az: 0.5, el: 0.26, r: 9.6, ty: 1.0 },
    pickling: { az: 0.55, el: 0.42, r: 10.4, ty: 1.2 },
    phosphate: { az: -0.5, el: 0.42, r: 10.4, ty: 1.2 },
    powder: { az: 0.42, el: 0.28, r: 11.6, ty: 1.1 },
    wiring: { az: 0.36, el: 0.16, r: 7.2, ty: 1.15 },
  };

  function create({ canvas, host, reduced, onHud, onLost }) {
    const T = window.THREE;
    if (!T || !canvas || !host) return null;

    let renderer;
    try {
      renderer = new T.WebGLRenderer({ canvas, antialias: true, alpha: true, powerPreference: 'high-performance' });
    } catch (e) {
      return null;
    }
    if (!renderer.getContext()) return null;

    const isMobile = typeof window !== 'undefined' && window.innerWidth < 768;
    const isLowSpec = typeof navigator !== 'undefined' && (
      (navigator.hardwareConcurrency && navigator.hardwareConcurrency <= 4) ||
      (navigator.deviceMemory && navigator.deviceMemory <= 4)
    );

    // Adaptive pixel ratio: 1.0 on mobile / budget devices, max 1.5 on desktop to keep GPU cool
    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, isMobile || isLowSpec ? 1.0 : 1.5));
    renderer.setClearColor(0x000000, 0);
    renderer.outputEncoding = T.sRGBEncoding;
    renderer.toneMapping = T.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.12;

    // Only enable expensive PCFSoft shadow maps on capable desktop hardware
    renderer.shadowMap.enabled = !reduced && !isMobile && !isLowSpec;
    if (renderer.shadowMap.enabled) {
      renderer.shadowMap.type = T.PCFSoftShadowMap;
    }

    const scene = new T.Scene();
    scene.fog = new T.Fog(0xf1f5f9, 14, 28);
    const camera = new T.PerspectiveCamera(34, 1, 0.1, 60);

    /* ---------- Textures ---------- */
    const dotTex = (() => {
      const c = document.createElement('canvas');
      c.width = c.height = 64;
      const x = c.getContext('2d');
      const g = x.createRadialGradient(32, 32, 0, 32, 32, 32);
      g.addColorStop(0, 'rgba(255,255,255,1)');
      g.addColorStop(0.25, 'rgba(255,255,255,.85)');
      g.addColorStop(0.6, 'rgba(255,255,255,.18)');
      g.addColorStop(1, 'rgba(255,255,255,0)');
      x.fillStyle = g;
      x.fillRect(0, 0, 64, 64);
      return new T.CanvasTexture(c);
    })();

    // Procedural studio environment (light soft boxes) -> crisp metallic reflections
    try {
      const c = document.createElement('canvas');
      c.width = 1024;
      c.height = 512;
      const x = c.getContext('2d');
      const g = x.createLinearGradient(0, 0, 0, 512);
      g.addColorStop(0, '#f8fafc');
      g.addColorStop(0.5, '#e2e8f0');
      g.addColorStop(1, '#cbd5e1');
      x.fillStyle = g;
      x.fillRect(0, 0, 1024, 512);
      try { x.filter = 'blur(16px)'; } catch (e) { /* Safari: sharp boxes are fine */ }
      const box = (px, py, w, h, col, al) => {
        x.globalAlpha = al;
        x.fillStyle = col;
        x.fillRect(px, py, w, h);
      };
      box(110, 60, 320, 130, '#ffffff', 0.95);
      box(610, 40, 260, 100, '#ffffff', 0.85);
      box(430, 250, 170, 46, '#ff4d6d', 0.65);
      box(860, 220, 110, 160, '#fed7aa', 0.5);
      box(0, 330, 1024, 20, '#94a3b8', 0.35);
      const tex = new T.CanvasTexture(c);
      tex.mapping = T.EquirectangularReflectionMapping;
      tex.encoding = T.sRGBEncoding;
      const pm = new T.PMREMGenerator(renderer);
      scene.environment = pm.fromEquirectangular(tex).texture;
      pm.dispose();
      tex.dispose();
    } catch (e) { /* environment is a nice-to-have */ }

    /* ---------- Lights ---------- */
    scene.add(new T.HemisphereLight(0xffffff, 0xcbd5e1, 0.9));
    const key = new T.DirectionalLight(0xffffff, 1.4);
    key.position.set(4, 7.5, 5);
    key.castShadow = true;
    key.shadow.mapSize.set(1024, 1024);
    key.shadow.camera.left = -5;
    key.shadow.camera.right = 5;
    key.shadow.camera.top = 5;
    key.shadow.camera.bottom = -5;
    key.shadow.camera.near = 0.5;
    key.shadow.camera.far = 24;
    key.shadow.bias = -0.0006;
    scene.add(key);
    const rim = new T.PointLight(0x0284c7, 1.1, 20);
    rim.position.set(-5.5, 2.8, -4.5);
    scene.add(rim);
    const glow = new T.PointLight(0xff4d4d, 0, 9);
    scene.add(glow);

    /* ---------- World ---------- */
    const world = new T.Group();
    world.position.set(0.45, 0.5, 0);
    scene.add(world);

    const FLOOR_Y = -0.92;
    const floor = new T.Mesh(
      new T.CircleGeometry(7.5, 72),
      new T.MeshStandardMaterial({ color: 0xf1f5f9, metalness: 0.1, roughness: 0.6 })
    );
    floor.rotation.x = -Math.PI / 2;
    floor.position.y = FLOOR_Y;
    floor.receiveShadow = true;
    world.add(floor);

    const grid = new T.GridHelper(15, 30, 0xe11d48, 0xcbd5e1);
    grid.position.y = FLOOR_Y + 0.004;
    grid.material.transparent = true;
    grid.material.opacity = 0.55;
    world.add(grid);

    const ringMat = new T.MeshBasicMaterial({ color: 0xe11d48, transparent: true, opacity: 0.5, depthWrite: false });
    const ring = new T.Mesh(new T.RingGeometry(3.6, 3.625, 128), ringMat);
    ring.rotation.x = -Math.PI / 2;
    ring.position.y = FLOOR_Y + 0.01;
    world.add(ring);
    const arc = new T.Mesh(new T.RingGeometry(4.15, 4.2, 96, 1, 0, Math.PI * 1.15), ringMat.clone());
    arc.rotation.x = -Math.PI / 2;
    arc.position.y = FLOOR_Y + 0.012;
    world.add(arc);

    /* ---------- Materials ---------- */
    const plateMat = new T.MeshStandardMaterial({ color: 0xc3ccd8, metalness: 0.78, roughness: 0.26 });
    const steelDark = new T.MeshStandardMaterial({ color: 0x2b3448, metalness: 0.85, roughness: 0.38 });
    const steelMid = new T.MeshStandardMaterial({ color: 0x4a566e, metalness: 0.8, roughness: 0.34 });
    const paintRed = new T.MeshStandardMaterial({ color: 0xe11d48, metalness: 0.35, roughness: 0.42 });
    const paintWhite = new T.MeshStandardMaterial({ color: 0xe8ecf3, metalness: 0.25, roughness: 0.5 });
    const kerfMat = new T.PointsMaterial({ size: 0.075, map: dotTex, color: 0x05080f, transparent: true, depthWrite: false, opacity: 0.95 });

    const shadowAll = (g) => g.traverse(o => {
      if (o.isMesh) { o.castShadow = true; o.receiveShadow = true; }
    });
    const box = (w, h, d, mat, x = 0, y = 0, z = 0) => {
      const m = new T.Mesh(new T.BoxGeometry(w, h, d), mat);
      m.position.set(x, y, z);
      return m;
    };

    /* ---------- Sparks ---------- */
    const SP = 280;
    const spPos = new Float32Array(SP * 3).fill(-100);
    const spVel = new Float32Array(SP * 3);
    const spLife = new Float32Array(SP);
    const spGeo = new T.BufferGeometry();
    spGeo.setAttribute('position', new T.BufferAttribute(spPos, 3));
    const sparks = new T.Points(spGeo, new T.PointsMaterial({
      size: 0.085, map: dotTex, color: 0xffb066, transparent: true, depthWrite: false, blending: T.AdditiveBlending,
    }));
    sparks.frustumCulled = false;
    world.add(sparks);
    let spPtr = 0;
    const emit = (x, y, z, n, speed = 2.2, up = 2.2) => {
      for (let i = 0; i < n; i++) {
        const k = spPtr++ % SP;
        const a = Math.random() * Math.PI * 2;
        const s = (0.35 + Math.random() * 0.9) * speed;
        spPos[k * 3] = x;
        spPos[k * 3 + 1] = y;
        spPos[k * 3 + 2] = z;
        spVel[k * 3] = Math.cos(a) * s;
        spVel[k * 3 + 1] = (0.5 + Math.random()) * up;
        spVel[k * 3 + 2] = Math.sin(a) * s;
        spLife[k] = 0.45 + Math.random() * 0.7;
      }
    };
    const updateSparks = (dt) => {
      for (let i = 0; i < SP; i++) {
        if (spLife[i] <= 0) continue;
        spLife[i] -= dt;
        if (spLife[i] <= 0) { spPos[i * 3 + 1] = -100; continue; }
        spVel[i * 3 + 1] -= 7 * dt;
        spPos[i * 3] += spVel[i * 3] * dt;
        spPos[i * 3 + 1] += spVel[i * 3 + 1] * dt;
        spPos[i * 3 + 2] += spVel[i * 3 + 2] * dt;
        if (spPos[i * 3 + 1] < FLOOR_Y) { spVel[i * 3 + 1] *= -0.25; spPos[i * 3 + 1] = FLOOR_Y; }
      }
      spGeo.attributes.position.needsUpdate = true;
    };

    // Ambient dust
    const DU = 240;
    const duPos = new Float32Array(DU * 3);
    for (let i = 0; i < DU; i++) {
      duPos[i * 3] = (Math.random() - 0.5) * 13;
      duPos[i * 3 + 1] = FLOOR_Y + Math.random() * 5.5;
      duPos[i * 3 + 2] = (Math.random() - 0.5) * 13;
    }
    const duGeo = new T.BufferGeometry();
    duGeo.setAttribute('position', new T.BufferAttribute(duPos, 3));
    const dust = new T.Points(duGeo, new T.PointsMaterial({ size: 0.035, map: dotTex, color: 0x94a3b8, transparent: true, opacity: 0.15, depthWrite: false }));
    dust.frustumCulled = false;
    world.add(dust);

    /* ---------- Shared builders ---------- */
    const makeTable = (w = 4.7, d = 3.3) => {
      const g = new T.Group();
      g.add(box(w, 0.2, d, steelDark, 0, -0.13, 0));
      const lx = w / 2 - 0.15, lz = d / 2 - 0.15, lh = 0.8;
      [[-1, -1], [1, -1], [-1, 1], [1, 1]].forEach(([sx, sz]) => {
        g.add(box(0.2, lh, 0.2, steelMid, sx * lx, -0.23 - lh / 2, sz * lz));
      });
      g.add(box(w - 0.5, 0.08, 0.1, steelMid, 0, -0.55, lz));
      g.add(box(w - 0.5, 0.08, 0.1, steelMid, 0, -0.55, -lz));
      return g;
    };

    const strokeRoundedRect = (cx, cz, w, d, r, step = 0.035) => {
      const pts = [];
      const hw = w / 2, hd = d / 2;
      const seg = (ax, az, bx, bz) => {
        const len = Math.hypot(bx - ax, bz - az);
        const k = Math.max(1, Math.round(len / step));
        for (let i = 0; i < k; i++) { const u = i / k; pts.push([ax + (bx - ax) * u, az + (bz - az) * u]); }
      };
      const arcPts = (ox, oz, a0, a1) => {
        const len = Math.abs(a1 - a0) * r;
        const k = Math.max(2, Math.round(len / step));
        for (let i = 0; i < k; i++) { const a = a0 + (a1 - a0) * i / k; pts.push([ox + Math.cos(a) * r, oz + Math.sin(a) * r]); }
      };
      seg(cx - hw + r, cz - hd, cx + hw - r, cz - hd); arcPts(cx + hw - r, cz - hd + r, -Math.PI / 2, 0);
      seg(cx + hw, cz - hd + r, cx + hw, cz + hd - r); arcPts(cx + hw - r, cz + hd - r, 0, Math.PI / 2);
      seg(cx + hw - r, cz + hd, cx - hw + r, cz + hd); arcPts(cx - hw + r, cz + hd - r, Math.PI / 2, Math.PI);
      seg(cx - hw, cz + hd - r, cx - hw, cz - hd + r); arcPts(cx - hw + r, cz - hd + r, Math.PI, Math.PI * 1.5);
      pts.push(pts[0]);
      return pts;
    };
    const strokeCircle = (cx, cz, r, step = 0.035) => {
      const k = Math.max(14, Math.round(2 * Math.PI * r / step));
      const pts = [];
      for (let i = 0; i <= k; i++) { const a = i / k * Math.PI * 2; pts.push([cx + Math.cos(a) * r, cz + Math.sin(a) * r]); }
      return pts;
    };

    const fmt = (v, d = 0) => (Number.isFinite(v) ? v : 0).toFixed(d).padStart(d ? 6 : 4, '\u00a0');

    // The glow light lives in the scene root, so convert model-local coordinates into world space.
    const setGlow = (x, y, z, intensity) => {
      glow.position.set(x + world.position.x, y + world.position.y, z);
      glow.intensity = intensity;
    };

    /* ====================== MODEL: LASER ====================== */
    function buildLaser() {
      const g = new T.Group();
      g.add(makeTable());
      const plateW = 4.1, plateD = 2.8;
      g.add(box(plateW, 0.06, plateD, plateMat));

      const strokes = [
        strokeCircle(-1.1, 0, 0.5),
        strokeCircle(0.1, -0.72, 0.17),
        strokeCircle(0.1, 0, 0.17),
        strokeCircle(0.1, 0.72, 0.17),
        strokeRoundedRect(1.2, 0, 1.0, 0.38, 0.19),
        strokeRoundedRect(0, 0, 3.7, 2.45, 0.28),
      ];
      const px = [], pz = [];
      strokes.forEach(s => s.forEach(p => { px.push(p[0]); pz.push(p[1]); }));
      const N = px.length;

      const kPos = new Float32Array(N * 3);
      for (let i = 0; i < N; i++) { kPos[i * 3] = px[i]; kPos[i * 3 + 1] = 0.036; kPos[i * 3 + 2] = pz[i]; }
      const kGeo = new T.BufferGeometry();
      kGeo.setAttribute('position', new T.BufferAttribute(kPos, 3));
      kGeo.setDrawRange(0, 0);
      const kerf = new T.Points(kGeo, kerfMat.clone());
      kerf.frustumCulled = false;
      g.add(kerf);

      const GL = 46;
      const gPos = new Float32Array(GL * 3);
      const gCol = new Float32Array(GL * 3);
      const gGeo = new T.BufferGeometry();
      gGeo.setAttribute('position', new T.BufferAttribute(gPos, 3));
      gGeo.setAttribute('color', new T.BufferAttribute(gCol, 3));
      const heat = new T.Points(gGeo, new T.PointsMaterial({
        size: 0.15, map: dotTex, vertexColors: true, transparent: true, depthWrite: false, blending: T.AdditiveBlending,
      }));
      heat.frustumCulled = false;
      g.add(heat);

      // Gantry + head
      const gantry = new T.Group();
      g.add(gantry);
      const railZ = plateD / 2 + 0.28;
      [-1, 1].forEach(s => g.add(box(plateW + 0.8, 0.14, 0.16, steelMid, 0, 1.25, s * railZ)));
      [-1, 1].forEach(s => [-1, 1].forEach(t => g.add(box(0.16, 2.2, 0.16, steelDark, s * (plateW / 2 + 0.3), 0.15, t * railZ))));
      gantry.add(box(0.2, 0.18, plateD + 0.7, paintWhite, 0, 1.25, 0));
      const head = new T.Group();
      head.add(box(0.34, 0.34, 0.34, paintRed, 0, 1.25, 0));
      const nozzle = new T.Mesh(new T.CylinderGeometry(0.09, 0.03, 0.32, 18), steelDark);
      nozzle.position.y = 1.0;
      head.add(nozzle);
      gantry.add(head);
      shadowAll(g);

      const beam = new T.Mesh(
        new T.CylinderGeometry(0.014, 0.014, 1, 8),
        new T.MeshBasicMaterial({ color: 0xff3b3b, transparent: true, opacity: 0.95, blending: T.AdditiveBlending, depthWrite: false })
      );
      g.add(beam);
      const halo = new T.Sprite(new T.SpriteMaterial({ map: dotTex, color: 0xff6a4a, transparent: true, blending: T.AdditiveBlending, depthWrite: false }));
      halo.scale.set(0.6, 0.6, 0.6);
      g.add(halo);
      const core = new T.Sprite(new T.SpriteMaterial({ map: dotTex, color: 0xfff3da, transparent: true, blending: T.AdditiveBlending, depthWrite: false }));
      core.scale.set(0.22, 0.22, 0.22);
      g.add(core);

      const CYCLE = 9.2;
      let hx = px[0], hz = pz[0], on = false;

      return {
        group: g,
        update(t, dt) {
          const c = (t % CYCLE) / CYCLE;
          const draw = clamp(c / 0.84, 0, 1);
          const k = Math.floor(draw * N);
          const fade = 1 - smooth(0.93, 0.99, c);
          kerf.material.opacity = 0.95 * (c < 0.93 ? 1 : fade);
          kGeo.setDrawRange(0, c > 0.99 ? 0 : k);
          on = c < 0.84 && k > 0;

          const idx = clamp(k - 1, 0, N - 1);
          hx = px[idx];
          hz = pz[idx];
          const retract = smooth(0.84, 0.92, c);
          const tx = lerp(hx, 0, retract), tz = lerp(hz, 0, retract);
          gantry.position.x = tx;
          head.position.z = tz;

          const headY = 0.84; // nozzle tip
          beam.visible = on;
          beam.scale.y = headY - 0.04;
          beam.position.set(hx, 0.04 + (headY - 0.04) / 2, hz);
          halo.visible = core.visible = on;
          halo.position.set(hx, 0.07, hz);
          core.position.set(hx, 0.07, hz);
          halo.material.opacity = 0.75 + Math.sin(t * 50) * 0.2;

          // follow head to contact point while cutting
          gantry.position.x = on ? hx : tx;
          head.position.z = on ? hz : tz;

          if (on) {
            emit(hx, 0.07, hz, Math.max(1, Math.round(dt * 160)), 1.6, 2.6);
            setGlow(hx, 0.45, hz, 2.6 + Math.sin(t * 40) * 0.6);
          }

          for (let i = 0; i < GL; i++) {
            const j = clamp(k - 1 - (GL - 1 - i), 0, N - 1);
            const age = (GL - 1 - i) / GL;
            gPos[i * 3] = px[j];
            gPos[i * 3 + 1] = 0.05;
            gPos[i * 3 + 2] = pz[j];
            const lvl = on ? Math.pow(1 - age, 2.2) : 0;
            gCol[i * 3] = lvl;
            gCol[i * 3 + 1] = lvl * (0.25 + 0.55 * (1 - age));
            gCol[i * 3 + 2] = lvl * 0.12 * (1 - age);
          }
          gGeo.attributes.position.needsUpdate = true;
          gGeo.attributes.color.needsUpdate = true;
        },
        hud() {
          return [
            ['X-AXIS', on ? `${fmt((hx + plateW / 2) / plateW * 1250, 1)} mm` : '— — —'],
            ['Y-AXIS', on ? `${fmt((hz + plateD / 2) / plateD * 2500, 1)} mm` : '— — —'],
            ['BEAM', on ? 'ON · 1.5 kW' : 'STANDBY'],
          ];
        },
      };
    }

    /* ====================== MODEL: PRESS BRAKE ====================== */
    function buildBend() {
      const g = new T.Group();
      const th = 0.09, leftW = 2.55, flW = 1.45, depth = 2.6, hingeX = 0.55;

      // V-die (two blocks + base)
      g.add(box(2.4, 0.72, 2.95, steelMid, hingeX - 0.28 - 1.2, -0.045 - 0.36, 0));
      g.add(box(1.5, 0.72, 2.95, steelMid, hingeX + 0.28 + 0.75, -0.045 - 0.36, 0));
      g.add(box(4.9, 0.18, 3.2, steelDark, -0.05, -0.92 + 0.09 + 0.01, 0));
      g.add(box(0.6, 1.8, 3.2, steelDark, -2.65, 0.0, 0));
      g.add(box(0.6, 1.8, 3.2, steelDark, 2.65, 0.0, 0));

      const plate = new T.Group();
      const left = box(leftW, th, depth, plateMat, hingeX - leftW / 2, 0, 0);
      plate.add(left);
      const hinge = new T.Group();
      hinge.position.set(hingeX, 0, 0);
      hinge.add(box(flW, th, depth, plateMat, flW / 2, 0, 0));
      plate.add(hinge);
      g.add(plate);

      // Punch blade (extruded profile)
      const sh = new T.Shape();
      sh.moveTo(-0.14, 0); sh.lineTo(0.14, 0); sh.lineTo(0.14, 0.28);
      sh.lineTo(0.5, 0.6); sh.lineTo(0.5, 1.3); sh.lineTo(-0.5, 1.3); sh.lineTo(-0.5, 0.6); sh.lineTo(-0.14, 0.28);
      sh.closePath();
      const pg = new T.ExtrudeGeometry(sh, { depth: 2.9, bevelEnabled: false });
      pg.translate(0, 0, -1.45);
      const punch = new T.Mesh(pg, paintRed);
      g.add(punch);
      const ram = box(1.4, 0.9, 3.0, steelDark, 0, 0, 0);
      g.add(ram);
      shadowAll(g);

      const CYCLE = 7.4;
      let theta = 0, force = 0, stroke = 0;

      return {
        group: g,
        update(t) {
          const c = (t % CYCLE) / CYCLE;
          const a = smooth(0.12, 0.3, c) * (1 - smooth(0.74, 0.9, c));
          const bend = smooth(0.3, 0.64, c) * (1 - smooth(0.9, 0.99, c));
          const over = 1 + 0.05 * smooth(0.55, 0.64, c) * (1 - smooth(0.72, 0.82, c));
          const spring = 0.04 * smooth(0.74, 0.84, c);
          theta = Math.max(0, (Math.PI / 2) * bend * over - spring * bend);
          const dip = smooth(0.3, 0.46, c) * (1 - smooth(0.7, 0.76, c));
          plate.position.y = -0.07 * dip;
          hinge.rotation.z = theta;
          const punchY = lerp(1.55, 0.05, a) - 0.07 * dip;
          punch.position.set(hingeX - 0.14, punchY, 0);
          ram.position.set(hingeX - 0.14, punchY + 1.75, 0);
          force = a * (0.35 + 0.65 * bend);
          stroke = (1.55 - punchY) / 1.5;
        },
        hud() {
          return [
            ['BEND ANGLE', `${fmt(theta * 180 / Math.PI, 1)}°`],
            ['FORCE', `${fmt(force * 10, 1)} T`],
            ['RAM STROKE', `${fmt(stroke * 100, 0)} %`],
          ];
        },
      };
    }

    /* ====================== MODEL: TURRET PUNCH ====================== */
    function buildPunch() {
      const g = new T.Group();
      g.add(makeTable());
      const plateW = 3.9, plateD = 2.7;
      const plate = box(plateW, 0.06, plateD, plateMat);
      g.add(plate);

      const dummy = new T.Object3D();
      const holeMat = new T.MeshBasicMaterial({ color: 0x04070d });
      const holeGeo = new T.CircleGeometry(0.13, 28);
      holeGeo.rotateX(-Math.PI / 2);
      const slotGeo = new T.PlaneGeometry(0.62, 0.075);
      slotGeo.rotateX(-Math.PI / 2);

      const hits = [];
      for (let r = 0; r < 2; r++) for (let c = 0; c < 4; c++) hits.push({ x: -1.4 + c * 0.42, z: -0.62 + r * 0.46, slot: false });
      for (let i = 0; i < 6; i++) hits.push({ x: 0.9, z: -0.85 + i * 0.34, slot: true });
      for (let c = 0; c < 3; c++) hits.push({ x: -1.15 + c * 0.55, z: 0.82, slot: false });
      const HN = hits.length;
      const holes = new T.InstancedMesh(holeGeo, holeMat, HN);
      const slots = new T.InstancedMesh(slotGeo, holeMat, HN);
      holes.frustumCulled = slots.frustumCulled = false;
      g.add(holes, slots);
      const zero = new T.Matrix4().makeScale(0, 0, 0);
      for (let i = 0; i < HN; i++) { holes.setMatrixAt(i, zero); slots.setMatrixAt(i, zero); }

      // Turret tool head
      const tool = new T.Group();
      tool.add(box(1.0, 0.7, 1.0, paintRed, 0, 1.3, 0));
      const stripper = new T.Mesh(new T.CylinderGeometry(0.28, 0.28, 0.14, 24), steelMid);
      stripper.position.y = 0.42;
      tool.add(stripper);
      const rod = new T.Mesh(new T.CylinderGeometry(0.1, 0.12, 1.0, 20), steelDark);
      rod.position.y = 0.8;
      tool.add(rod);
      g.add(tool);
      g.add(box(plateW + 0.9, 0.16, 0.2, steelMid, 0, 1.6, -plateD / 2 - 0.35));
      g.add(box(0.5, 2.5, 0.5, steelDark, plateW / 2 + 0.55, 0.3, -plateD / 2 - 0.35));
      g.add(box(0.5, 2.5, 0.5, steelDark, -plateW / 2 - 0.55, 0.3, -plateD / 2 - 0.35));
      shadowAll(g);

      const STEP = 0.55, HOLD = 1.6;
      const CYCLE = HN * STEP + HOLD + 0.8;
      let done = 0, force = 0, station = 1;
      const drawn = new Array(HN).fill(0);
      let tx = hits[0].x, tz = hits[0].z;

      return {
        group: g,
        update(t, dt) {
          const tc = t % CYCLE;
          const active = Math.min(HN - 1, Math.floor(tc / STEP));
          const inCut = tc < HN * STEP;
          const lp = inCut ? (tc % STEP) / STEP : 0;
          const h = hits[active];
          const prev = hits[Math.max(0, active - 1)];
          const travel = smooth(0, 0.3, lp);
          tx = inCut ? lerp(prev.x, h.x, travel) : tx;
          tz = inCut ? lerp(prev.z, h.z, travel) : tz;
          const stamp = inCut ? Math.sin(smooth(0.34, 0.62, lp) * Math.PI) : 0;
          tool.position.set(tx, -0.32 + (1 - stamp) * 0.4 + (inCut ? 0 : 0.4), tz);
          force = stamp;
          station = (active % 8) + 1;

          done = inCut ? active + (lp > 0.5 ? 1 : 0) : HN;
          const fadeOut = tc > HN * STEP + HOLD ? 1 - smooth(HN * STEP + HOLD, CYCLE, tc) : 1;

          for (let i = 0; i < HN; i++) {
            const should = i < done ? 1 : 0;
            const target = should * fadeOut;
            if (drawn[i] < target) drawn[i] = Math.min(target, drawn[i] + dt * 7);
            else if (drawn[i] > target) drawn[i] = Math.max(target, drawn[i] - dt * 4);
            const s = easeOutCubic(drawn[i]);
            dummy.position.set(hits[i].x, 0.034, hits[i].z);
            dummy.scale.setScalar(Math.max(0.0001, s));
            dummy.updateMatrix();
            (hits[i].slot ? slots : holes).setMatrixAt(i, dummy.matrix);
            if (hits[i].slot) holes.setMatrixAt(i, zero); else slots.setMatrixAt(i, zero);
          }
          holes.instanceMatrix.needsUpdate = true;
          slots.instanceMatrix.needsUpdate = true;

          if (inCut && lp > 0.5 && lp < 0.5 + dt / STEP * 1.2) {
            emit(h.x, 0.06, h.z, 14, 1.4, 1.8);
            setGlow(h.x, 0.5, h.z, 3);
          }
          plate.position.y = inCut && lp > 0.5 && lp < 0.62 ? -0.012 : 0;
        },
        hud() {
          return [
            ['HIT COUNT', `${String(Math.min(done, HN)).padStart(2, '0')} / ${HN}`],
            ['TOOL STATION', `T${String(station).padStart(2, '0')}`],
            ['PUNCH FORCE', `${fmt(force * 40, 0)} T`],
          ];
        },
      };
    }

    /* ====================== MODEL: GUILLOTINE SHEAR ====================== */
    function buildShear() {
      const g = new T.Group();
      g.add(makeTable(5.0, 3.6));
      const plateW = 4.2, halfD = 1.4;
      const back = box(plateW, 0.07, halfD, plateMat, 0, 0, -halfD / 2 - 0.02);
      const frontPivot = new T.Group();
      frontPivot.position.set(0, 0, 0.02);
      const front = box(plateW, 0.07, halfD, plateMat, 0, 0, halfD / 2);
      frontPivot.add(front);
      g.add(back, frontPivot);

      g.add(box(4.8, 0.16, 0.16, steelMid, 0, -0.07, 0));
      const blade = new T.Group();
      const bladeMesh = box(4.8, 0.9, 0.09, paintRed, 0, 0.45, -0.08);
      bladeMesh.rotation.z = 0.0;
      blade.add(bladeMesh);
      blade.add(box(5.0, 0.55, 0.45, steelDark, 0, 1.15, -0.08));
      blade.rotation.x = -0.03;
      g.add(blade);
      g.add(box(0.7, 2.7, 1.5, steelDark, -2.75, 0.5, -0.35));
      g.add(box(0.7, 2.7, 1.5, steelDark, 2.75, 0.5, -0.35));
      g.add(box(6.2, 0.45, 1.6, steelDark, 0, 1.95, -0.35));

      const clamps = [];
      for (let i = 0; i < 6; i++) {
        const c = new T.Mesh(new T.CylinderGeometry(0.1, 0.1, 0.6, 16), steelMid);
        c.position.set(-1.85 + i * 0.74, 0.7, 0.62);
        g.add(c);
        clamps.push(c);
      }
      shadowAll(g);

      const CYCLE = 6.8;
      let by = 1.2, clampF = 0;

      return {
        group: g,
        update(t, dt) {
          const c = (t % CYCLE) / CYCLE;
          const clampDown = smooth(0.1, 0.2, c) * (1 - smooth(0.82, 0.9, c));
          clamps.forEach(m => { m.position.y = lerp(0.82, 0.38, clampDown); });
          clampF = clampDown;
          const down = smooth(0.24, 0.46, c);
          const up = smooth(0.62, 0.8, c);
          by = lerp(1.2, -0.05, down) + up * 1.25;
          blade.position.y = by;
          const drop = smooth(0.4, 0.58, c) * (1 - smooth(0.88, 0.97, c));
          frontPivot.position.z = 0.02 + drop * 0.5;
          frontPivot.position.y = -drop * 0.18;
          frontPivot.rotation.x = drop * 0.16;
          if (c > 0.4 && c < 0.4 + dt / CYCLE * 1.4) {
            emit(0, 0.06, 0, 18, 2.2, 1.6);
            setGlow(0, 0.4, 0, 2.4);
          }
        },
        hud() {
          return [
            ['BLADE TRAVEL', `${fmt(clamp((1.2 - by) / 1.25, 0, 1) * 100, 0)} %`],
            ['HOLD-DOWN', `${fmt(clampF * 62, 0)} kN`],
            ['CUT LENGTH', '3.0 m'],
          ];
        },
      };
    }

    /* ====================== MODEL: CABINET (fallback) ====================== */
    function buildCabinet() {
      const g = new T.Group();
      const body = box(1.7, 2.6, 0.9, paintWhite, 0, 0.4, 0);
      g.add(body);
      const doorL = box(0.82, 2.4, 0.04, paintWhite, -0.42, 0.4, 0.47);
      const doorR = box(0.82, 2.4, 0.04, paintWhite, 0.42, 0.4, 0.47);
      g.add(doorL, doorR);
      for (let i = 0; i < 9; i++) g.add(box(0.5, 0.025, 0.02, steelDark, -0.42, -0.62 + i * 0.07, 0.5));
      g.add(box(0.04, 0.34, 0.05, steelDark, -0.04, 0.4, 0.52));
      g.add(box(0.04, 0.34, 0.05, steelDark, 0.04, 0.4, 0.52));
      const edges = new T.LineSegments(
        new T.EdgesGeometry(new T.BoxGeometry(1.75, 2.65, 0.95)),
        new T.LineBasicMaterial({ color: 0xe11d48, transparent: true, opacity: 0.9 })
      );
      edges.position.set(0, 0.4, 0);
      g.add(edges);
      const base = box(1.9, 0.12, 1.1, steelDark, 0, -0.96 + 0.06, 0);
      g.add(base);
      const scan = new T.Mesh(
        new T.PlaneGeometry(2.4, 1.4),
        new T.MeshBasicMaterial({ color: 0xff3355, transparent: true, opacity: 0.22, side: T.DoubleSide, blending: T.AdditiveBlending, depthWrite: false })
      );
      scan.rotation.x = -Math.PI / 2;
      g.add(scan);
      shadowAll(g);
      let z = 0;
      return {
        group: g,
        update(t) {
          g.rotation.y = t * 0.35;
          const c = (t % 4.5) / 4.5;
          scan.position.y = lerp(-0.9, 1.8, c);
          z = scan.position.y;
          edges.material.opacity = 0.55 + Math.sin(t * 3) * 0.35;
        },
        hud() {
          return [['SCAN PLANE', `${fmt((z + 0.9) * 1000, 0)} mm`], ['MODEL', 'LV SWITCHBOARD'], ['STATUS', 'NOMINAL']];
        },
      };
    }

    /* ====================== PROCESS-LINE HELPERS ====================== */
    const tankMat = new T.MeshStandardMaterial({ color: 0x334155, metalness: 0.35, roughness: 0.55 });
    const copperMat = new T.MeshStandardMaterial({ color: 0xc8793a, metalness: 0.9, roughness: 0.28 });
    const blackMat = new T.MeshStandardMaterial({ color: 0x1f2937, metalness: 0.2, roughness: 0.55 });
    const greyMat = new T.MeshStandardMaterial({ color: 0x9ca3af, metalness: 0.15, roughness: 0.6 });
    const pad2 = n => String(n).padStart(2, '0');
    const rnd = () => Math.random() - 0.5;

    // Small particle pool with normal blending (additive glow is invisible on the light studio background)
    function makeFx(count, color, size, opacity) {
      const pos = new Float32Array(count * 3).fill(-100);
      const vel = new Float32Array(count * 3);
      const life = new Float32Array(count);
      const geo = new T.BufferGeometry();
      geo.setAttribute('position', new T.BufferAttribute(pos, 3));
      const points = new T.Points(geo, new T.PointsMaterial({ size, map: dotTex, color, transparent: true, opacity, depthWrite: false }));
      points.frustumCulled = false;
      let ptr = 0, acc = 0;
      const spawn = (x, y, z, vx, vy, vz, l) => {
        const k = ptr++ % count;
        pos[k * 3] = x; pos[k * 3 + 1] = y; pos[k * 3 + 2] = z;
        vel[k * 3] = vx; vel[k * 3 + 1] = vy; vel[k * 3 + 2] = vz;
        life[k] = l;
      };
      return {
        points,
        spawn,
        // emit `rate` particles per second using a fractional accumulator
        emitRate(rate, dt, fn) {
          acc += rate * dt;
          while (acc >= 1) { acc -= 1; fn(spawn); }
        },
        update(dt, g = 0, minY = -Infinity, maxY = Infinity, minZ = -Infinity) {
          for (let i = 0; i < count; i++) {
            if (life[i] <= 0) continue;
            life[i] -= dt;
            vel[i * 3 + 1] -= g * dt;
            pos[i * 3] += vel[i * 3] * dt;
            pos[i * 3 + 1] += vel[i * 3 + 1] * dt;
            pos[i * 3 + 2] += vel[i * 3 + 2] * dt;
            const y = pos[i * 3 + 1];
            if (life[i] <= 0 || y < minY || y > maxY || pos[i * 3 + 2] < minZ) { life[i] = 0; pos[i * 3 + 1] = -100; }
          }
          geo.attributes.position.needsUpdate = true;
        },
      };
    }

    // Enclosure door panel hanging from a spreader bar + sling. Local y=0 is the hook; panel spans y -0.15 .. -1.15.
    function makeHungPart(mat) {
      const p = new T.Group();
      p.add(box(1.7, 1.0, 0.05, mat, 0, -0.65, 0));
      p.add(box(0.05, 1.0, 0.24, mat, -0.85, -0.65, -0.1));
      p.add(box(0.05, 1.0, 0.24, mat, 0.85, -0.65, -0.1));
      p.add(box(1.7, 0.05, 0.24, mat, 0, -0.15, -0.1));
      p.add(box(2.0, 0.06, 0.06, steelDark, 0, 0, 0));
      [-0.7, 0.7].forEach(x => p.add(box(0.025, 0.15, 0.025, steelDark, x, -0.075, 0)));
      [-1, 1].forEach(s => {
        const sling = new T.Mesh(new T.CylinderGeometry(0.012, 0.012, 0.7826, 6), steelDark);
        sling.position.set(s * 0.35, 0.175, 0);
        sling.rotation.z = -s * 1.107;
        p.add(sling);
      });
      return p;
    }

    /* ====================== MODEL: CHEMICAL DIP TANK (pickling / phosphate) ====================== */
    function buildDip(cfg) {
      const g = new T.Group();
      const TW = 3.0, TD = 1.7, TH = 1.6, WT = 0.08;
      const BOT = FLOOR_Y, TOP = FLOOR_Y + TH, LIQ0 = TOP - 0.16;

      g.add(box(TW + WT * 2, WT, TD + WT * 2, tankMat, 0, BOT + WT / 2, 0));
      g.add(box(WT, TH, TD + WT * 2, tankMat, -TW / 2 - WT / 2, BOT + TH / 2, 0));
      g.add(box(WT, TH, TD + WT * 2, tankMat, TW / 2 + WT / 2, BOT + TH / 2, 0));
      g.add(box(TW, TH, WT, tankMat, 0, BOT + TH / 2, -TD / 2 - WT / 2));
      const rimMat = new T.MeshStandardMaterial({ color: cfg.rim, metalness: 0.3, roughness: 0.45 });
      g.add(box(TW + WT * 2 + 0.08, 0.07, 0.1, rimMat, 0, TOP + 0.035, TD / 2 + WT / 2));
      g.add(box(TW + WT * 2 + 0.08, 0.07, 0.1, rimMat, 0, TOP + 0.035, -TD / 2 - WT / 2));
      g.add(box(0.1, 0.07, TD + WT * 2, rimMat, -TW / 2 - WT / 2, TOP + 0.035, 0));
      g.add(box(0.1, 0.07, TD + WT * 2, rimMat, TW / 2 + WT / 2, TOP + 0.035, 0));

      if (cfg.heater) {
        [-0.5, 0, 0.5].forEach(z => {
          const coil = new T.Mesh(new T.CylinderGeometry(0.035, 0.035, TW - 0.3, 12), copperMat);
          coil.rotation.z = Math.PI / 2;
          coil.position.set(0, BOT + 0.2, z);
          g.add(coil);
        });
      }

      // Hoist gantry
      const BEAM = 2.95;
      [-1, 1].forEach(s => {
        g.add(box(0.16, BEAM - FLOOR_Y, 0.16, steelDark, s * 2.95, (BEAM + FLOOR_Y) / 2, 0));
        g.add(box(0.5, 0.06, 0.5, steelDark, s * 2.95, FLOOR_Y + 0.03, 0));
      });
      g.add(box(6.2, 0.2, 0.22, paintWhite, 0, BEAM, 0));
      const trolley = new T.Group();
      trolley.add(box(0.55, 0.28, 0.4, paintRed, 0, BEAM - 0.24, 0));
      g.add(trolley);
      const cable = new T.Mesh(new T.CylinderGeometry(0.014, 0.014, 1, 6), steelDark);
      g.add(cable);

      const partMat = new T.MeshStandardMaterial({ color: cfg.from, metalness: cfg.fromMetal, roughness: cfg.fromRough });
      const part = makeHungPart(partMat);
      g.add(part);
      shadowAll(g);

      // Translucent front wall + liquid so the immersed panel stays visible
      const frontMat = new T.MeshStandardMaterial({ color: cfg.liquid, transparent: true, opacity: 0.3, metalness: 0.1, roughness: 0.2, depthWrite: false });
      g.add(box(TW, TH, WT, frontMat, 0, BOT + TH / 2, TD / 2 + WT / 2));
      const liqH = LIQ0 - (BOT + WT);
      const liqMat = new T.MeshStandardMaterial({ color: cfg.liquid, transparent: true, opacity: cfg.opacity, metalness: 0.05, roughness: 0.12, depthWrite: false });
      const liquid = new T.Mesh(new T.BoxGeometry(TW - 0.02, liqH, TD - 0.02), liqMat);
      g.add(liquid);

      const bubbles = makeFx(160, cfg.bubble, 0.07, 0.85);
      const vapor = makeFx(70, cfg.vapor, 0.42, cfg.vaporOpacity);
      const drips = makeFx(80, cfg.liquid, 0.06, 0.9);
      g.add(bubbles.points, vapor.points, drips.points);

      const CYCLE = cfg.cycle, UP = 2.1, DOWN = 0.35;
      const c0 = new T.Color(cfg.from), c1 = new T.Color(cfg.to);
      let prog = 0, sub = 0, x = -1.6, hookY = UP;

      return {
        group: g,
        still: CYCLE * 0.5,
        update(t, dt) {
          const c = (t % CYCLE) / CYCLE;
          const lower = smooth(0.14, 0.3, c), raise = smooth(0.66, 0.8, c);
          hookY = lerp(UP, DOWN, lower) + (UP - DOWN) * raise;
          const agitate = smooth(0.3, 0.36, c) * (1 - smooth(0.6, 0.66, c));
          x = lerp(-1.6, 0, smooth(0, 0.14, c)) + lerp(0, 1.6, smooth(0.88, 1, c)) + Math.sin(t * 2.6) * 0.1 * agitate;
          const pop = smooth(0, 0.05, c) * (1 - smooth(0.95, 1, c));
          part.scale.setScalar(Math.max(0.001, pop));
          part.position.set(x, hookY, 0);
          trolley.position.x = x;
          const cTop = BEAM - 0.38, cBot = hookY + 0.35;
          cable.scale.y = Math.max(0.01, cTop - cBot);
          cable.position.set(x, (cTop + cBot) / 2, 0);

          prog = smooth(0.32, 0.64, c);
          partMat.color.copy(c0).lerp(c1, prog);
          partMat.roughness = lerp(cfg.fromRough, cfg.toRough, prog);
          partMat.metalness = lerp(cfg.fromMetal, cfg.toMetal, prog);

          const bottom = hookY - 1.15;
          sub = clamp((LIQ0 - bottom) / 1.0, 0, 1);
          const lvlH = liqH + 0.05 * sub; // displacement raises the level
          liquid.scale.y = lvlH / liqH;
          liquid.position.set(0, BOT + WT + lvlH / 2, 0);
          const LIQ = BOT + WT + lvlH;

          bubbles.emitRate(cfg.bubbleRate * (0.12 + sub), dt, sp => {
            if (sub > 0.1 && Math.random() < 0.75) {
              sp(x + rnd() * 1.7, lerp(Math.max(bottom, BOT + 0.12), LIQ - 0.05, Math.random()), rnd() * 0.4, rnd() * 0.08, 0.45 + Math.random() * 0.6, rnd() * 0.08, 3);
            } else {
              sp(rnd() * (TW - 0.3), BOT + 0.15, rnd() * (TD - 0.3), 0, 0.35 + Math.random() * 0.4, 0, 4);
            }
          });
          vapor.emitRate(cfg.vaporRate * (0.4 + sub), dt, sp => {
            sp(rnd() * (TW - 0.2), LIQ, rnd() * (TD - 0.2), rnd() * 0.12, 0.22 + Math.random() * 0.2, rnd() * 0.08, 2.6);
          });
          if (raise > 0.05 && c < 0.9 && bottom > LIQ) {
            drips.emitRate(34, dt, sp => sp(x + rnd() * 1.6, bottom, rnd() * 0.2, 0, 0, 0, 2));
          }
          bubbles.update(dt, 0, -Infinity, LIQ);
          vapor.update(dt, 0, -Infinity, TOP + 1.7);
          drips.update(dt, 7, LIQ);
        },
        hud() { return cfg.hud(prog, sub, x); },
      };
    }

    const buildPickling = () => buildDip({
      cycle: 10, rim: 0xe11d48, liquid: 0xc5d86d, opacity: 0.55,
      from: 0x7a4a2a, fromMetal: 0.25, fromRough: 0.95,  // rusty, scaled steel
      to: 0xc9d1dc, toMetal: 0.85, toRough: 0.25,         // bare clean steel
      bubble: 0xffffff, bubbleRate: 70, vapor: 0xe4ecb8, vaporRate: 12, vaporOpacity: 0.22,
      hud: (prog, sub) => [
        ['HCl CONC.', '18 %'],
        ['BATH TEMP', `${fmt(30 + sub * 4, 1)} °C`],
        ['RUST REMOVED', `${fmt(prog * 100, 0)} %`],
      ],
    });

    const buildPhosphate = () => buildDip({
      cycle: 10, rim: 0x2563eb, liquid: 0xe7e5e4, opacity: 0.8, heater: true,
      from: 0xc9d1dc, fromMetal: 0.85, fromRough: 0.25,   // clean steel from pickling
      to: 0xe5e2da, toMetal: 0.02, toRough: 1.0,          // matte white lime/phosphate layer
      bubble: 0xffffff, bubbleRate: 26, vapor: 0xffffff, vaporRate: 14, vaporOpacity: 0.35,
      hud: (prog, sub) => [
        ['BATH', 'LIME · PHOSPHATE'],
        ['BATH TEMP', `${fmt(55 + sub * 2, 1)} °C`],
        ['COAT WEIGHT', `${fmt(prog * 3.2, 1)} g/m²`],
      ],
    });

    /* ====================== MODEL: POWDER COATING BOOTH + OVEN ====================== */
    function buildPowder() {
      const g = new T.Group();
      const boothMat = new T.MeshStandardMaterial({ color: 0x64748b, metalness: 0.25, roughness: 0.6 });
      const BX = -0.4, HOOK = 1.85;

      // Spray booth (open front)
      g.add(box(2.8, 0.06, 1.9, steelDark, BX, FLOOR_Y + 0.03, -0.05));
      g.add(box(2.8, 3.0, 0.08, boothMat, BX, FLOOR_Y + 1.5, -1.0));
      [-1, 1].forEach(s => g.add(box(0.08, 3.0, 0.65, boothMat, BX + s * 1.4, FLOOR_Y + 1.5, -0.68)));
      g.add(box(2.88, 0.08, 0.75, boothMat, BX, FLOOR_Y + 3.0, -0.63));
      for (let i = 0; i < 3; i++) {
        const f = new T.Mesh(new T.CylinderGeometry(0.16, 0.16, 1.3, 20), greyMat);
        f.position.set(BX - 0.8 + i * 0.8, FLOOR_Y + 0.9, -0.82);
        g.add(f);
      }

      // Overhead conveyor
      g.add(box(7.2, 0.08, 0.1, steelDark, 0.2, 2.3, 0));
      g.add(box(0.12, 2.3 - FLOOR_Y, 0.12, steelDark, -3.3, (2.3 + FLOOR_Y) / 2, 0));

      // Curing oven (entry opening on the left face)
      const ovenMat = new T.MeshStandardMaterial({ color: 0xe2e8f0, metalness: 0.45, roughness: 0.4 });
      const OX = 2.7, OW = 2.0, OD = 1.5, OB = FLOOR_Y, OT = 2.2, OH = OT - OB, ocy = (OT + OB) / 2;
      g.add(box(OW, OH, 0.06, ovenMat, OX, ocy, -OD / 2));
      g.add(box(OW, OH, 0.06, ovenMat, OX, ocy, OD / 2));
      g.add(box(0.06, OH, OD, ovenMat, OX + OW / 2, ocy, 0));
      g.add(box(OW, 0.06, OD, ovenMat, OX, OT, 0));
      g.add(box(0.06, 0.62 - OB, OD, ovenMat, OX - OW / 2, (0.62 + OB) / 2, 0));
      const chimney = new T.Mesh(new T.CylinderGeometry(0.12, 0.12, 0.7, 16), steelMid);
      chimney.position.set(OX + 0.5, OT + 0.35, -0.3);
      g.add(chimney);
      const heatMat = new T.MeshStandardMaterial({ color: 0x431407, emissive: 0xff6a1a, emissiveIntensity: 0.25, roughness: 0.3 });
      g.add(box(1.3, 0.4, 0.02, heatMat, OX, 1.3, OD / 2 + 0.04));
      g.add(box(0.04, 1.36, 0.06, heatMat, OX - OW / 2 - 0.04, 1.3, OD / 2 - 0.1));
      g.add(box(0.04, 1.36, 0.06, heatMat, OX - OW / 2 - 0.04, 1.3, -OD / 2 + 0.1));

      // Reciprocating spray gun
      const GX = BX, GZ = 1.35;
      g.add(box(0.14, 2.9, 0.14, steelDark, GX, FLOOR_Y + 1.45, GZ + 0.14));
      g.add(box(0.5, 0.08, 0.5, steelDark, GX, FLOOR_Y + 0.04, GZ + 0.14));
      const gun = new T.Group();
      gun.add(box(0.2, 0.2, 0.46, paintRed, 0, 0, 0));
      const noz = new T.Mesh(new T.CylinderGeometry(0.035, 0.06, 0.3, 14), steelDark);
      noz.rotation.x = Math.PI / 2;
      noz.position.z = -0.36;
      gun.add(noz);
      g.add(gun);
      gun.position.set(GX, 1.2, GZ);

      // Workpiece (phosphated) + powder film that grows as the panel passes the gun
      const phosMat = new T.MeshStandardMaterial({ color: 0x9aa1aa, metalness: 0.12, roughness: 0.95 });
      const part = makeHungPart(phosMat);
      part.add(box(0.03, 0.14, 0.03, steelDark, 0, 0.41, 0));
      part.add(box(0.18, 0.06, 0.12, steelMid, 0, 0.47, 0));
      const coatMat = new T.MeshStandardMaterial({ color: 0xd6d6cf, metalness: 0.02, roughness: 0.8 });
      const coat = new T.Mesh(new T.BoxGeometry(1, 1.0, 0.014), coatMat);
      coat.position.set(0, -0.65, 0.032);
      part.add(coat);
      g.add(part);
      shadowAll(g);

      const powder = makeFx(260, 0xcfd0c8, 0.065, 0.6);
      const smoke = makeFx(40, 0xe2e8f0, 0.4, 0.3);
      g.add(powder.points, smoke.points);

      const CYCLE = 11;
      let cover = 0, on = false, heat = 0;
      return {
        group: g,
        still: CYCLE * 0.45,
        update(t, dt) {
          const c = (t % CYCLE) / CYCLE;
          let x;
          if (c < 0.16) x = lerp(-3.0, -1.45, smooth(0.03, 0.16, c));
          else if (c < 0.56) x = lerp(-1.45, 0.65, (c - 0.16) / 0.4);
          else x = lerp(0.65, OX, smooth(0.56, 0.7, c));
          part.position.set(x, HOOK, 0);
          part.scale.setScalar(Math.max(0.001, smooth(0, 0.04, c) * (1 - smooth(0.96, 1, c))));

          const w = clamp(x + 0.85 - GX, 0, 1.7);
          cover = w / 1.7;
          coat.visible = w > 0.002;
          coat.scale.x = Math.max(0.001, w);
          coat.position.x = 0.85 - w / 2;

          const gy = lerp(0.8, 1.6, 0.5 + 0.5 * Math.sin(t * 2.4));
          gun.position.y = gy;
          on = c > 0.12 && c < 0.6 && x - 0.85 < GX + 0.12 && x + 0.85 > GX - 0.12;
          if (on) {
            powder.emitRate(380, dt, sp => sp(GX + rnd() * 0.05, gy + rnd() * 0.05, GZ - 0.52, rnd() * 1.4, rnd() * 0.8, -(1.8 + Math.random() * 1.2), 0.9));
          }
          powder.update(dt, 0.15, -Infinity, Infinity, 0.05);

          heat = smooth(0.66, 0.74, c) * (1 - smooth(0.9, 0.97, c));
          heatMat.emissiveIntensity = 0.25 + heat * 1.6 + Math.sin(t * 6) * 0.06 * heat;
          const cure = smooth(0.7, 0.9, c);
          coatMat.roughness = lerp(0.8, 0.26, cure);
          coatMat.metalness = lerp(0.02, 0.12, cure);
          if (heat > 0.2) {
            setGlow(OX, 1.3, OD / 2 + 0.6, heat * 1.4);
            smoke.emitRate(10 * heat, dt, sp => sp(OX + 0.5 + rnd() * 0.1, OT + 0.72, -0.3 + rnd() * 0.1, rnd() * 0.15, 0.4 + Math.random() * 0.2, rnd() * 0.1, 2.4));
          }
          smoke.update(dt, -0.05);
        },
        hud() {
          return [
            ['VOLTAGE', on ? `${fmt(78, 0)} kV` : '0 kV'],
            ['FILM DFT', `${fmt(cover * 68, 0)} µm`],
            ['OVEN TEMP', `${fmt(160 + heat * 40, 0)} °C`],
          ];
        },
      };
    }

    /* ====================== MODEL: PANEL WIRING ====================== */
    function buildWiring() {
      const g = new T.Group();
      const W = 2.3, H = 3.0, D = 0.8;
      const y0 = FLOOR_Y + 0.14, cy = y0 + H / 2;

      // Enclosure shell + open door
      g.add(box(W + 0.1, 0.14, D + 0.1, steelDark, 0, FLOOR_Y + 0.07, 0));
      g.add(box(W, H, 0.05, paintWhite, 0, cy, -D / 2));
      g.add(box(0.05, H, D, paintWhite, -W / 2, cy, 0));
      g.add(box(0.05, H, D, paintWhite, W / 2, cy, 0));
      g.add(box(W, 0.05, D, paintWhite, 0, y0 + H, 0));
      g.add(box(W, 0.05, D, paintWhite, 0, y0, 0));
      const door = new T.Group();
      door.position.set(-W / 2, cy, D / 2);
      door.add(box(W, H, 0.04, paintWhite, W / 2, 0, 0));
      door.add(box(0.6, 0.8, 0.03, new T.MeshStandardMaterial({ color: 0x93c5fd, roughness: 0.7 }), W / 2, 0.4, -0.035));
      door.rotation.y = -1.9;
      g.add(door);

      // Mounting plate, rails & ducts (static)
      const plateZ = -D / 2 + 0.06, fz = plateZ + 0.015;
      g.add(box(W - 0.24, H - 0.24, 0.03, plateMat, 0, cy, plateZ));
      [0.72, 0.1, -0.46].forEach(y => g.add(box(1.75, 0.035, 0.02, steelMid, -0.12, y, fz + 0.01)));
      [1.08, 0.42, -0.22].forEach(y => g.add(box(1.9, 0.11, 0.1, greyMat, -0.05, y, fz + 0.05)));
      g.add(box(0.1, 1.7, 0.1, greyMat, -0.98, 0.3, fz + 0.05));
      g.add(box(0.1, 1.7, 0.1, greyMat, 0.92, 0.3, fz + 0.05));
      [-0.88, 0.78].forEach(x => g.add(box(0.08, 0.34, 0.1, paintRed, x, 1.38, fz + 0.05)));

      // Components (mounted one by one)
      const comps = [];
      const addComp = (obj, x, y, depth) => {
        const h = new T.Group();
        h.position.set(x, y, fz + depth / 2);
        h.userData.z = h.position.z;
        h.add(obj);
        g.add(h);
        comps.push(h);
      };
      const mccb = new T.Group();
      mccb.add(box(0.42, 0.5, 0.26, blackMat));
      mccb.add(box(0.08, 0.14, 0.06, paintRed, 0, 0, 0.16));
      mccb.add(box(0.3, 0.05, 0.006, paintWhite, 0, 0.17, 0.132));
      addComp(mccb, 0.45, 1.82, 0.26);
      const lamps = [0xef4444, 0xfacc15, 0x3b82f6].map((col, i) => {
        const m = new T.MeshStandardMaterial({ color: col, emissive: col, emissiveIntensity: 0, roughness: 0.3 });
        const l = new T.Mesh(new T.CylinderGeometry(0.055, 0.055, 0.08, 18), m);
        l.rotation.x = Math.PI / 2;
        addComp(l, -0.75 + i * 0.15, 1.85, 0.08);
        return m;
      });
      [1.5, 1.42, 1.34, 1.26].forEach(y => addComp(box(1.6, 0.05, 0.025, copperMat), -0.05, y, 0.12));
      for (let i = 0; i < 7; i++) {
        const mcb = new T.Group();
        mcb.add(box(0.17, 0.32, 0.2, paintWhite));
        mcb.add(box(0.06, 0.08, 0.05, blackMat, 0, 0.02, 0.12));
        addComp(mcb, -0.78 + i * 0.2, 0.72, 0.2);
      }
      const kMat = new T.MeshStandardMaterial({ color: 0x6b7280, metalness: 0.15, roughness: 0.55 });
      [-0.6, -0.22, 0.16].forEach(x => {
        const k = new T.Group();
        k.add(box(0.26, 0.32, 0.24, kMat));
        k.add(box(0.24, 0.08, 0.02, paintWhite, 0, 0.08, 0.125));
        addComp(k, x, 0.1, 0.24);
      });
      const relayMat = new T.MeshStandardMaterial({ color: 0x2563eb, metalness: 0.1, roughness: 0.5 });
      [0.48, 0.66].forEach(x => addComp(box(0.13, 0.26, 0.2, relayMat), x, 0.1, 0.2));
      const blueTB = new T.MeshStandardMaterial({ color: 0x2563eb, roughness: 0.55 });
      const peTB = new T.MeshStandardMaterial({ color: 0x84cc16, roughness: 0.55 });
      for (let j = 0; j < 14; j++) {
        addComp(box(0.05, 0.16, 0.14, j === 3 ? blueTB : j >= 12 ? peTB : greyMat), -0.6 + j * 0.075, -0.46, 0.14);
      }
      const NC = comps.length;

      // Wires (R/S/T/N colour code) routed orthogonally through the ducts
      const zw = fz + 0.17;
      const route = pts2 => {
        const out = [];
        pts2.forEach(([x, y], i) => {
          if (i === 0 || i === pts2.length - 1) { out.push(new T.Vector3(x, y, zw)); return; }
          const [ax, ay] = pts2[i - 1], [bx, by] = pts2[i + 1];
          const la = Math.hypot(x - ax, y - ay), lb = Math.hypot(bx - x, by - y);
          const ra = Math.min(0.05, la * 0.4), rb = Math.min(0.05, lb * 0.4);
          out.push(new T.Vector3(x - (x - ax) / la * ra, y - (y - ay) / la * ra, zw));
          out.push(new T.Vector3(x + (bx - x) / lb * rb, y + (by - y) / lb * rb, zw));
        });
        return new T.CatmullRomCurve3(out, false, 'centripetal');
      };
      const R = 0xdc2626, S = 0xeab308, Tc = 0x111827, N = 0x2563eb;
      const paths = [
        [R, [[-0.7, 1.5], [-0.7, 1.08], [-0.78, 1.08], [-0.78, 0.88]]],
        [S, [[-0.58, 1.42], [-0.58, 0.88]]],
        [Tc, [[-0.38, 1.34], [-0.38, 0.88]]],
        [R, [[-0.78, 0.56], [-0.78, 0.42], [-0.68, 0.42], [-0.68, 0.26]]],
        [S, [[-0.58, 0.56], [-0.58, 0.42], [-0.6, 0.42], [-0.6, 0.26]]],
        [Tc, [[-0.38, 0.56], [-0.38, 0.42], [-0.52, 0.42], [-0.52, 0.26]]],
        [R, [[-0.18, 0.56], [-0.18, 0.42], [-0.3, 0.42], [-0.3, 0.26]]],
        [S, [[0.02, 0.56], [0.02, 0.42], [-0.22, 0.42], [-0.22, 0.26]]],
        [Tc, [[0.22, 0.56], [0.22, 0.42], [-0.14, 0.42], [-0.14, 0.26]]],
        [R, [[-0.68, -0.06], [-0.68, -0.22], [-0.6, -0.22], [-0.6, -0.38]]],
        [S, [[-0.6, -0.06], [-0.6, -0.22], [-0.525, -0.22], [-0.525, -0.38]]],
        [Tc, [[-0.52, -0.06], [-0.52, -0.22], [-0.45, -0.22], [-0.45, -0.38]]],
        [N, [[-0.8, 1.26], [-0.98, 1.26], [-0.98, -0.22], [-0.375, -0.22], [-0.375, -0.38]]],
        [Tc, [[0.42, 0.56], [0.42, 0.42], [0.48, 0.42], [0.48, 0.23]]],
        [Tc, [[0.48, -0.03], [0.48, -0.22], [0.225, -0.22], [0.225, -0.38]]],
      ];
      const TS = 90, RS = 6;
      const wires = paths.map(([col, pts]) => {
        const curve = route(pts);
        const geo = new T.TubeGeometry(curve, TS, 0.016, RS, false);
        geo.setDrawRange(0, 0);
        const mesh = new T.Mesh(geo, new T.MeshStandardMaterial({ color: col, roughness: 0.45, metalness: 0.05 }));
        mesh.frustumCulled = false;
        g.add(mesh);
        return { curve, geo };
      });
      const NW = wires.length;
      const tip = new T.Mesh(new T.SphereGeometry(0.03, 12, 12), new T.MeshStandardMaterial({ color: 0xe11d48, emissive: 0xe11d48, emissiveIntensity: 0.8 }));
      g.add(tip);
      shadowAll(g);

      const CYCLE = 16, tipPos = new T.Vector3();
      let mounted = 0, wired = 0, test = false;
      return {
        group: g,
        still: CYCLE * 0.9,
        update(t) {
          const c = (t % CYCLE) / CYCLE;
          const fade = 1 - smooth(0.95, 1, c);
          mounted = 0;
          comps.forEach((h, i) => {
            const t0 = 0.03 + i * (0.3 / NC);
            const a = easeOutCubic(clamp((c - t0) / 0.03, 0, 1)) * fade;
            if (c >= t0 + 0.03) mounted++;
            h.visible = a > 0.002;
            h.scale.setScalar(Math.max(0.001, a));
            h.position.z = h.userData.z + (1 - a) * 0.5;
          });

          const W0 = 0.36, WD = 0.48 / NW;
          let tipOn = false;
          wired = 0;
          wires.forEach((w, i) => {
            const p = clamp((c - (W0 + i * WD)) / WD, 0, 1);
            if (p >= 1) wired++;
            w.geo.setDrawRange(0, Math.floor(p * fade * TS) * RS * 6);
            if (p > 0 && p < 1) { tipOn = true; w.curve.getPointAt(p, tipPos); }
          });
          tip.visible = tipOn;
          if (tipOn) tip.position.copy(tipPos);

          test = c > 0.86 && c < 0.96;
          lamps.forEach((m, k) => { m.emissiveIntensity = c > 0.86 + k * 0.015 && c < 0.96 ? 1.4 + Math.sin(t * 8) * 0.2 : 0; });
          if (test) setGlow(-0.6, 1.85, fz + 0.5, 1.1);
        },
        hud() {
          return [
            ['COMPONENTS', `${pad2(mounted)} / ${NC}`],
            ['WIRES', `${pad2(wired)} / ${NW}`],
            ['INSULATION', test ? 'PASS · >500 MΩ' : wired === NW ? 'TESTING…' : '— — —'],
          ];
        },
      };
    }

    const models = {
      laser: buildLaser(),
      bend: buildBend(),
      punch: buildPunch(),
      shear: buildShear(),
      cabinet: buildCabinet(),
      pickling: buildPickling(),
      phosphate: buildPhosphate(),
      powder: buildPowder(),
      wiring: buildWiring(),
    };
    Object.keys(models).forEach(k => {
      const m = models[k];
      m.appear = 0;
      m.lt = 0;
      m.group.visible = false;
      world.add(m.group);
    });

    /* ---------- State ---------- */
    let cur = 'laser';
    const cam = { ...CAM.laser };
    let scrollT = 0, scrollTs = 0;
    let px = 0, py = 0, pxs = 0, pys = 0;
    let userAz = 0, vAz = 0, dragging = false;
    let t = 0, hudAcc = 0;
    let running = true;

    function setMachine(kind, instant) {
      const k = models[kind] ? kind : 'cabinet';
      if (k !== cur) models[k].lt = 0; // restart the newly selected animation from its first frame
      cur = k;
      if (instant) {
        Object.keys(models).forEach(n => { models[n].appear = n === k ? 1 : 0; });
        Object.assign(cam, CAM[k]);
      }
      emitHud();
      return TITLES[k];
    }

    function emitHud() {
      if (!onHud) return;
      onHud(TITLES[cur], models[cur].hud());
    }

    function resize() {
      const w = host.clientWidth, h = host.clientHeight;
      if (!w || !h) return;
      renderer.setSize(w, h, false);
      camera.aspect = w / h;
      camera.fov = w / h < 0.95 ? 46 : 34;
      camera.updateProjectionMatrix();
    }
    const ro = typeof ResizeObserver !== 'undefined' ? new ResizeObserver(resize) : null;
    if (ro) ro.observe(host); else window.addEventListener('resize', resize);
    resize();

    canvas.addEventListener('webglcontextlost', (e) => {
      e.preventDefault();
      running = false;
      if (onLost) onLost();
    });

    function render(dt) {
      if (!running) return;
      if (!reduced) t += dt;
      const time = reduced ? 3.1 : t;

      const s = 1 - Math.exp(-dt * 3.2);
      const tgt = CAM[cur];
      cam.az = lerp(cam.az, tgt.az, s);
      cam.el = lerp(cam.el, tgt.el, s);
      cam.r = lerp(cam.r, tgt.r, s);
      cam.ty = lerp(cam.ty, tgt.ty, s);

      scrollTs = lerp(scrollTs, scrollT, 1 - Math.exp(-dt * 4));
      pxs = lerp(pxs, px, 1 - Math.exp(-dt * 4));
      pys = lerp(pys, py, 1 - Math.exp(-dt * 4));
      if (!dragging) {
        userAz += vAz;
        vAz *= Math.pow(0.9, dt * 60);
        userAz *= Math.pow(0.992, dt * 60);
      }
      const az = cam.az + (scrollTs - 0.5) * 0.7 + userAz + pxs * 0.14;
      const el = clamp(cam.el + pys * 0.05, 0.12, 1.2);
      camera.position.set(
        Math.sin(az) * Math.cos(el) * cam.r,
        Math.sin(el) * cam.r + 0.2,
        Math.cos(az) * Math.cos(el) * cam.r
      );
      camera.lookAt(0, cam.ty, 0);

      glow.intensity *= Math.pow(0.002, dt);

      Object.keys(models).forEach(name => {
        const m = models[name];
        const target = name === cur ? 1 : 0;
        const stepA = dt * 2.4;
        m.appear += clamp(target - m.appear, -stepA, stepA);
        m.group.visible = m.appear > 0.002;
        if (!m.group.visible) return;
        const e = easeOutCubic(m.appear);
        m.group.scale.setScalar(0.84 + 0.16 * e);
        m.group.position.y = -0.7 * (1 - e);
        m.group.rotation.y = name === 'cabinet' ? m.group.rotation.y : (1 - e) * (name === cur ? -0.9 : 0.9);
        if (!reduced) m.lt += dt;
        m.update(reduced ? (m.still ?? 3.1) : m.lt, dt);
      });

      updateSparks(dt);
      dust.rotation.y = time * 0.02;
      arc.rotation.z = time * 0.35;
      ring.material.opacity = 0.55 + Math.sin(time * 1.4) * 0.15;
      rim.intensity = 1.4 + Math.sin(time * 0.8) * 0.2;

      hudAcc += dt;
      if (hudAcc > 0.25) { hudAcc = 0; emitHud(); }

      renderer.render(scene, camera);
    }

    return {
      setMachine,
      setScroll(v) { scrollT = clamp(v, 0, 1); },
      setPointer(x, y) { px = x; py = y; },
      dragStart() { dragging = true; vAz = 0; },
      dragMove(dx) { userAz += dx * 0.0085; vAz = dx * 0.0085; },
      dragEnd() { dragging = false; },
      render,
      resize,
      dispose() { if (ro) ro.disconnect(); renderer.dispose(); },
    };
  }

  window.ATSFleetScene = { create };
})();
