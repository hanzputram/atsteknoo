<!-- TinyMCE 4.9.11: The Exact Engine of WordPress Classic Editor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.9.11/tinymce.min.js" referrerpolicy="origin"></script>

<style>
  /* ==========================================================================
     WordPress Classic Editor Appearance Stylesheet
     ========================================================================== */
  .wp-editor-wrap {
    position: relative;
    border: 1px solid #ccd0d4;
    border-radius: 4px;
    background: #fff;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.04);
    margin-top: 6px;
    margin-bottom: 12px;
    clear: both;
  }
  .wp-editor-wrap.focused {
    border-color: #5b9dd9;
    box-shadow: 0 0 2px rgba(30, 140, 190, 0.8);
  }
  .wp-editor-tools {
    background: #f1f1f1;
    border-bottom: 1px solid #dedede;
    padding: 8px 10px 0 10px;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    min-height: 40px;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    user-select: none;
  }
  .wp-media-buttons {
    display: inline-flex;
    align-items: center;
    margin-bottom: 6px;
  }
  .wp-media-buttons .wp-add-media-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    height: 28px;
    padding: 0 10px;
    font-size: 13px;
    font-weight: 500;
    color: #444;
    background: #f7f7f7;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-shadow: 0 1px 0 #ccc;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
  }
  .wp-media-buttons .wp-add-media-btn:hover {
    background: #fafafa;
    border-color: #999;
    color: #23282d;
  }
  .wp-media-buttons .wp-add-media-btn svg {
    color: #82878c;
  }
  .wp-editor-tabs {
    display: inline-flex;
    align-items: flex-end;
    gap: 4px;
    margin-bottom: -1px;
  }
  .wp-switch-editor {
    height: 28px;
    padding: 4px 12px;
    font-size: 13px;
    font-weight: 500;
    color: #72777c;
    background: #ebebeb;
    border: 1px solid #dedede;
    border-bottom: none;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    cursor: pointer;
    transition: background 0.15s, color 0.15s;
    line-height: 18px;
  }
  .wp-switch-editor:hover {
    color: #23282d;
    background: #f5f5f5;
  }
  .wp-switch-editor.active {
    background: #f5f5f5;
    color: #32373c;
    font-weight: 600;
    border-color: #dedede;
    border-bottom: 1px solid #f5f5f5;
  }

  /* TinyMCE Native UI Overrides for WordPress Classic Look */
  .wp-editor-container {
    position: relative;
    background: #fff;
  }
  .wp-editor-container .mce-tinymce {
    border: none !important;
    box-shadow: none !important;
    border-radius: 0 !important;
  }
  .wp-editor-container .mce-top-part::before {
    box-shadow: none !important;
  }
  .wp-editor-container .mce-toolbar-grp {
    background: #f5f5f5 !important;
    border-bottom: 1px solid #dedede !important;
    padding: 3px 6px !important;
  }
  .wp-editor-container .mce-toolbar {
    margin: 2px 0 !important;
  }
  .wp-editor-container .mce-btn {
    background: transparent !important;
    border: 1px solid transparent !important;
    border-radius: 2px !important;
    box-shadow: none !important;
    margin: 1px !important;
  }
  .wp-editor-container .mce-btn:hover,
  .wp-editor-container .mce-btn.mce-active {
    background: #e5e5e5 !important;
    border-color: #ccc !important;
  }
  .wp-editor-container .mce-menubtn.mce-btn {
    border: 1px solid #ccd0d4 !important;
    background: #fff !important;
    border-radius: 3px !important;
    padding: 0 4px !important;
  }
  .wp-editor-container .mce-menubtn.mce-btn:hover {
    border-color: #999 !important;
  }
  .wp-editor-container .mce-menubtn span.mce-txt {
    font-size: 13px !important;
    color: #444 !important;
  }
  .wp-editor-container .mce-ico {
    color: #555 !important;
  }
  .wp-editor-container .mce-statusbar {
    background: #f5f5f5 !important;
    border-top: 1px solid #dedede !important;
    font-size: 12px !important;
    color: #666 !important;
    padding: 4px 10px !important;
  }
  .wp-editor-container .mce-path {
    font-family: monospace !important;
    font-size: 11.5px !important;
  }
  .wp-editor-container .mce-wordcount {
    color: #777 !important;
    font-size: 12px !important;
  }

  /* Text Mode (Raw HTML editor) */
  .wp-raw-textarea {
    width: 100% !important;
    min-height: 380px !important;
    box-sizing: border-box !important;
    border: none !important;
    outline: none !important;
    padding: 14px 16px !important;
    font-family: Consolas, Monaco, "Courier New", Courier, monospace !important;
    font-size: 13px !important;
    line-height: 1.6 !important;
    color: #1e293b !important;
    background: #ffffff !important;
    display: none;
    resize: vertical;
  }

  /* ==========================================================================
     WordPress "Add Media" Modal Dialog
     ========================================================================== */
  .wp-media-modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.65);
    z-index: 100050;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 20px;
    backdrop-filter: blur(2px);
  }
  .wp-media-modal-window {
    background: #fff;
    width: 900px;
    max-width: 95vw;
    height: 600px;
    max-height: 90vh;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    animation: wpModalSlideIn 0.2s ease-out;
  }
  @keyframes wpModalSlideIn {
    from { transform: translateY(12px) scale(0.98); opacity: 0; }
    to { transform: translateY(0) scale(1); opacity: 1; }
  }
  .wp-media-modal-header {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .wp-media-modal-title {
    font-size: 17px;
    font-weight: 700;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .wp-media-modal-close {
    background: none;
    border: none;
    font-size: 24px;
    line-height: 1;
    color: #94a3b8;
    cursor: pointer;
    padding: 0 4px;
    transition: color 0.15s;
  }
  .wp-media-modal-close:hover {
    color: #0f172a;
  }
  .wp-media-modal-nav {
    background: #f1f5f9;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    padding: 0 16px;
    gap: 4px;
  }
  .wp-media-nav-tab {
    padding: 10px 16px;
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    background: none;
    border: none;
    border-bottom: 2px solid transparent;
    cursor: pointer;
    transition: all 0.15s;
  }
  .wp-media-nav-tab:hover {
    color: #0f172a;
  }
  .wp-media-nav-tab.active {
    color: #e11d48;
    border-bottom-color: #e11d48;
    background: #fff;
  }
  .wp-media-modal-body {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f8fafc;
  }
  .wp-media-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
    gap: 12px;
  }
  .wp-media-item {
    aspect-ratio: 1;
    background: #fff;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    padding: 4px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .wp-media-item:hover {
    border-color: #cbd5e1;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.06);
  }
  .wp-media-item.selected {
    border-color: #e11d48;
    box-shadow: 0 0 0 2px rgba(225, 29, 72, 0.25);
  }
  .wp-media-item.selected::after {
    content: "✓";
    position: absolute;
    top: 4px;
    right: 4px;
    background: #e11d48;
    color: #fff;
    font-size: 10px;
    font-weight: 800;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .wp-media-item img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
  }
  .wp-media-dropzone {
    border: 2px dashed #cbd5e1;
    border-radius: 8px;
    background: #fff;
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s, background-color 0.2s;
  }
  .wp-media-dropzone:hover,
  .wp-media-dropzone.dragover {
    border-color: #e11d48;
    background: #fff1f2;
  }
  .wp-media-modal-footer {
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .wp-media-insert-btn {
    background: #e11d48;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 13px;
    font-weight: 600;
    padding: 8px 18px;
    cursor: pointer;
    transition: background 0.15s;
  }
  .wp-media-insert-btn:hover:not(:disabled) {
    background: #be123c;
  }
  .wp-media-insert-btn:disabled {
    background: #cbd5e1;
    cursor: not-allowed;
  }
</style>

<!-- Add Media Modal Dialog Markup -->
<div class="wp-media-modal-backdrop" id="wpMediaModalBackdrop" onclick="closeWpMediaModal(event)">
  <div class="wp-media-modal-window" onclick="event.stopPropagation()">
    <!-- Header -->
    <div class="wp-media-modal-header">
      <div class="wp-media-modal-title">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
          <circle cx="8.5" cy="8.5" r="1.5"/>
          <polyline points="21 15 16 10 5 21"/>
        </svg>
        <span>Add Media (Pustaka Media ATS)</span>
      </div>
      <button type="button" class="wp-media-modal-close" onclick="closeWpMediaModal()">&times;</button>
    </div>

    <!-- Navigation Tabs -->
    <div class="wp-media-modal-nav">
      <button type="button" class="wp-media-nav-tab active" id="tabBtnLibrary" onclick="switchMediaTab('library')">ATS Media Library</button>
      <button type="button" class="wp-media-nav-tab" id="tabBtnUpload" onclick="switchMediaTab('upload')">Unggah Berkas Baru</button>
      <button type="button" class="wp-media-nav-tab" id="tabBtnUrl" onclick="switchMediaTab('url')">Sisipkan dari URL Web</button>
    </div>

    <!-- Body -->
    <div class="wp-media-modal-body">
      <!-- Tab 1: Library -->
      <div id="mediaTabLibrary">
        <div style="display: flex; gap: 10px; margin-bottom: 14px;">
          <input type="text" id="wpMediaSearchInput" placeholder="Cari nama berkas media..." class="form-control" style="font-size: 13px; height: 34px; padding: 6px 12px;" oninput="debounceSearchMedia(this.value)">
          <button type="button" class="btn btn-secondary btn-sm" onclick="loadMediaLibrary(1, document.getElementById('wpMediaSearchInput').value)">Segarkan</button>
        </div>
        <div id="wpMediaGrid" class="wp-media-grid">
          <!-- Populated via AJAX -->
          <div style="grid-column: 1 / -1; padding: 30px; text-align: center; color: #94a3b8; font-size: 13px;">
            Memuat pustaka media...
          </div>
        </div>
      </div>

      <!-- Tab 2: Upload -->
      <div id="mediaTabUpload" style="display: none;">
        <div class="wp-media-dropzone" id="wpMediaDropzone" onclick="document.getElementById('wpMediaFileInput').click()">
          <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="1.6" style="margin: 0 auto 12px; display: block;">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
            <polyline points="17 8 12 3 7 8"/>
            <line x1="12" y1="3" x2="12" y2="15"/>
          </svg>
          <div style="font-size: 15px; font-weight: 600; color: #1e293b; margin-bottom: 4px;">Pilih berkas untuk diunggah</div>
          <div style="font-size: 12px; color: #64748b; margin-bottom: 16px;">Tarik dan lepas gambar di sini, atau klik tombol di bawah (JPG, PNG, WEBP, maks 10MB)</div>
          <button type="button" class="btn btn-secondary btn-sm">Pilih Berkas</button>
          <input type="file" id="wpMediaFileInput" accept="image/jpeg,image/png,image/webp,image/gif" style="display: none;" onchange="handleDirectUpload(this.files)">
        </div>
        <div id="wpUploadProgress" style="display: none; margin-top: 14px; text-align: center; font-size: 13px; color: #e11d48; font-weight: 600;">
          ⏳ Sedang mengunggah media ke server...
        </div>
      </div>

      <!-- Tab 3: URL -->
      <div id="mediaTabUrl" style="display: none;">
        <div style="max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
          <div class="form-group" style="margin-bottom: 12px;">
            <label class="form-label" style="font-size: 12.5px;">Tautan Gambar (URL):</label>
            <input type="url" id="wpUrlInput" placeholder="https://domain.com/gambar.jpg" class="form-control" style="font-size: 13px;" oninput="previewExternalUrl(this.value)">
          </div>
          <div class="form-group" style="margin-bottom: 12px;">
            <label class="form-label" style="font-size: 12.5px;">Teks Alternatif (Alt Text):</label>
            <input type="text" id="wpUrlAltInput" placeholder="Deskripsi gambar teknis" class="form-control" style="font-size: 13px;">
          </div>
          <div id="wpUrlPreviewContainer" style="display: none; margin-top: 10px; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px; text-align: center;">
            <img id="wpUrlPreviewImg" src="" alt="" style="max-height: 140px; max-width: 100%; object-fit: contain;">
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <div class="wp-media-modal-footer">
      <div id="wpMediaSelectedInfo" style="font-size: 12.5px; color: #64748b;">
        Pilih gambar untuk disisipkan.
      </div>
      <div style="display: flex; gap: 8px;">
        <button type="button" class="btn btn-secondary btn-sm" onclick="closeWpMediaModal()">Batal</button>
        <button type="button" class="wp-media-insert-btn" id="wpMediaInsertBtn" disabled onclick="insertSelectedMedia()">Sisipkan ke Konten</button>
      </div>
    </div>
  </div>
</div>

<script>
(function() {
  window.currentActiveWpEditorId = null;
  window.selectedMediaAsset = null;

  // 1. Inisialisasi TinyMCE dengan antarmuka WordPress Classic
  function initClassicTinyMCE() {
    const textareas = document.querySelectorAll('textarea.wysiwyg-editor');
    if (!textareas.length) return;

    textareas.forEach(textarea => {
      if (textarea.dataset.wpInitialized) return;

      const editorId = textarea.id || 'wp_editor_' + Math.random().toString(36).substring(2, 9);
      textarea.id = editorId;
      textarea.dataset.wpInitialized = 'true';

      // Bungkus textarea ke dalam wrapper WordPress
      const wrap = document.createElement('div');
      wrap.className = 'wp-editor-wrap tmce-active';
      wrap.id = 'wp_' + editorId + '_wrap';

      // Header tools (Tombol "Add Media" di kiri, Tab "Visual / Text" di kanan)
      const tools = document.createElement('div');
      tools.className = 'wp-editor-tools';
      tools.innerHTML = `
        <div class="wp-media-buttons">
          <button type="button" class="wp-add-media-btn" onclick="openWpMediaModal('${editorId}')">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
              <circle cx="8.5" cy="8.5" r="1.5"></circle>
              <polyline points="21 15 16 10 5 21"></polyline>
            </svg>
            Add Media
          </button>
        </div>
        <div class="wp-editor-tabs">
          <button type="button" class="wp-switch-editor switch-tmce active" id="tab_visual_${editorId}" onclick="switchWpEditor('${editorId}', 'visual')">Visual</button>
          <button type="button" class="wp-switch-editor switch-html" id="tab_text_${editorId}" onclick="switchWpEditor('${editorId}', 'text')">Text</button>
        </div>
      `;

      // Container editor & raw textarea
      const container = document.createElement('div');
      container.className = 'wp-editor-container';

      textarea.parentNode.insertBefore(wrap, textarea);
      wrap.appendChild(tools);
      wrap.appendChild(container);
      container.appendChild(textarea);

      textarea.classList.add('wp-raw-textarea');

      // Konfigurasi TinyMCE 4 persis seperti WordPress Classic
      tinymce.init({
        selector: '#' + editorId,
        theme: 'modern',
        skin: 'lightgray',
        height: 380,
        menubar: false,
        statusbar: true,
        elementpath: true,
        resize: true,
        branding: false,
        plugins: [
          'advlist autolink lists link image charmap hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'paste textcolor colorpicker'
        ],
        // Baris 1 persis screenshot WordPress:
        toolbar1: 'bold italic strikethrough | bullist numlist | blockquote hr | alignleft aligncenter alignright | link unlink | wp_more | wp_adv fullscreen',
        // Baris 2 persis screenshot WordPress:
        toolbar2: 'styleselect formatselect | underline alignjustify | forecolor | pastetext removeformat | charmap | outdent indent | undo redo | wp_help',
        
        // Formats dropdown menu sub-items persis seperti di screenshot
        style_formats: [
          {
            title: 'Headings', items: [
              { title: 'Heading 1', format: 'h1' },
              { title: 'Heading 2', format: 'h2' },
              { title: 'Heading 3', format: 'h3' },
              { title: 'Heading 4', format: 'h4' },
              { title: 'Heading 5', format: 'h5' },
              { title: 'Heading 6', format: 'h6' }
            ]
          },
          {
            title: 'Inline', items: [
              { title: 'Bold', icon: 'bold', format: 'bold' },
              { title: 'Italic', icon: 'italic', format: 'italic' },
              { title: 'Underline', icon: 'underline', format: 'underline' },
              { title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough' },
              { title: 'Superscript', icon: 'superscript', format: 'superscript' },
              { title: 'Subscript', icon: 'subscript', format: 'subscript' },
              { title: 'Code', icon: 'code', format: 'code' }
            ]
          },
          {
            title: 'Blocks', items: [
              { title: 'Paragraph', format: 'p' },
              { title: 'Blockquote', format: 'blockquote' },
              { title: 'Div', format: 'div' },
              { title: 'Pre', format: 'pre' }
            ]
          },
          {
            title: 'Alignment', items: [
              { title: 'Left', icon: 'alignleft', format: 'alignleft' },
              { title: 'Center', icon: 'aligncenter', format: 'aligncenter' },
              { title: 'Right', icon: 'alignright', format: 'alignright' },
              { title: 'Justify', icon: 'alignjustify', format: 'alignjustify' }
            ]
          }
        ],

        // URL upload gambar otomatis (drag-and-drop / paste)
        images_upload_url: '{{ route('backoffice.media-library.upload') }}',
        images_upload_credentials: true,
        images_upload_handler: function (blobInfo, success, failure) {
          const xhr = new XMLHttpRequest();
          xhr.withCredentials = true;
          xhr.open('POST', '{{ route('backoffice.media-library.upload') }}');
          xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

          xhr.onload = function() {
            if (xhr.status !== 200) {
              failure('HTTP Error: ' + xhr.status);
              return;
            }
            try {
              const json = JSON.parse(xhr.responseText);
              if (!json || typeof json.location !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
              }
              success(json.location);
            } catch (e) {
              failure('Error parsing JSON response: ' + e.message);
            }
          };

          const formData = new FormData();
          formData.append('file', blobInfo.blob(), blobInfo.filename());
          xhr.send(formData);
        },

        content_style: `
          body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            padding: 12px;
          }
          img { max-width: 100%; height: auto; border-radius: 4px; }
          table { width: 100%; border-collapse: collapse; margin: 12px 0; }
          th, td { border: 1px solid #cbd5e1; padding: 8px 12px; }
          th { background: #f8fafc; }
          blockquote { border-left: 4px solid #e11d48; margin: 1em 0; padding-left: 14px; color: #64748b; font-style: italic; }
        `,

        setup: function(ed) {
          // Tombol custom: Read More tag (<!--more-->)
          ed.addButton('wp_more', {
            tooltip: 'Insert Read More tag',
            icon: 'pagebreak',
            onclick: function() {
              ed.insertContent('<!--more--><hr class="wp-more-tag" style="border: 1px dashed #94a3b8; margin: 12px 0;" />');
            }
          });

          // Tombol custom: Kitchen sink / Toolbar toggle (wp_adv)
          ed.addButton('wp_adv', {
            tooltip: 'Toolbar Toggle (Baris 2)',
            icon: 'wp_adv',
            onclick: function() {
              const container = ed.getContainer();
              if (!container) return;
              const toolbars = container.querySelectorAll('.mce-toolbar-grp .mce-toolbar');
              if (toolbars && toolbars.length >= 2) {
                const tb2 = toolbars[1];
                tb2.style.display = (tb2.style.display === 'none') ? '' : 'none';
              }
            }
          });

          // Tombol custom: Help
          ed.addButton('wp_help', {
            tooltip: 'Panduan & Pintasan Keyboard',
            icon: 'help',
            onclick: function() {
              ed.windowManager.alert(
                '<b>Pintasan Keyboard Klasik:</b><br><br>' +
                '&bull; Ctrl+B : Tebal (Bold)<br>' +
                '&bull; Ctrl+I : Miring (Italic)<br>' +
                '&bull; Ctrl+U : Garis Bawah (Underline)<br>' +
                '&bull; Ctrl+K : Sisipkan Tautan (Link)<br>' +
                '&bull; Shift+Alt+1 s/d 6 : Heading 1 s/d 6<br>' +
                '&bull; Shift+Alt+L : Rata Kiri<br>' +
                '&bull; Shift+Alt+C : Rata Tengah<br>' +
                '&bull; Shift+Alt+J : Rata Kanan-Kiri'
              );
            }
          });

          // Focus styles on wrapper
          ed.on('focus', function() {
            wrap.classList.add('focused');
          });
          ed.on('blur', function() {
            wrap.classList.remove('focused');
            ed.save();
          });
          ed.on('change keyup', function() {
            ed.save();
          });
        }
      });
    });
  }

  // 2. Switcher Mode Visual vs Text (Raw HTML)
  window.switchWpEditor = function(editorId, mode) {
    const ed = tinymce.get(editorId);
    const textarea = document.getElementById(editorId);
    const tabVisual = document.getElementById('tab_visual_' + editorId);
    const tabText = document.getElementById('tab_text_' + editorId);
    const wrap = document.getElementById('wp_' + editorId + '_wrap');

    if (mode === 'text') {
      // Ke mode TEXT (HTML raw)
      if (ed) {
        textarea.value = ed.getContent();
        ed.hide();
      }
      textarea.style.display = 'block';
      if (tabVisual) tabVisual.classList.remove('active');
      if (tabText) tabText.classList.add('active');
      if (wrap) {
        wrap.classList.remove('tmce-active');
        wrap.classList.add('html-active');
      }
    } else {
      // Ke mode VISUAL (TinyMCE WYSIWYG)
      if (ed) {
        ed.setContent(textarea.value);
        ed.show();
      }
      textarea.style.display = 'none';
      if (tabText) tabText.classList.remove('active');
      if (tabVisual) tabVisual.classList.add('active');
      if (wrap) {
        wrap.classList.remove('html-active');
        wrap.classList.add('tmce-active');
      }
    }
  };

  // 3. Modal Add Media
  window.openWpMediaModal = function(editorId) {
    window.currentActiveWpEditorId = editorId;
    window.selectedMediaAsset = null;
    document.getElementById('wpMediaSelectedInfo').innerText = 'Pilih gambar untuk disisipkan.';
    document.getElementById('wpMediaInsertBtn').disabled = true;

    const modal = document.getElementById('wpMediaModalBackdrop');
    if (modal) {
      modal.style.display = 'flex';
      switchMediaTab('library');
      loadMediaLibrary(1);
    }
  };

  window.closeWpMediaModal = function(e) {
    if (e && e.target && e.target.id !== 'wpMediaModalBackdrop' && !e.target.classList.contains('wp-media-modal-close')) {
      return;
    }
    const modal = document.getElementById('wpMediaModalBackdrop');
    if (modal) modal.style.display = 'none';
  };

  window.switchMediaTab = function(tab) {
    document.getElementById('tabBtnLibrary').classList.toggle('active', tab === 'library');
    document.getElementById('tabBtnUpload').classList.toggle('active', tab === 'upload');
    document.getElementById('tabBtnUrl').classList.toggle('active', tab === 'url');

    document.getElementById('mediaTabLibrary').style.display = tab === 'library' ? 'block' : 'none';
    document.getElementById('mediaTabUpload').style.display = tab === 'upload' ? 'block' : 'none';
    document.getElementById('mediaTabUrl').style.display = tab === 'url' ? 'block' : 'none';

    if (tab === 'url') {
      window.selectedMediaAsset = { isUrl: true };
      checkUrlInsertValidity();
    }
  };

  // 4. Fetch Media Library dari Server
  let searchDebounceTimer;
  window.debounceSearchMedia = function(val) {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => {
      loadMediaLibrary(1, val);
    }, 350);
  };

  window.loadMediaLibrary = function(page, search = '') {
    const grid = document.getElementById('wpMediaGrid');
    grid.innerHTML = '<div style="grid-column: 1 / -1; padding: 30px; text-align: center; color: #94a3b8; font-size: 13px;">⏳ Memuat pustaka media...</div>';

    fetch(`{{ route('backoffice.media-library.index') }}?page=${page}&search=${encodeURIComponent(search)}`, {
      headers: { 'Accept': 'application/json' }
    })
    .then(res => res.json())
    .then(data => {
      if (!data.items || !data.items.length) {
        grid.innerHTML = '<div style="grid-column: 1 / -1; padding: 40px; text-align: center; color: #94a3b8; font-size: 13px;">Belum ada gambar yang tersimpan di pustaka media.</div>';
        return;
      }

      grid.innerHTML = '';
      data.items.forEach(item => {
        const el = document.createElement('div');
        el.className = 'wp-media-item';
        el.title = `${item.filename} (${item.size_human})`;
        el.innerHTML = `<img src="${item.url}" alt="${item.alt_text}" onerror="this.src='data:image/svg+xml;utf8,<svg xmlns=\\'http://www.w3.org/2000/svg\\' width=\\'40\\' height=\\'40\\'><text y=\\'20\\' fill=\\'%2394a3b8\\'>⚠️</text></svg>'">`;
        el.onclick = function() {
          document.querySelectorAll('.wp-media-item').forEach(i => i.classList.remove('selected'));
          el.classList.add('selected');
          window.selectedMediaAsset = item;
          document.getElementById('wpMediaSelectedInfo').innerText = `Terpilih: ${item.filename} (${item.size_human})`;
          document.getElementById('wpMediaInsertBtn').disabled = false;
        };
        grid.appendChild(el);
      });
    })
    .catch(err => {
      grid.innerHTML = `<div style="grid-column: 1 / -1; padding: 30px; text-align: center; color: #ef4444; font-size: 13px;">Gagal memuat media: ${err.message}</div>`;
    });
  };

  // 5. Unggah Berkas Baru via AJAX
  window.handleDirectUpload = function(files) {
    if (!files || !files.length) return;
    const file = files[0];
    const progressEl = document.getElementById('wpUploadProgress');
    progressEl.style.display = 'block';

    const formData = new FormData();
    formData.append('file', file);

    fetch('{{ route('backoffice.media-library.upload') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      progressEl.style.display = 'none';
      if (data.error) {
        alert('Gagal mengunggah gambar: ' + data.error);
        return;
      }

      // Berhasil, langsung pilih dan beralih ke library
      window.selectedMediaAsset = {
        url: data.location || data.url,
        alt_text: data.alt_text || file.name,
        filename: data.filename || file.name
      };

      document.getElementById('wpMediaSelectedInfo').innerText = `Terpilih: ${window.selectedMediaAsset.filename}`;
      document.getElementById('wpMediaInsertBtn').disabled = false;

      switchMediaTab('library');
      loadMediaLibrary(1);
    })
    .catch(err => {
      progressEl.style.display = 'none';
      alert('Terjadi kesalahan jaringan saat mengunggah: ' + err.message);
    });
  };

  // 6. Preview External URL
  window.previewExternalUrl = function(url) {
    const previewContainer = document.getElementById('wpUrlPreviewContainer');
    const previewImg = document.getElementById('wpUrlPreviewImg');
    if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
      previewImg.src = url;
      previewContainer.style.display = 'block';
      checkUrlInsertValidity();
    } else {
      previewContainer.style.display = 'none';
      checkUrlInsertValidity();
    }
  };

  function checkUrlInsertValidity() {
    const url = document.getElementById('wpUrlInput')?.value;
    const btn = document.getElementById('wpMediaInsertBtn');
    if (url && (url.startsWith('http://') || url.startsWith('https://'))) {
      btn.disabled = false;
      document.getElementById('wpMediaSelectedInfo').innerText = 'Gambar eksternal siap disisipkan.';
    } else {
      btn.disabled = true;
    }
  }

  // 7. Sisipkan Gambar ke Editor yang Sedang Aktif
  window.insertSelectedMedia = function() {
    if (!window.selectedMediaAsset) return;

    let imgUrl = '';
    let altText = '';

    if (window.selectedMediaAsset.isUrl) {
      imgUrl = document.getElementById('wpUrlInput').value.trim();
      altText = document.getElementById('wpUrlAltInput').value.trim() || 'Product image';
    } else {
      imgUrl = window.selectedMediaAsset.url;
      altText = window.selectedMediaAsset.alt_text || window.selectedMediaAsset.filename;
    }

    if (!imgUrl) return;

    const imgTag = `<p><img src="${imgUrl}" alt="${altText}" style="max-width: 100%; height: auto; border-radius: 4px;" /></p>`;

    const editorId = window.currentActiveWpEditorId;
    const ed = tinymce.get(editorId);

    if (ed && !ed.isHidden()) {
      ed.insertContent(imgTag);
    } else {
      const textarea = document.getElementById(editorId);
      if (textarea) {
        textarea.value += '\n' + imgTag;
      }
    }

    closeWpMediaModal();
  };

  // 8. Auto-submit safety: Pastikan seluruh konten TinyMCE tersimpan ke textarea saat submit form
  document.addEventListener('DOMContentLoaded', () => {
    initClassicTinyMCE();

    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', () => {
        if (window.tinymce) {
          tinymce.triggerSave();
        }
      });
    });
  });

})();
</script>
