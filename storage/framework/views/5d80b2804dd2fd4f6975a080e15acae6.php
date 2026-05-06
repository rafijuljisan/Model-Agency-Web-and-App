<div>
<style>
@font-face {
    font-family: 'SolaimanLipi';
    src: local('SolaimanLipi'),
         url('/fonts/SolaimanLipi.woff2') format('woff2'),
         url('/fonts/SolaimanLipi.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

:root {
    --font-bangla: 'SolaimanLipi', 'Jost', sans-serif;
}

.form-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 48px 40px 80px;
    font-family: var(--font-bangla);
}

/* ── PAGE HEADER ─────────────────────────────── */
.form-page-header {
    margin-bottom: 40px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--border);
}
.form-page-eyebrow {
    font-size: 1.35rem;
    font-weight: 600;
    color: var(--gold);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-page-eyebrow::before {
    content: '';
    width: 24px;
    height: 1px;
    background: var(--gold);
}
.form-page-title {
    font-family: var(--font-bangla);
    font-size: 3.2rem;
    font-weight: 400;
    color: var(--text-primary);
    line-height: 1.2;
}
.form-page-title strong { font-weight: 700; }
.form-page-sub {
    font-size: 1.35rem;
    color: var(--text-muted);
    margin-top: 14px;
    line-height: 1.6;
    max-width: 700px;
}

/* ── CASTING CARD ────────────────────────────── */
.form-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 20px;
    border-radius: 8px;
    overflow: hidden;
    transition: box-shadow 0.25s ease;
}
.form-section:hover {
    box-shadow: 0 4px 24px rgba(0,0,0,0.07);
}

/* Latest card gets a subtle gold left accent */
.form-section.is-latest {
    border-left: 3px solid var(--gold);
}

/* ── CARD HEADER ─────────────────────────────── */
.form-section-header {
    padding: 24px 28px;
    border-bottom: 1px solid var(--border);
    background: var(--bg-primary);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
}

.header-left { flex: 1; min-width: 0; }

.casting-type {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--gold);
    margin-bottom: 4px;
}
.casting-title {
    font-family: var(--font-bangla);
    font-size: 2rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.3;
}

.header-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 10px;
    flex-shrink: 0;
}

.badge-urgent {
    background: rgba(197, 0, 0, 0.1);
    color: var(--gold);
    border: 1px solid rgba(197, 0, 0, 0.2);
    padding: 5px 12px;
    font-size: 0.9rem;
    font-weight: 700;
    border-radius: 4px;
    white-space: nowrap;
}

/* ── SHARE BAR (per-card) ────────────────────── */
.share-bar {
    display: flex;
    align-items: center;
    gap: 6px;
}

.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 11px;
    border-radius: 4px;
    font-size: 0.82rem;
    font-family: var(--font-bangla);
    font-weight: 600;
    text-decoration: none;
    border: 1.5px solid transparent;
    cursor: pointer;
    background: none;
    transition: opacity 0.15s, transform 0.15s;
    white-space: nowrap;
    line-height: 1;
}
.share-btn:hover { opacity: 0.8; transform: translateY(-1px); }
.share-btn:active { transform: translateY(0); }

.share-btn--facebook  { background: #1877F2; color: #fff; border-color: #1877F2; }
.share-btn--instagram {
    background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: #fff;
}
.share-btn--copy {
    background: var(--bg-surface);
    color: var(--text-primary);
    border-color: var(--border-strong);
}
.share-btn--copy.copied { color: #16a34a; border-color: #16a34a; }

/* ── COLLAPSE TOGGLE BUTTON ──────────────────── */
.collapse-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 28px;
    background: var(--bg-secondary);
    border: none;
    border-top: 1px solid var(--border);
    cursor: pointer;
    font-family: var(--font-bangla);
    font-size: 1.35rem;
    font-weight: 600;
    color: var(--gold);
    transition: background 0.2s;
    text-align: left;
}
.collapse-toggle:hover { background: var(--bg-surface); }

.toggle-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 1.5px solid var(--gold);
    color: var(--gold);
    transition: transform 0.3s ease;
    flex-shrink: 0;
}

/* When card is open, rotate the icon */
.form-section.is-open .toggle-icon {
    transform: rotate(180deg);
}

/* "Latest" badge next to toggle text on collapsed cards */
.toggle-latest-badge {
    font-size: 0.78rem;
    background: var(--gold-bg);
    color: var(--gold);
    border: 1px solid var(--gold);
    padding: 2px 8px;
    border-radius: 3px;
    margin-left: 10px;
    font-weight: 700;
}

/* ── COLLAPSIBLE BODY ────────────────────────── */
.collapse-body {
    /* CSS-only smooth collapse */
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.45s cubic-bezier(0.4, 0, 0.2, 1);
}

/* JS adds this class to open */
.form-section.is-open .collapse-body {
    max-height: 2000px; /* large enough for any card */
}

/* Latest card: open by default — no JS needed */
.form-section.is-latest .collapse-body {
    max-height: 2000px;
}

.form-section-body {
    padding: 28px 28px 32px;
}

/* ── DETAILS GRID ────────────────────────────── */
.casting-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 28px;
}
.detail-block {
    display: flex;
    gap: 12px;
}
.detail-icon {
    width: 22px; height: 22px;
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 3px;
}
.detail-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 4px;
}
.detail-value {
    font-size: 1.2rem;
    color: var(--text-primary);
    font-weight: 600;
}

/* ── DESCRIPTION ─────────────────────────────── */
.casting-desc {
    font-family: var(--font-bangla);
    font-size: 1.2rem;
    line-height: 1.85;
    color: var(--text-secondary);
    margin-bottom: 28px;
    padding-bottom: 28px;
    border-bottom: 1px dashed var(--border-strong);
}

/* ── APPLY BOX ───────────────────────────────── */
.apply-box {
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    padding: 22px;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.apply-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
}
.apply-steps {
    list-style: none;
    counter-reset: step-counter;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.apply-steps li {
    counter-increment: step-counter;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 1.15rem;
    line-height: 1.6;
    color: var(--text-secondary);
}
.apply-steps li::before {
    content: counter(step-counter) "।";
    color: var(--gold);
    font-weight: 700;
    font-size: 1rem;
    margin-top: 2px;
    flex-shrink: 0;
}

.btn-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #25D366;
    color: #fff;
    padding: 14px 28px;
    font-size: 1.15rem;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    width: 100%;
    box-sizing: border-box;
    margin-top: 4px;
}
.btn-whatsapp:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

/* ── ANIMATIONS ──────────────────────────────── */
@keyframes fade-up {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim-fade-up { animation: fade-up 0.55s ease both; }

/* ── RESPONSIVE ──────────────────────────────── */
@media (max-width: 768px) {
    .form-page {
        padding: 24px 14px 80px;
    }
    .form-page-title { font-size: 2rem; }
    .form-page-sub   { font-size: 1.1rem; }

    .form-section-header {
        flex-direction: column;
        padding: 16px;
        gap: 12px;
    }
    .header-right {
        flex-direction: row;
        align-items: center;
        flex-wrap: wrap;
        width: 100%;
        justify-content: space-between;
    }

    .casting-title { font-size: 1.45rem; }
    .casting-type  { font-size: 1rem; }

    .casting-details-grid {
        grid-template-columns: 1fr;
        gap: 14px;
    }
    .form-section-body { padding: 16px; }

    .casting-desc { font-size: 1rem; }
    .detail-value { font-size: 1rem; }
    .detail-label { font-size: 1rem; }
    .apply-title  { font-size: 1.1rem; }
    .apply-steps li { font-size: 1rem; }
    .apply-box    { padding: 14px; }

    .btn-whatsapp {
        font-size: 1rem;
        padding: 13px 16px;
    }

    /* Icon-only share buttons on mobile to save space */
    .share-btn span { display: none; }
    .share-btn { padding: 6px 8px; }

    .collapse-toggle { padding: 13px 16px; font-size: 1rem; }
}

@media (max-width: 480px) {
    .casting-title { font-size: 1.25rem; }
    .form-page-title { font-size: 1.6rem; }
}
</style>

<div class="form-page">

    
    <div class="form-page-header anim-fade-up">
        <div class="form-page-eyebrow">সুযোগসমূহ</div>
        <h1 class="form-page-title">উন্মুক্ত <strong>কাস্টিং কল</strong></h1>
        <p class="form-page-sub">টিভিসি, ফটোশুট এবং শর্ট ফিল্মের সর্বশেষ অডিশনগুলো সম্পর্কে জানুন। আমাদের আসন্ন প্রজেক্টগুলোতে যুক্ত হতে আজই আপনার পোর্টফোলিও জমা দিন।</p>
    </div>

    
    <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_top'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

    
    <div class="casting-list">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $castings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $casting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>

            
            <div id="casting-<?php echo e($casting->id); ?>"
                 class="form-section anim-fade-up <?php echo e($index === 0 ? 'is-latest' : ''); ?>"
                 style="animation-delay: <?php echo e($index * 0.12); ?>s">

                
                <div class="form-section-header">
                    <div class="header-left">
                        <div class="casting-type"><?php echo e($casting->type); ?></div>
                        <h2 class="casting-title"><?php echo e($casting->title); ?></h2>
                    </div>

                    <div class="header-right">
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($casting->status === 'Urgent' || $casting->status === 'জরুরী'): ?>
                            <div class="badge-urgent">জরুরী / Urgent</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="share-bar">
                            
                            <a class="share-btn share-btn--facebook"
                               href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url() . '#casting-' . $casting->id)); ?>"
                               target="_blank" rel="noopener noreferrer"
                               title="Share on Facebook">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                                </svg>
                                <span>Facebook</span>
                            </a>

                            
                            <button class="share-btn share-btn--instagram"
                                    onclick="castingShareInstagram('casting-<?php echo e($casting->id); ?>')"
                                    title="Share on Instagram">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                    <circle cx="12" cy="12" r="4"/>
                                    <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                                </svg>
                                <span>Instagram</span>
                            </button>

                            
                            <button class="share-btn share-btn--copy"
                                    id="copyBtn-<?php echo e($casting->id); ?>"
                                    onclick="castingCopyLink('<?php echo e($casting->id); ?>')"
                                    title="Copy link">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                                </svg>
                                <span id="copyText-<?php echo e($casting->id); ?>">Copy</span>
                            </button>
                        </div>
                    </div>
                </div>

                
                <div class="collapse-body">
                    <div class="form-section-body">

                        
                        <div class="casting-details-grid">
                            <div class="detail-block">
                                <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <div>
                                    <div class="detail-label">বয়স / Age</div>
                                    <div class="detail-value"><?php echo e($casting->age_range); ?></div>
                                </div>
                            </div>

                            <div class="detail-block">
                                <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <div>
                                    <div class="detail-label">লিঙ্গ / Gender</div>
                                    <div class="detail-value"><?php echo e($casting->gender); ?></div>
                                </div>
                            </div>

                            <div class="detail-block">
                                <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                                <div>
                                    <div class="detail-label">অভিজ্ঞতা / Experience</div>
                                    <div class="detail-value"><?php echo e($casting->experience); ?></div>
                                </div>
                            </div>

                            <div class="detail-block">
                                <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <div class="detail-label">শেষ সময় / Deadline</div>
                                    <div class="detail-value" style="color: var(--gold);"><?php echo e($casting->deadline); ?></div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="casting-desc"><?php echo e($casting->description); ?></div>

                        
                        <div class="apply-box">
                            <div class="apply-title">কীভাবে আবেদন করবেন</div>
                            <ul class="apply-steps">
                                <li>নিশ্চিত করুন আপনার এজেন্সি প্রোফাইলটি সাম্প্রতিক ছবিসহ ১০০% সম্পন্ন।</li>
                                <li>আপনার নাম, বয়স এবং আপনি কোন চরিত্রের জন্য আবেদন করছেন তা উল্লেখ করে আমাদের একটি মেসেজ পাঠান।</li>
                                <li>২-৩টি সাম্প্রতিক, আনএডিটেড প্রাকৃতিক ছবি সংযুক্ত করুন।</li>
                            </ul>

                            <?php
                                $waNumber = $settings->contact_phone
                                    ? preg_replace('/[^0-9]/', '', $settings->contact_phone)
                                    : '';
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($waNumber): ?>
                                <a href="https://wa.me/<?php echo e($waNumber); ?>?text=হ্যালো!%20আমি%20'<?php echo e(urlencode($casting->title)); ?>'%20কাস্টিংয়ের%20জন্য%20আবেদন%20করতে%20চাই।"
                                   target="_blank" rel="noopener noreferrer"
                                   class="btn-whatsapp">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                    </svg>
                                    WhatsApp-এ যোগাযোগ করুন
                                </a>
                            <?php else: ?>
                                <p style="font-size:1rem; color: var(--gold); margin-top:4px;">
                                    অ্যাডমিন সেটিংসে একটি কন্টাক্ট নম্বর যোগ করুন।
                                </p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index !== 0): ?>
                    <button class="collapse-toggle"
                            onclick="castingToggle(this)"
                            aria-expanded="false">
                        <span>
                            বিস্তারিত দেখুন
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index === 1): ?>
                                <span class="toggle-latest-badge">২য় সর্বশেষ</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </span>
                        <span class="toggle-icon">
                            
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </span>
                    </button>
                <?php else: ?>
                    
                    <div style="padding: 8px 28px; background: var(--gold-bg);
                                font-size: 0.82rem; font-weight: 700; color: var(--gold);
                                text-transform: uppercase; letter-spacing: 0.08em; border-top: 1px solid var(--border);">
                        ✦ সর্বশেষ কাস্টিং কল
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->iteration == 1): ?>
                <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_in_feed'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div style="text-align:center; padding: 64px 16px; background: var(--bg-surface);
                        border: 1px solid var(--border); border-radius: 8px;">
                <svg style="width:48px; height:48px; color: var(--text-muted); margin: 0 auto 16px; display:block;"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <p style="font-size: 1.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 8px;">
                    কোনো কাস্টিং কল নেই
                </p>
                <p style="font-size: 1.15rem; color: var(--text-muted);">
                    আসন্ন কাস্টিং কলগুলো এখানে দেখা যাবে, অনুগ্রহ করে পরে আবার দেখুন।
                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    <?php if (isset($component)) { $__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.warning-notice','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('warning-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658)): ?>
<?php $attributes = $__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658; ?>
<?php unset($__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658)): ?>
<?php $component = $__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658; ?>
<?php unset($__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658); ?>
<?php endif; ?>

</div>

<script>
    /**
     * Toggle a casting card open/closed.
     * The button sits OUTSIDE .collapse-body so it's always visible.
     */
    function castingToggle(btn) {
        const card = btn.closest('.form-section');
        const isOpen = card.classList.contains('is-open');

        if (isOpen) {
            card.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
            // Update button text
            btn.querySelector('span:first-child').childNodes[0].textContent = 'বিস্তারিত দেখুন ';
        } else {
            card.classList.add('is-open');
            btn.setAttribute('aria-expanded', 'true');
            btn.querySelector('span:first-child').childNodes[0].textContent = 'সংক্ষিপ্ত করুন ';
            // Scroll card into view smoothly
            setTimeout(() => {
                card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 80);
        }
    }

    /**
     * Copy the direct anchor link for a specific casting card.
     * e.g. https://yoursite.com/casting#casting-42
     */
    function castingCopyLink(castingId) {
        const url = window.location.origin + window.location.pathname + '#casting-' + castingId;
        const btn  = document.getElementById('copyBtn-' + castingId);
        const text = document.getElementById('copyText-' + castingId);

        navigator.clipboard.writeText(url).then(() => {
            btn.classList.add('copied');
            text.textContent = '✓';
            setTimeout(() => {
                btn.classList.remove('copied');
                text.textContent = 'Copy';
            }, 2000);
        }).catch(() => {
            // Fallback for older browsers
            const el = document.createElement('textarea');
            el.value = url;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
            text.textContent = '✓';
            setTimeout(() => { text.textContent = 'Copy'; }, 2000);
        });
    }

    /**
     * Instagram has no web share API.
     * Copy the link, then open Instagram after a short delay.
     */
    function castingShareInstagram(anchorId) {
        const url = window.location.origin + window.location.pathname + '#' + anchorId;
        navigator.clipboard.writeText(url).catch(() => {});
        setTimeout(() => {
            window.open('https://www.instagram.com/', '_blank');
        }, 500);
    }

    /**
     * If the URL has an anchor like #casting-42 on page load,
     * auto-open that card and scroll to it.
     */
    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash; // e.g. "#casting-42"
        if (hash && hash.startsWith('#casting-')) {
            const target = document.querySelector(hash);
            if (target && !target.classList.contains('is-latest')) {
                target.classList.add('is-open');
                const btn = target.querySelector('.collapse-toggle');
                if (btn) {
                    btn.setAttribute('aria-expanded', 'true');
                    btn.querySelector('span:first-child').childNodes[0].textContent = 'সংক্ষিপ্ত করুন ';
                }
                setTimeout(() => {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 300);
            }
        }
    });
</script>
</div><?php /**PATH /var/www/html/resources/views/livewire/casting-page.blade.php ENDPATH**/ ?>