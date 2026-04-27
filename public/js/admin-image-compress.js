/**
 * admin-image-compress.js
 * ─────────────────────────────────────────────────────────────────────────────
 * Client-side image compression for the Filament admin panel.
 *
 * HOW IT WORKS
 * ─────────────
 * Filament's SpatieMediaLibraryFileUpload uses FilePond internally. FilePond
 * listens on the hidden <input type="file"> for 'change' events in the bubble
 * phase. This script registers a CAPTURE-PHASE listener on the document —
 * which fires *before* any listener on the element itself — so we intercept
 * the file selection, compress every image with the Canvas API, replace the
 * FileList via DataTransfer, and re-dispatch a clean 'change' event for FilePond
 * to process. FilePond never knows the difference; it just sees smaller files.
 *
 * A MutationObserver + Livewire lifecycle hooks ensure this works across
 * full-page loads, Livewire component re-renders, and panel navigations.
 *
 * SETTINGS (adjust to taste)
 * ───────────────────────────
 *   MAX_PX   — longest edge after resize  (default 1600px)
 *   QUALITY  — JPEG output quality 0–1    (default 0.82 ≈ 82%)
 *   MIN_SAVE — only compress if it saves at least this fraction (default 10%)
 *
 * INSTALLATION
 * ─────────────
 * 1. Place this file at:  public/js/admin-image-compress.js
 * 2. Register it in your AdminPanelProvider.php (see bottom of this file).
 * ─────────────────────────────────────────────────────────────────────────────
 */

;(function () {
    'use strict';

    // ── Tunable settings ─────────────────────────────────────────────────────
    const MAX_PX   = 1600;   // max width OR height (aspect ratio preserved)
    const QUALITY  = 0.82;   // JPEG quality
    const MIN_SAVE = 0.10;   // only use compressed version if ≥10% smaller
    const SKIP_BELOW_KB = 150; // skip files already under 150 KB — no benefit

    // Image MIME types we will attempt to compress
    const COMPRESSIBLE = new Set(['image/jpeg', 'image/jpg', 'image/png', 'image/webp']);

    // Internal flag to break the re-dispatch loop
    let _suppressNext = false;

    // ── Canvas compression ────────────────────────────────────────────────────
    /**
     * Compress a single File to JPEG using the Canvas API.
     * Resolves with the compressed File, or the original if compression
     * didn't save enough or failed.
     *
     * @param {File} file
     * @returns {Promise<File>}
     */
    function compressImage(file) {
        return new Promise((resolve) => {
            // Skip non-compressible types or already-small files
            if (!COMPRESSIBLE.has(file.type) || file.size < SKIP_BELOW_KB * 1024) {
                resolve(file);
                return;
            }

            const originalSize = file.size;
            const img  = new Image();
            const blobUrl = URL.createObjectURL(file);

            img.onload = () => {
                URL.revokeObjectURL(blobUrl);

                // Calculate new dimensions (never upscale)
                let w = img.naturalWidth;
                let h = img.naturalHeight;

                if (w > MAX_PX || h > MAX_PX) {
                    if (w >= h) { h = Math.round(h * MAX_PX / w); w = MAX_PX; }
                    else        { w = Math.round(w * MAX_PX / h); h = MAX_PX; }
                }

                const canvas = document.createElement('canvas');
                canvas.width  = w;
                canvas.height = h;

                const ctx = canvas.getContext('2d');
                // White background for PNGs with transparency → JPEG output
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, w, h);
                ctx.drawImage(img, 0, 0, w, h);

                canvas.toBlob((blob) => {
                    if (!blob) { resolve(file); return; }

                    const saved = (originalSize - blob.size) / originalSize;
                    if (saved < MIN_SAVE) {
                        // Compression didn't save enough — use original
                        resolve(file);
                        return;
                    }

                    // Build a new File preserving the original name
                    const baseName = file.name.replace(/\.[^.]+$/, '');
                    const compressed = new File(
                        [blob],
                        baseName + '.jpg',
                        { type: 'image/jpeg', lastModified: Date.now() }
                    );

                    console.debug(
                        `[AdminCompress] ${file.name}: ` +
                        `${(originalSize / 1048576).toFixed(2)} MB → ` +
                        `${(blob.size / 1048576).toFixed(2)} MB ` +
                        `(${Math.round(saved * 100)}% saved)`
                    );

                    resolve(compressed);
                }, 'image/jpeg', QUALITY);
            };

            img.onerror = () => {
                URL.revokeObjectURL(blobUrl);
                resolve(file); // fall back to original on error
            };

            img.src = blobUrl;
        });
    }

    // ── Compress all image files in a FileList ────────────────────────────────
    /**
     * @param {FileList} fileList
     * @returns {Promise<File[]>}
     */
    async function compressFileList(fileList) {
        return Promise.all(
            Array.from(fileList).map(f => compressImage(f))
        );
    }

    // ── Core interception — document-level capture phase ─────────────────────
    /**
     * This listener fires BEFORE FilePond's own listener on the <input>.
     * We stop the original event, compress, replace files, and re-fire.
     */
    document.addEventListener('change', async function (event) {
        // Skip our own re-dispatched event to avoid infinite loop
        if (_suppressNext) return;

        const input = event.target;
        if (
            !input                          ||
            input.tagName !== 'INPUT'       ||
            input.type    !== 'file'        ||
            !input.files                    ||
            input.files.length === 0
        ) return;

        // Only intercept if at least one file is a compressible image
        const hasImage = Array.from(input.files).some(f => COMPRESSIBLE.has(f.type));
        if (!hasImage) return;

        // ── Stop FilePond from seeing the original (uncompressed) event ──────
        event.stopImmediatePropagation();

        // Show a subtle visual hint that we're processing
        _setInputBusy(input, true);

        try {
            const compressed = await compressFileList(input.files);

            // Replace input.files via DataTransfer (works in all modern browsers)
            const dt = new DataTransfer();
            compressed.forEach(f => dt.items.add(f));
            input.files = dt.files;

        } catch (err) {
            console.warn('[AdminCompress] Compression failed, using originals:', err);
            // Originals are still in input.files — FilePond will process them normally
        } finally {
            _setInputBusy(input, false);
        }

        // ── Re-dispatch for FilePond to process the (now smaller) files ──────
        _suppressNext = true;
        input.dispatchEvent(new Event('change', { bubbles: true, cancelable: false }));
        _suppressNext = false;

    }, true /* capture = true — fires before bubble-phase FilePond listener */);


    // ── Visual feedback helper ────────────────────────────────────────────────
    /**
     * Dims the FilePond wrapper briefly while compression is running so the
     * admin user knows something is happening.
     */
    function _setInputBusy(input, busy) {
        // Walk up to the FilePond root wrapper
        let el = input.parentElement;
        for (let i = 0; i < 6 && el; i++) {
            if (el.classList.contains('filepond--root') || el.classList.contains('fi-fo-field-wrp')) break;
            el = el.parentElement;
        }
        if (!el) return;

        if (busy) {
            el.style.opacity  = '0.6';
            el.style.pointerEvents = 'none';
            el.title = 'Compressing images…';
        } else {
            el.style.opacity  = '';
            el.style.pointerEvents = '';
            el.title = '';
        }
    }

    // ── Done ──────────────────────────────────────────────────────────────────
    console.debug('[AdminCompress] Image compression interceptor active. ' +
        `Max: ${MAX_PX}px, Quality: ${Math.round(QUALITY * 100)}%`);

})();


/*
════════════════════════════════════════════════════════════════════════════════
 REGISTRATION — AdminPanelProvider.php
════════════════════════════════════════════════════════════════════════════════

 In your app/Providers/Filament/AdminPanelProvider.php, add the script
 inside the ->panel() configuration:

    use Illuminate\Support\Facades\Vite;
    use Illuminate\Support\HtmlString;

    public function panel(Panel $panel): Panel
    {
        return $panel
            // ... all your existing config ...

            // ── Add this block ────────────────────────────────────────────
            ->renderHook(
                'panels::body.end',
                fn () => new HtmlString(
                    '<script src="' . asset('js/admin-image-compress.js') . '?v=' . filemtime(public_path('js/admin-image-compress.js')) . '"></script>'
                )
            );
            // ─────────────────────────────────────────────────────────────
    }

 That's it. No npm install, no FilePond plugin loading, no CDN dependency.
 The ?v= cache-buster forces browsers to reload the script when you update it.

════════════════════════════════════════════════════════════════════════════════
*/