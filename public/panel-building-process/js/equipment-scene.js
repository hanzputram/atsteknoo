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
  };

  // Camera framing per machine family
  const CAM = {
    laser: { az: 0.62, el: 0.64, r: 8.9, ty: 0.15 },
    bend: { az: 0.22, el: 0.36, r: 8.1, ty: 0.2 },
    punch: { az: 0.58, el: 0.7, r: 8.9, ty: 0.15 },
    shear: { az: 0.74, el: 0.46, r: 9.8, ty: 0.55 },
    cabinet: { az: 0.5, el: 0.26, r: 9.6, ty: 1.0 },
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

    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
    renderer.setClearColor(0x000000, 0);
    renderer.outputEncoding = T.sRGBEncoding;
    renderer.toneMapping = T.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.12;
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = T.PCFSoftShadowMap;

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

    const models = {
      laser: buildLaser(),
      bend: buildBend(),
      punch: buildPunch(),
      shear: buildShear(),
      cabinet: buildCabinet(),
    };
    Object.keys(models).forEach(k => {
      const m = models[k];
      m.appear = 0;
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
        m.update(time, dt);
      });

      updateSparks(dt);
      dust.rotation.y = time * 0.02;
      arc.rotation.z = time * 0.35;
      ring.material.opacity = 0.55 + Math.sin(time * 1.4) * 0.15;
      rim.intensity = 1.4 + Math.sin(time * 0.8) * 0.2;

      hudAcc += dt;
      if (hudAcc > 0.09) { hudAcc = 0; emitHud(); }

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
