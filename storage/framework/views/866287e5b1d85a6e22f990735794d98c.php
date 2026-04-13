<div x-data="{ modalOpen: false, modalImage: '', modalCaption: '' }" @keydown.escape.window="modalOpen = false">
    <style>
        /* ═══════════════════════════════════════════
           FEATURED PHOTO GALLERY PAGE
        ═══════════════════════════════════════════ */
        .gallery-page-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 80px 40px 120px;
        }

        /* ── Header ── */
        .gallery-header {
            text-align: center;
            margin-bottom: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .gallery-eyebrow {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .gallery-eyebrow::before,
        .gallery-eyebrow::after {
            content: '';
            width: 30px; height: 1px;
            background: var(--gold);
            opacity: 0.6;
        }
        .gallery-title {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 3.5rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 20px;
        }
        .gallery-title strong { font-weight: 600; font-style: italic; color: var(--gold); }
        .gallery-sub {
            font-size: 1.05rem;
            color: var(--text-secondary);
            line-height: 1.6;
            font-weight: 300;
        }

        /* ── Masonry Grid ── */
        .masonry-grid {
            column-count: 4;
            column-gap: 24px;
        }

        /* ── Photo Card ── */
        .photo-card {
            break-inside: avoid; /* Prevents card from splitting across columns */
            margin-bottom: 24px;
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            background: #000;
        }
        
        .photo-card img {
            width: 100%;
            display: block;
            transition: transform 0.6s ease, opacity 0.4s ease;
            opacity: 0.9;
        }

        .photo-card:hover img {
            transform: scale(1.05);
            opacity: 1;
        }

        /* ── Caption Overlay ── */
        .photo-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 50%);
            display: flex;
            align-items: flex-end;
            padding: 24px;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .photo-card:hover .photo-overlay {
            opacity: 1;
        }

        .photo-caption {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 500;
            font-family: 'SolaimanLipi', sans-serif;
            transform: translateY(10px);
            transition: transform 0.4s ease;
        }

        .photo-card:hover .photo-caption {
            transform: translateY(0);
        }

        /* ── Modal Styles ── */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            backdrop-filter: blur(5px);
        }

        .modal-content {
            position: relative;
            max-width: 90vw;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .modal-content img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }

        .modal-caption {
            color: #fff;
            margin-top: 16px;
            font-size: 1.2rem;
            font-weight: 300;
            text-align: center;
            font-family: 'SolaimanLipi', sans-serif;
        }

        .modal-close {
            position: absolute;
            top: -40px;
            right: 0;
            color: #fff;
            cursor: pointer;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s, color 0.3s;
        }

        .modal-close:hover {
            background: var(--gold);
            color: #000;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .masonry-grid { column-count: 3; }
        }
        @media (max-width: 768px) {
            .gallery-page-container { padding: 60px 20px 80px; }
            .gallery-title { font-size: 2.8rem; }
            .masonry-grid { column-count: 2; } /* Changed from 1 to 2 for mobile */
            .modal-backdrop { padding: 20px; }
            .modal-close { top: -40px; right: 0; }
        }
    </style>

    <div class="gallery-page-container anim-fade-up">
        
        
        <div class="gallery-header">
            <div class="gallery-eyebrow">Our Portfolio</div>
            <h1 class="gallery-title">Featured <strong>Gallery</strong></h1>
            <p class="gallery-sub">
                Explore our high-quality visual captures, professional modeling shots, and event highlights.
            </p>
        </div>

        
        <div class="masonry-grid anim-fade-up anim-d1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $photos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="photo-card" 
                     @click="modalOpen = true; modalImage = '<?php echo e(Storage::url($photo->image)); ?>'; modalCaption = '<?php echo e(addslashes($photo->caption)); ?>'">
                    
                    <img src="<?php echo e(Storage::url($photo->image)); ?>" alt="<?php echo e($photo->caption ?? 'Gallery Image'); ?>" loading="lazy">
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photo->caption): ?>
                        <div class="photo-overlay">
                            <h3 class="photo-caption"><?php echo e($photo->caption); ?></h3>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div style="margin-top: 40px;">
            <?php echo e($photos->links('vendor.pagination.custom-numbered')); ?>

        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photos->isEmpty()): ?>
            <div class="video-empty anim-fade-up anim-d2" style="text-align: center; padding: 80px 20px; border: 1px dashed var(--border-strong); margin-top: 40px;">
                <h3 style="font-size: 2rem; margin-bottom: 8px;">No photos published yet</h3>
                <p style="color: var(--text-muted);">Check back soon for new visual content!</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>

    
    <div x-show="modalOpen" style="display: none;" class="modal-backdrop" x-transition.opacity>
        <div class="modal-content" @click.away="modalOpen = false">
            <div class="modal-close" @click="modalOpen = false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
            
            <img :src="modalImage" alt="Preview">
            
            <p x-show="modalCaption" x-text="modalCaption" class="modal-caption"></p>
        </div>
    </div>

</div><?php /**PATH H:\agency-app\resources\views/livewire/photo-gallery-page.blade.php ENDPATH**/ ?>