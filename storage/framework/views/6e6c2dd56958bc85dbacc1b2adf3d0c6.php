<div>
    <style>
        /* ═══════════════════════════════════════════
           FEATURED VIDEOS PAGE
        ═══════════════════════════════════════════ */
        .video-page-container {
            max-width: 1440px;
            margin: 0 auto;
            padding: 80px 40px 120px;
        }

        /* ── Header ── */
        .video-header {
            text-align: center;
            margin-bottom: 60px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .video-eyebrow {
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
        .video-eyebrow::before,
        .video-eyebrow::after {
            content: '';
            width: 30px; height: 1px;
            background: var(--gold);
            opacity: 0.6;
        }
        .video-title {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 3.5rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 20px;
        }
        .video-title strong { font-weight: 600; font-style: italic; color: var(--gold); }
        .video-sub {
            font-size: 1.05rem;
            color: var(--text-secondary);
            line-height: 1.6;
            font-weight: 300;
        }

        /* ── Video Grid ── */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        /* ── Video Card ── */
        .video-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            transition: border-color 0.4s, transform 0.4s, box-shadow 0.4s;
            box-shadow: var(--shadow-sm);
        }
        .video-card:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        /* ── Media Player Area ── */
        .video-media-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            background: #000;
            overflow: hidden;
            border-bottom: 1px solid var(--border);
        }
        .video-thumbnail {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.75;
            transition: opacity 0.4s, transform 0.6s;
        }
        .video-card:hover .video-thumbnail {
            opacity: 0.9;
            transform: scale(1.03);
        }

        /* Play Button Overlay */
        .play-overlay {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
        }
        .play-btn {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s, background 0.3s;
            color: var(--text-primary);
        }
        .video-card:hover .play-btn {
            transform: scale(1.1);
            color: var(--gold);
        }
        .play-btn svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
            margin-left: 4px; /* Optically centers the play triangle */
        }

        /* Iframe */
        .video-iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: 0;
            z-index: 20;
        }

        /* ── Text Content ── */
        .video-content {
            padding: 24px 28px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .video-card-title {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.2;
            margin-bottom: 12px;
            transition: color 0.3s;
        }
        .video-card:hover .video-card-title {
            color: var(--gold);
        }
        .video-desc {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* ── Empty State ── */
        .video-empty {
            text-align: center;
            padding: 80px 20px;
            background: var(--bg-surface);
            border: 1px dashed var(--border-strong);
            margin-top: 40px;
        }
        .video-empty svg {
            width: 48px; height: 48px;
            color: var(--text-muted);
            margin: 0 auto 16px;
            opacity: 0.5;
        }
        .video-empty-title {
            font-family: 'SolaimanLipi', sans-serif;
            font-size: 2.2rem;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        .video-empty-sub {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .video-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
        }
        @media (max-width: 768px) {
            .video-page-container { padding: 60px 20px 80px; }
            .video-title { font-size: 2.8rem; }
            .video-grid { grid-template-columns: 1fr; gap: 24px; }
        }
    </style>

    <div class="video-page-container anim-fade-up">
        
        
        <div class="video-header">
            <div class="video-eyebrow">Our Portfolio</div>
            <h1 class="video-title">Featured <strong>Videos</strong></h1>
            <p class="video-sub">
                Watch behind-the-scenes footage, exclusive interviews, and stunning portfolio reels from our top talent.
            </p>
        </div>

        
        <div class="video-grid anim-fade-up anim-d1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->embed_url || $video->is_facebook): ?>
                    <div class="video-card">
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->is_facebook): ?>
                            
                            <a href="<?php echo e($video->url); ?>" target="_blank" rel="noopener noreferrer" class="video-media-wrap">
                                <img src="<?php echo e($video->smart_thumbnail); ?>" class="video-thumbnail" alt="<?php echo e($video->title); ?>">
                                <div class="play-overlay">
                                    <div class="play-btn">
                                        <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            
                            <div x-data="{ playing: false }" class="video-media-wrap"> 
                                <template x-if="!playing">
                                    <div @click="playing = true" class="play-overlay">
                                        <img src="<?php echo e($video->smart_thumbnail); ?>" class="video-thumbnail" alt="<?php echo e($video->title); ?>">
                                        <div class="play-btn">
                                            <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="playing">
                                    <iframe 
                                        src="<?php echo e($video->embed_url); ?>" 
                                        class="video-iframe"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                </template>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="video-content">
                            <h3 class="video-card-title">
                                <?php echo e($video->title); ?>

                            </h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($video->description): ?>
                                <p class="video-desc">
                                    <?php echo e($video->description); ?>

                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        
                    </div>

                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->iteration % 6 == 0): ?>
                        <div style="grid-column: 1 / -1; width: 100%; padding: 10px 0;">
                            <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'video_in_feed'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $attributes = $__attributesOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__attributesOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $component = $__componentOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__componentOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <div style="margin-top: 40px;">
            <?php echo e($videos->links('vendor.pagination.custom-numbered')); ?>

        </div>
        
        <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'video_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $attributes = $__attributesOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__attributesOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $component = $__componentOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__componentOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($videos->isEmpty()): ?>
            <div class="video-empty anim-fade-up anim-d2">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <h3 class="video-empty-title">No videos published yet</h3>
                <p class="video-empty-sub">Check back soon for new visual content and campaign reels!</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div><?php /**PATH H:\agency-app\resources\views/livewire/video-gallery.blade.php ENDPATH**/ ?>