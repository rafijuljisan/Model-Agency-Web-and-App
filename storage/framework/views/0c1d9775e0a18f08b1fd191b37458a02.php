<div>
    <style>
        /* =============================================
           FONT SETUP — SolaimanLipi for Bangla (Priority)
           NOTE: Fixed spelling: was 'SolaimnanLipi' (wrong) → 'SolaimanLipi' (correct)
        ============================================= */
        @font-face {
            font-family: 'SolaimanLipi';
            src: local('SolaimanLipi'),
                url('/fonts/SolaimanLipi.woff2') format('woff2'),
                url('/fonts/SolaimanLipi.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        /* =============================================
           CSS CUSTOM PROPERTIES — fluid type scale
           Uses clamp(min, preferred, max) so text
           grows/shrinks smoothly between breakpoints
           without needing 4 media queries per rule.
        ============================================= */
        :root {
            --font-bangla: 'SolaimanLipi', 'Jost', sans-serif;
            --font-latin: 'Jost', 'SolaimanLipi', sans-serif;

            /* Fluid type scale — slightly increased across all levels */
            --text-xs: clamp(0.85rem, 1.8vw, 0.95rem);
            /* labels, captions */
            --text-sm: clamp(0.95rem, 2.2vw, 1.1rem);
            /* meta, tags */
            --text-base: clamp(1.1rem, 2.4vw, 1.25rem);
            /* body text */
            --text-md: clamp(1.15rem, 2.6vw, 1.35rem);
            /* module topics, benefit desc */
            --text-lg: clamp(1.25rem, 2.8vw, 1.5rem);
            /* benefit titles, section labels */
            --text-xl: clamp(1.4rem, 3.2vw, 2rem);
            /* section headings */
            --text-2xl: clamp(1.7rem, 4.2vw, 2.6rem);
            /* sidebar price */
            --text-3xl: clamp(1.85rem, 5.2vw, 3rem);
            /* hero title */
        }

        /* =============================================
           HERO SECTION
        ============================================= */
        .course-hero {
            background: var(--bg-secondary);
            padding: clamp(24px, 5vw, 60px) clamp(16px, 4vw, 40px);
            border-bottom: 1px solid var(--border);
        }

        .course-hero__inner {
            max-width: 1440px;
            margin: 0 auto;
        }

        .course-hero__back {
            color: var(--gold);
            font-size: var(--text-sm);
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 16px;
            font-family: var(--font-bangla);
        }

        .course-title {
            font-family: var(--font-bangla);
            font-size: var(--text-3xl);
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .course-status-badge {
            display: inline-block;
            padding: 4px 12px;
            background: var(--gold-bg);
            color: var(--gold);
            font-weight: 600;
            font-size: var(--text-xs);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* =============================================
           LAYOUT — 2-col desktop, 1-col mobile
           Sidebar moves ABOVE content on mobile so
           users see price + CTA without scrolling.
        ============================================= */
        .course-layout {
            max-width: 1440px;
            margin: 0 auto;
            padding: clamp(24px, 4vw, 56px) clamp(16px, 4vw, 40px) clamp(48px, 6vw, 80px);
            display: grid;
            grid-template-columns: 1fr 380px;
            grid-template-areas: "main sidebar";
            gap: clamp(24px, 4vw, 48px);
            align-items: start;
        }

        .course-main {
            grid-area: main;
        }

        .course-sidebar {
            grid-area: sidebar;
        }

        /* =============================================
           SECTION HEADINGS
        ============================================= */
        .course-section-title {
            font-family: var(--font-bangla);
            font-size: var(--text-xl);
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        /* =============================================
           COURSE OVERVIEW TEXT
        ============================================= */
        .course-text {
            font-family: var(--font-bangla);
            font-size: var(--text-base);
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 40px;
        }

        /* =============================================
           BENEFITS GRID
        ============================================= */
        .course-benefits-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 40px;
        }

        .c-benefit-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: clamp(16px, 2vw, 24px);
            border-radius: 6px;
        }

        .c-benefit-title {
            font-family: var(--font-bangla);
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            display: flex;
            align-items: flex-start;
            gap: 8px;
            line-height: 1.4;
        }

        .c-benefit-title svg {
            color: var(--gold);
            flex-shrink: 0;
            margin-top: 3px;
        }

        .c-benefit-desc {
            font-family: var(--font-bangla);
            font-size: var(--text-md);
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* =============================================
           COURSE MODULES
        ============================================= */
        .course-module {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: clamp(16px, 2vw, 24px);
            margin-bottom: 14px;
            border-radius: 6px;
        }

        .c-module-name {
            font-family: var(--font-bangla);
            font-size: var(--text-lg);
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        .c-module-topics {
            font-family: var(--font-bangla);
            font-size: var(--text-base);
            color: var(--text-primary);
            line-height: 1.7;
        }

        /* =============================================
           AD SLOTS
        ============================================= */
        .ad-slot {
            margin-bottom: 32px;
        }

        /* =============================================
           STICKY SIDEBAR
        ============================================= */
        .course-sidebar {
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            padding: clamp(20px, 3vw, 32px);
            position: sticky;
            top: 24px;
            border-radius: 8px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
        }

        .sidebar-price {
            font-family: var(--font-latin);
            font-size: var(--text-2xl);
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-meta {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-bottom: 28px;
        }

        .sidebar-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .sidebar-meta-item svg {
            color: var(--text-muted);
            margin-top: 2px;
            flex-shrink: 0;
        }

        .s-meta-label {
            font-size: var(--text-xs);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 2px;
            display: flex;
            justify-content: space-between;
        }

        .s-meta-value {
            font-family: var(--font-bangla);
            font-size: var(--text-base);
            color: var(--text-primary);
            font-weight: 500;
        }

        .s-schedule-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 8px;
            flex-wrap: nowrap;
            padding: 6px 10px;
            background: var(--bg-secondary);
            border-radius: 4px;
            border: 1px solid var(--border);
        }

        .s-schedule-day {
            color: var(--text-primary);
            font-weight: 500;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .s-schedule-time {
            color: var(--gold);
            font-weight: 600;
            white-space: nowrap;
            text-align: right;
            flex-shrink: 0;
        }

        /* Seat progress bar */
        .seat-bar-track {
            height: 4px;
            background: var(--border);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 6px;
        }

        .seat-bar-fill {
            height: 100%;
            background: var(--gold);
            border-radius: 4px;
        }

        /* CTA Button */
        .btn-apply {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            padding: 14px 20px;
            font-size: var(--text-base);
            font-family: var(--font-bangla);
            font-weight: 600;
            text-decoration: none;
        }

        /* =============================================
           MOBILE STICKY CTA BAR
           Appears fixed at bottom on small screens.
           Hidden on desktop (sidebar handles CTA).
        ============================================= */
        .mobile-cta-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: var(--bg-surface);
            border-top: 1px solid var(--border-strong);
            padding: 12px 16px;
            z-index: 100;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.08);
        }

        .mobile-cta-price {
            font-family: var(--font-latin);
            font-size: var(--text-xl);
            font-weight: 700;
            color: var(--gold);
        }

        .mobile-cta-btn {
            flex: 1;
            max-width: 200px;
            text-align: center;
            padding: 12px 20px;
            font-family: var(--font-bangla);
            font-size: var(--text-base);
            font-weight: 600;
            text-decoration: none;
        }

        /* =============================================
   SOCIAL SHARE BUTTONS
============================================= */
        .share-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        .share-label {
            font-size: var(--text-xs);
            font-family: var(--font-bangla);
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
            margin-right: 4px;
        }

        .share-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 14px;
            border-radius: 5px;
            font-size: var(--text-sm);
            font-family: var(--font-bangla);
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid transparent;
            cursor: pointer;
            background: none;
            transition: opacity 0.15s ease, transform 0.15s ease;
            white-space: nowrap;
        }

        .share-btn:hover {
            opacity: 0.82;
            transform: translateY(-1px);
        }

        .share-btn:active {
            transform: translateY(0);
        }

        .share-btn--facebook {
            background: #1877F2;
            color: #fff;
            border-color: #1877F2;
        }

        .share-btn--instagram {
            background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            color: #fff;
            border-color: transparent;
        }

        .share-btn--copy {
            background: var(--bg-surface);
            color: var(--text-primary);
            border-color: var(--border-strong);
        }

        /* Copied state feedback */
        .share-btn--copy.copied {
            color: #16a34a;
            border-color: #16a34a;
        }

        @media (max-width: 480px) {
            .share-btn span {
                display: none;
                /* icon only on very small screens */
            }

            .share-btn {
                padding: 8px 10px;
            }
        }

        /* =============================================
           BREAKPOINTS
        ============================================= */

        /* ---- TABLET: 768px – 1100px ---- */
        @media (max-width: 1100px) {
            .course-layout {
                grid-template-columns: 1fr 320px;
            }
        }

        /* ---- TABLET PORTRAIT / LARGE PHONE: 600px – 768px ---- */
        @media (max-width: 768px) {
            .course-layout {
                grid-template-columns: 1fr;
                /* On mobile: sidebar floats to top so price/CTA is immediately visible */
                grid-template-areas:
                    "sidebar"
                    "main";
            }

            .course-sidebar {
                position: static;
                top: auto;
            }

            /* On mobile the fixed bar handles CTA — hide sidebar button to avoid duplication */
            .course-sidebar .btn-apply {
                display: none;
            }

            /* Show mobile sticky CTA bar */
            .mobile-cta-bar {
                display: flex;
            }

            /* Add padding so content isn't hidden behind fixed bar */
            .course-layout {
                padding-bottom: 80px;
            }

            .course-benefits-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ---- SMALL PHONE: < 480px ---- */
        @media (max-width: 480px) {
            .course-hero {
                padding: 20px 14px;
            }

            .course-sidebar {
                border-radius: 6px;
                padding: 16px;
            }

            .sidebar-meta {
                gap: 12px;
            }
        }
    </style>

    
    <div class="course-hero">
        <div class="course-hero__inner">
            <a href="/grooming-lab" class="course-hero__back">
                &larr; Back to All Courses
            </a>
            <h1 class="course-title"><?php echo e($batch->title); ?></h1>
            <div class="share-bar">
                <span class="share-label">Share:</span>

                
                <a class="share-btn share-btn--facebook"
                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>"
                    target="_blank" rel="noopener noreferrer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                    <span>Facebook</span>
                </a>

                
                <button class="share-btn share-btn--instagram" onclick="shareInstagram()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <circle cx="12" cy="12" r="4" />
                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />
                    </svg>
                    <span>Instagram</span>
                </button>

                
                <button class="share-btn share-btn--copy" id="copyLinkBtn" onclick="copyPageLink()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                    </svg>
                    <span id="copyLinkText">Copy Link</span>
                </button>
            </div>
            <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap; margin-top: 8px;">
                <span class="course-status-badge">
                    <?php echo e($batch->status === 'open' ? 'Open for Admission' : ($batch->status === 'filling_fast' ? 'Filling Fast' : 'Admission Closed')); ?>

                </span>
            </div>
        </div>
    </div>

    
    <div class="course-layout">

        
        <div class="course-main">
            <div class="ad-slot">
                <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'batch_show_top'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->description): ?>
                <h2 class="course-section-title">Course Overview</h2>
                <div class="course-text">
                    <?php echo $batch->description; ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($batch->benefits)): ?>
                <h2 class="course-section-title">What You Will Learn in This Class?</h2>
                <div class="course-benefits-grid">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $batch->benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="c-benefit-card">
                            <div class="c-benefit-title">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                                <?php echo e($benefit['title']); ?>

                            </div>
                            <div class="c-benefit-desc">
                                <?php echo e($benefit['description']); ?>

                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="ad-slot">
                <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'batch_show_middle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($batch->course_modules)): ?>
                <h2 class="course-section-title">Course Modules</h2>
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $batch->course_modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="course-module">
                            <div class="c-module-name"><?php echo e($module['module_name']); ?></div>
                            <div class="c-module-topics"><?php echo e($module['topics']); ?></div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="course-sidebar">
            <div class="sidebar-price">৳<?php echo e(number_format($batch->fee)); ?></div>

            <div class="sidebar-meta">
                
                <div class="sidebar-meta-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <div>
                        <div class="s-meta-label">Start Date</div>
                        <div class="s-meta-value"><?php echo e($batch->start_date->format('d F, Y')); ?></div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($batch->schedule_json)): ?>
                    <div class="sidebar-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        <div style="width: 100%;">
                            <div class="s-meta-label">Class Schedule</div>
                            <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 4px;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $batch->schedule_json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="s-schedule-row">
                                        <span class="s-schedule-day"><?php echo e($s['day'] ?? ''); ?></span>
                                        <span class="s-schedule-time"><?php echo e($s['time'] ?? ''); ?></span>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->trainer): ?>
                    <div class="sidebar-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <div>
                            <div class="s-meta-label">Lead Trainer</div>
                            <div class="s-meta-value"><?php echo e($batch->trainer); ?></div>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div class="sidebar-meta-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <div style="width: 100%;">
                        <div class="s-meta-label">
                            <span>Seats</span>
                            <span><?php echo e($batch->filled_seats); ?>/<?php echo e($batch->seat_limit); ?></span>
                        </div>
                        <div class="seat-bar-track">
                            <div class="seat-bar-fill"
                                style="width: <?php echo e($batch->fill_percentage ?? ($batch->filled_seats / $batch->seat_limit * 100)); ?>%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <a href="/grooming-lab" class="btn-fill btn-apply">Apply Now</a>

            
            <div class="share-bar" style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
                <span class="share-label">Share:</span>
                <a class="share-btn share-btn--facebook"
                    href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>"
                    target="_blank" rel="noopener noreferrer">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                    </svg>
                </a>
                <button class="share-btn share-btn--instagram" onclick="shareInstagram()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <circle cx="12" cy="12" r="4" />
                        <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none" />
                    </svg>
                </button>
                <button class="share-btn share-btn--copy" id="copyLinkBtn2"
                    onclick="copyPageLink('copyLinkBtn2', 'copyLinkText2')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                    </svg>
                </button>
            </div>

            
            <div style="margin-top: 24px;">
                <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'batch_show_sidebar'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    </div>

    
    <div class="mobile-cta-bar">
        <span class="mobile-cta-price">৳<?php echo e(number_format($batch->fee)); ?></span>
        <a href="/grooming-lab" class="btn-fill mobile-cta-btn">Apply Now</a>
    </div>
    <script>
        function copyPageLink(btnId = 'copyLinkBtn', textId = 'copyLinkText') {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                const btn = document.getElementById(btnId);
                const text = document.getElementById(textId);
                if (btn) btn.classList.add('copied');
                if (text) text.textContent = 'Copied!';
                setTimeout(() => {
                    if (btn) btn.classList.remove('copied');
                    if (text) text.textContent = 'Copy Link';
                }, 2000);
            }).catch(() => {
                // Fallback for older browsers
                const el = document.createElement('textarea');
                el.value = window.location.href;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
            });
        }

        function shareInstagram() {
            // Instagram has no web share API.
            // Copy the link first, then open Instagram so user can paste in Story/DM.
            copyPageLink();
            setTimeout(() => {
                window.open('https://www.instagram.com/', '_blank');
            }, 600);
        }
    </script>
</div><?php /**PATH H:\agency-app\resources\views/livewire/grooming-batch-show.blade.php ENDPATH**/ ?>