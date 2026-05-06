<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    
     <?php $__env->slot('title', null, []); ?> 
        <?php echo e($editorial->title); ?> | <?php echo e(config('app.name')); ?>

     <?php $__env->endSlot(); ?>

    
     <?php $__env->slot('meta', null, []); ?> 
        
        <meta name="description" content="<?php echo e(Str::limit(strip_tags($editorial->content), 155)); ?>">
        <meta name="author" content="AgencyMarket">
        
        
        <meta property="og:type" content="article">
        <meta property="og:title" content="<?php echo e($editorial->title); ?>">
        <meta property="og:description" content="<?php echo e(Str::limit(strip_tags($editorial->content), 155)); ?>">
        <meta property="og:url" content="<?php echo e(Request::fullUrl()); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editorial->featured_image): ?>
            <meta property="og:image" content="<?php echo e(asset('storage/' . $editorial->featured_image)); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <meta property="article:published_time" content="<?php echo e($editorial->published_at->toIso8601String()); ?>">

        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo e($editorial->title); ?>">
        <meta name="twitter:description" content="<?php echo e(Str::limit(strip_tags($editorial->content), 155)); ?>">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editorial->featured_image): ?>
            <meta name="twitter:image" content="<?php echo e(asset('storage/' . $editorial->featured_image)); ?>">
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
     <?php $__env->endSlot(); ?>
    <style>
        .article-container { max-width: 840px; margin: 60px auto 100px; padding: 0 20px; }
        
        .article-meta { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); text-align: center; margin-bottom: 20px; }
        .article-title { font-family: 'Jost', sans-serif; font-size: 3.8rem; font-weight: 400; color: var(--text-primary); text-align: center; line-height: 1.1; margin-bottom: 40px; }
        
        /* High Quality Image Rendering */
        .article-media { width: 100%; margin-bottom: 40px; box-shadow: var(--shadow-lg); }
        .article-media img { 
            width: 100%; height: auto; display: block; 
            image-rendering: -webkit-optimize-contrast; /* Forces HD rendering in Chrome/Safari */
            image-rendering: high-quality;
        }
        
        /* Video Embeds */
        .video-wrapper { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; background: #000; }
        .video-wrapper iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }

        /* Article Prose */
        .prose { color: var(--text-secondary); font-size: 1.2rem; line-height: 1.8; font-weight: 300; margin-bottom: 60px; }
        .prose p { margin-bottom: 24px; }
        .prose h2, .prose h3 { font-family: 'Jost', sans-serif; color: var(--text-primary); margin-top: 40px; margin-bottom: 20px; }
        .prose h2 { font-size: 2.2rem; }
        .prose h3 { font-size: 1.8rem; }
        .prose ul { margin-bottom: 24px; padding-left: 20px; }
        .prose li { margin-bottom: 10px; }

        /* ── Social Share ── */
        .article-share {
            display: flex; align-items: center; justify-content: center; gap: 16px;
            padding: 30px 0; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);
            margin-bottom: 60px;
        }
        .share-label { font-size: 0.65rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--text-muted); }
        .share-btn {
            width: 40px; height: 40px; border: 1px solid var(--border-strong); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: var(--text-secondary);
            transition: all 0.3s ease; background: var(--bg-surface);
        }
        .share-btn:hover { border-color: var(--gold); color: var(--gold); background: var(--gold-bg); transform: translateY(-3px); }
        .share-btn svg { width: 16px; height: 16px; fill: currentColor; }

        /* ── HD Gallery ── */
        .gallery-section { margin-top: 60px; }
        .gallery-title { font-family: 'Jost', sans-serif; font-size: 2.4rem; color: var(--text-primary); text-align: center; margin-bottom: 30px; }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .gallery-item {
            position: relative; aspect-ratio: 4/5; overflow: hidden;
            background: var(--bg-secondary); border-radius: 2px;
            cursor: zoom-in;
        }
        .gallery-item img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;
            image-rendering: high-quality;
        }
        .gallery-item:hover img { transform: scale(1.05); }

        .back-link { display: inline-flex; align-items: center; gap: 8px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 40px; transition: color 0.2s; }
        .back-link:hover { color: var(--gold); }

        @media (max-width: 768px) {
            .article-title { font-size: 2.5rem; }
            .article-container { margin-top: 40px; }
            .gallery-grid { gap: 10px; }
        }
    </style>

    <div class="article-container anim-fade-up">
        
        <a href="<?php echo e(route('editorial.index')); ?>" class="back-link">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Editorial
        </a>

        <div class="article-meta"><?php echo e($editorial->published_at->format('F d, Y')); ?></div>
        <h1 class="article-title"><?php echo e($editorial->title); ?></h1>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editorial->embed_code): ?>
            <div class="article-media video-wrapper">
                <?php echo $editorial->embed_code; ?>

            </div>
        <?php elseif($editorial->featured_image): ?>
            <div class="article-media">
                <img src="<?php echo e(asset('storage/' . $editorial->featured_image)); ?>" alt="<?php echo e($editorial->title); ?>">
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div style="margin-bottom: 40px;">
            <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'editorial_show_top'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        
        <div class="prose">
            <?php echo $editorial->content; ?>

        </div>

        
        <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'editorial_show_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
        
        <div class="article-share">
            <span class="share-label">Share:</span>
            
            
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(Request::fullUrl())); ?>" target="_blank" class="share-btn" aria-label="Share on Facebook">
                <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
            </a>
            
            
            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(Request::fullUrl())); ?>&text=<?php echo e(urlencode($editorial->title)); ?>" target="_blank" class="share-btn" aria-label="Share on X">
                <svg viewBox="0 0 24 24"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
            </a>
            
            
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(Request::fullUrl())); ?>" target="_blank" class="share-btn" aria-label="Share on LinkedIn">
                <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
            </a>

            
            <a href="https://api.whatsapp.com/send?text=<?php echo e(urlencode($editorial->title . ' - ' . Request::fullUrl())); ?>" target="_blank" class="share-btn" aria-label="Share on WhatsApp">
                <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
            </a>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($editorial->gallery && count($editorial->gallery) > 0): ?>
            <div class="gallery-section">
                <h3 class="gallery-title">Editorial Gallery</h3>
                <div class="gallery-grid">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $editorial->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        
                        <a href="<?php echo e(asset('storage/' . $image)); ?>" target="_blank" class="gallery-item">
                            <img src="<?php echo e(asset('storage/' . $image)); ?>" alt="<?php echo e($editorial->title); ?> - Editorial Image" loading="lazy">
                        </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div style="margin-top: 40px;">
            <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'editorial_show_footer'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/dhakamodel/dhakamodel/resources/views/editorial/show.blade.php ENDPATH**/ ?>