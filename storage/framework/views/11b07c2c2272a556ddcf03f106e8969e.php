<div x-data="{ applyModalOpen: false }">
<style>
/* ═══════════════════════════════════════════
   GROOMING CLASS PAGE
═══════════════════════════════════════════ */
/* ── Layout Update: Gallery & Sidebar ── */
.gc-content-wrapper {
    display: grid;
    grid-template-columns: 1fr 350px; /* Gallery takes remaining space, Sidebar is 350px */
    gap: 40px;
    margin-bottom: 64px;
    align-items: start;
}

/* Sidebar Styles */
.gc-sidebar {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 24px;
    position: sticky;
    top: 24px; /* Sticks to top when scrolling */
}
.gc-sidebar-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 8px;
}
.gc-notices-scroll {
    max-height: 650px; /* Fixed height */
    overflow-y: auto; /* Enables scrolling */
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding-right: 8px;
}

/* Custom Scrollbar for Sidebar */
.gc-notices-scroll::-webkit-scrollbar { width: 6px; }
.gc-notices-scroll::-webkit-scrollbar-track { background: transparent; }
.gc-notices-scroll::-webkit-scrollbar-thumb { background: var(--border-strong); border-radius: 4px; }
.gc-notices-scroll::-webkit-scrollbar-thumb:hover { background: var(--gold); }

/* Notice Card inside Sidebar */
.gc-notice-card {
    padding: 16px;
    font-size: 1.125rem;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    line-height: 1.5;
    border: 1px solid var(--border);
}
.gc-notice-card.critical { background: rgba(197,0,0,0.05); border-color: rgba(197,0,0,0.2); color: var(--gold); }
.gc-notice-card.normal { background: var(--bg-secondary); }
.gc-notice-card.low { background: var(--bg-primary); }

/* Update Gallery Grid to 3 Columns */
.gc-gallery-grid-3x4 {
    column-count: 3;
    column-gap: 8px;
    margin-bottom: 32px;
}
/* ── Sidebar Stats & Apply Box ── */
.gc-sidebar-stats {
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px dashed var(--border-strong);
}
.gc-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
}
.gc-stat-box {
    background: var(--bg-primary);
    border: 1px solid var(--border);
    padding: 16px 12px;
    text-align: center;
    border-radius: 4px;
}
.gc-stat-number {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--gold);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    line-height: 1;
    margin-bottom: 4px;
}
.gc-stat-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-weight: 600;
}
.gc-sidebar-apply-btn {
    width: 100%;
    padding: 14px;
    background: var(--gold);
    color: #fff;
    border: none;
    font-size: 1.1rem;
    font-weight: 600;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.gc-sidebar-apply-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(197,0,0,0.25);
}
/* Responsive fix for smaller screens */
@media (max-width: 992px) {
    .gc-content-wrapper { grid-template-columns: 1fr; } /* Stack vertically on mobile */
    .gc-gallery-grid-3x4 { column-count: 2; }
}
@media (max-width: 576px) {
    .gc-gallery-grid-3x4 { column-count: 1; }
}
/* ── Hero ── */
.gc-hero {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border);
    padding: 72px 40px 64px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.gc-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, var(--gold-bg) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, var(--gold-bg) 0%, transparent 50%);
    pointer-events: none;
}
.gc-hero-eyebrow {
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    position: relative;
}
.gc-hero-eyebrow::before, .gc-hero-eyebrow::after {
    content: ''; width: 28px; height: 1px; background: var(--gold);
}
.gc-hero-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: clamp(2.2rem, 5vw, 3.8rem);
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.15;
    position: relative;
    margin-bottom: 16px;
}
.gc-hero-title strong { font-weight: 600; }
.gc-hero-sub {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.3rem;
    color: var(--text-muted);
    max-width: 580px;
    margin: 0 auto 32px;
    line-height: 1.7;
    position: relative;
}
.gc-hero-cta {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 16px 36px;
    background: var(--gold);
    color: #fff;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.25rem;
    font-weight: 600;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
}
.gc-hero-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(197,0,0,0.25);
}

/* ── Notice Bar ── */
.gc-notice {
    padding: 14px 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    text-align: center;
}
.gc-notice.critical { background: rgba(197,0,0,0.1); color: var(--gold); border-bottom: 1px solid rgba(197,0,0,0.2); }
.gc-notice.normal   { background: var(--bg-secondary); color: var(--text-secondary); border-bottom: 1px solid var(--border); }
.gc-notice.low      { background: var(--bg-primary); color: var(--text-muted); border-bottom: 1px solid var(--border); }

/* ── Page body ── */
.gc-body {
    max-width: 1440px; /* Increased from 1200px to match wide menus */
    margin: 0 auto;
    padding: 56px 40px 80px;
}

/* ── Section header ── */
.gc-section-head {
    text-align: center;
    margin-bottom: 36px;
}
.gc-section-eyebrow {
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 8px;
}
.gc-section-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 2rem;
    font-weight: 300;
    color: var(--text-primary);
}
.gc-section-title strong { font-weight: 600; }

/* ── Batch Cards ── */
.gc-batches {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* This perfectly centers the cards */
    gap: 24px;
    margin-bottom: 64px;
}
.gc-batch-card {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 28px;
    transition: border-color 0.25s, transform 0.25s;
    position: relative;
    /* Added for Flexbox centering: */
    width: 100%;
    flex: 1 1 320px; /* Allows the card to grow/shrink smoothly */
    max-width: 380px; /* Prevents a single card from becoming giant if there's only 1 batch */
}
.gc-batch-card:hover {
    border-color: var(--gold);
    transform: translateY(-3px);
}
.gc-batch-status {
    position: absolute;
    top: 16px; right: 16px;
    font-size: 0.65rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 2px;
}
.gc-batch-status.open         { background: rgba(22,163,74,0.1); color: #16a34a; }
.gc-batch-status.filling_fast { background: rgba(234,179,8,0.1);  color: #ca8a04; }
.gc-batch-status.full         { background: rgba(197,0,0,0.1);    color: var(--gold); }

.gc-batch-name {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
    padding-right: 60px;
}
.gc-batch-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 20px;
}
.gc-batch-meta-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.88rem;
    color: var(--text-secondary);
}
.gc-batch-meta-row svg { color: var(--gold); flex-shrink: 0; }

/* Seat bar */
.gc-seat-bar-wrap {
    margin-bottom: 20px;
}
.gc-seat-bar-label {
    display: flex;
    justify-content: space-between;
    font-size: 0.72rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    margin-bottom: 6px;
}
.gc-seat-bar {
    height: 5px;
    background: var(--border);
    border-radius: 999px;
    overflow: hidden;
}
.gc-seat-bar-fill {
    height: 100%;
    border-radius: 999px;
    background: var(--gold);
    transition: width 0.5s ease;
}

.gc-batch-fee {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
}
.gc-batch-fee span { font-size: 1rem; color: var(--text-muted); font-weight: 300; }

.gc-apply-btn {
    width: 100%;
    padding: 12px;
    background: var(--gold);
    color: #fff;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.gc-apply-btn:disabled {
    background: var(--border-strong);
    cursor: not-allowed;
}

/* ── Benefits ── */
.gc-benefits {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* This perfectly centers the benefit cards */
    gap: 20px;
    margin-bottom: 64px;
}
.gc-benefit {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 24px;
    display: flex;
    gap: 14px;
    align-items: flex-start;
    transition: border-color 0.22s;
    /* Added for Flexbox centering: */
    width: 100%;
    flex: 1 1 300px; /* Base width of 300px, allows smooth shrinking/growing */
    max-width: 400px; /* Prevents cards from stretching too wide */
}
.gc-benefit:hover { border-color: var(--gold); }
.gc-benefit-icon {
    width: 36px; height: 36px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    flex-shrink: 0;
}
.gc-benefit-text { font-size: 1.3rem; font-family: 'SolaimanLipi', 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.6; }
.gc-benefit-text strong { display: block; color: var(--text-primary); font-family: 'SolaimanLipi', 'Jost', sans-serif; font-weight: 600; font-size: 1.25rem; margin-bottom: 3px; }

/* ── Gallery ── */
.gc-gallery-filters {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
}
.gc-gallery-filter {
    padding: 6px 18px;
    border: 1px solid var(--border-strong);
    background: transparent;
    color: var(--text-muted);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s;
}
.gc-gallery-filter.active,
.gc-gallery-filter:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}
.gc-gallery-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 3px;
    margin-bottom: 64px;
}
.gc-gallery-item {
    break-inside: avoid; /* Prevents splitting across columns */
    margin-bottom: 8px;  /* Adds vertical gap between images */
    overflow: hidden;
    background: var(--bg-secondary);
    cursor: pointer;
    position: relative;
    border-radius: 4px; /* Optional: adds a nice soft edge to masonry items */
}
.gc-gallery-item img {
    width: 100%;
    height: auto; /* Allows the image to keep its natural height */
    display: block; /* Removes weird spacing at the bottom of the image */
    transition: transform 0.5s ease;
}
.gc-gallery-item:hover img { transform: scale(1.08); }

/* ── CTA Banner ── */
.gc-cta-banner {
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    padding: 56px 40px;
    text-align: center;
    margin-bottom: 64px;
    position: relative;
    overflow: hidden;
}
.gc-cta-banner::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 50%, var(--gold-bg) 0%, transparent 70%);
    pointer-events: none; /* <-- Add this line */
}
.gc-cta-banner-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 12px;
    position: relative;
}
.gc-cta-banner-sub {
    font-size: 1.25rem;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    color: var(--text-muted);
    margin-bottom: 28px;
    position: relative;
}

/* ── Multi-step Form Modal ── */
.gc-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(4,3,2,0.88);
    backdrop-filter: blur(6px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
}
.gc-modal {
    background: var(--bg-surface);
    border: 1px solid var(--border-strong);
    width: 100%;
    max-width: 580px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 32px 80px rgba(0,0,0,0.4);
    animation: gc-modal-in 0.3s ease both;
}
@keyframes gc-modal-in {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.gc-modal-header {
    padding: 24px 28px 20px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.gc-modal-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
}
.gc-modal-close {
    width: 32px; height: 32px;
    background: none; border: none;
    color: var(--text-muted);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    transition: background 0.2s;
}
.gc-modal-close:hover { background: var(--bg-secondary); color: var(--gold); }

/* Step progress */
.gc-steps-bar {
    display: flex;
    align-items: center;
    padding: 16px 28px;
    border-bottom: 1px solid var(--border);
    gap: 0;
    overflow-x: auto;
}
.gc-step-dot {
    width: 28px; height: 28px;
    border-radius: 50%;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    color: var(--text-muted);
    font-size: 0.72rem;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: all 0.25s;
}
.gc-step-dot.done   { background: var(--gold); border-color: var(--gold); color: #fff; }
.gc-step-dot.active { border-color: var(--gold); color: var(--gold); }
.gc-step-line {
    flex: 1; height: 2px;
    background: var(--border);
    min-width: 16px;
    transition: background 0.25s;
}
.gc-step-line.done { background: var(--gold); }

.gc-modal-body { padding: 28px; }

/* Form fields inside modal */
.gc-field { margin-bottom: 20px; }
.gc-field label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--text-secondary);
    margin-bottom: 7px;
}
.gc-field input,
.gc-field select,
.gc-field textarea {
    width: 100%;
    padding: 11px 14px;
    background: var(--bg-primary);
    border: 1px solid var(--border-strong);
    color: var(--text-primary);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 0.95rem;
    font-weight: 300;
    outline: none;
    border-radius: 0;
    appearance: none;
    transition: border-color 0.22s, box-shadow 0.22s;
}
.gc-field input:focus,
.gc-field select:focus { border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-bg); }
.gc-field-hint { font-size: 0.78rem; color: var(--text-muted); margin-top: 5px; }
.gc-field-error { font-size: 0.78rem; color: #dc2626; margin-top: 5px; }

.gc-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

/* Checkbox group */
.gc-check-group {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.gc-check-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 14px;
    border: 1px solid var(--border-strong);
    cursor: pointer;
    font-size: 0.88rem;
    color: var(--text-secondary);
    transition: all 0.2s;
}
.gc-check-item:has(input:checked) {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}
.gc-check-item input { accent-color: var(--gold); }

/* Modal footer */
.gc-modal-footer {
    padding: 20px 28px;
    border-top: 1px solid var(--border);
    display: flex;
    gap: 12px;
    justify-content: space-between;
    align-items: center;
}
.gc-btn-prev {
    padding: 10px 24px;
    border: 1px solid var(--border-strong);
    background: transparent;
    color: var(--text-secondary);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.2s;
}
.gc-btn-prev:hover { border-color: var(--gold); color: var(--gold); }
.gc-btn-next {
    padding: 10px 28px;
    background: var(--gold);
    color: #fff;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    transition: background 0.2s;
    display: flex; align-items: center; gap: 8px;
}
.gc-btn-next:hover { background: var(--btn-fill-hover); }

/* Batch select cards */
.gc-batch-select-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.gc-batch-select-card {
    padding: 16px;
    border: 2px solid var(--border-strong);
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.gc-batch-select-card:hover { border-color: var(--gold); }
.gc-batch-select-card.selected {
    border-color: var(--gold);
    background: var(--gold-bg);
}
.gc-batch-select-name { font-weight: 600; color: var(--text-primary); margin-bottom: 3px; }
.gc-batch-select-meta { font-size: 0.8rem; color: var(--text-muted); }
.gc-batch-select-fee { font-size: 1.2rem; font-weight: 700; color: var(--gold); }

/* Success screen */
.gc-success {
    text-align: center;
    padding: 48px 28px;
}
.gc-success-icon {
    width: 72px; height: 72px;
    background: rgba(22,163,74,0.1);
    border: 1px solid rgba(22,163,74,0.3);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
    color: #16a34a;
}
.gc-success-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 10px;
}
.gc-success-sub {
    font-size: 0.9rem;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 24px;
}

/* Responsive */
@media (max-width: 768px) {
    .gc-hero { padding: 48px 20px 40px; }
    .gc-body { padding: 40px 20px 60px; }
    .gc-gallery-grid { grid-template-columns: repeat(2, 1fr); }
    .gc-grid-2 { grid-template-columns: 1fr; }
    .gc-check-group { grid-template-columns: 1fr; }
    .gc-notice { padding: 12px 20px; }
    .gc-cta-banner { padding: 40px 20px; }
}
</style>


<div class="gc-hero">
    <div class="gc-hero-eyebrow">Dhaka Model Agency</div>
    <h1 class="gc-hero-title">
        Professional <strong>Grooming Classes</strong>
    </h1>
    <p class="gc-hero-sub">
        Professional training, camera confidence, portfolio development and agency-ready skill development.
    </p>
    <button class="gc-hero-cta" onclick="document.getElementById('batches-section').scrollIntoView({behavior:'smooth'})">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 5v14M5 12l7 7 7-7"/>
        </svg>
        View Batches and Apply
    </button>
</div>

<div class="gc-body">
    
    <div style="margin-bottom: 40px;">
        <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'grooming_top'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    
    <div class="gc-content-wrapper">
        
        
        <div class="gc-gallery-side" x-data="{ filter: 'all' }">
            <div class="gc-section-head" style="text-align: left;">
                <div class="gc-section-eyebrow">Gallery</div>
                <h2 class="gc-section-title">Class <strong>Moments</strong></h2>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($gallery->isNotEmpty()): ?>
                <div class="gc-gallery-filters" style="justify-content: flex-start;">
                    <button class="gc-gallery-filter" :class="filter==='all'?'active':''" @click="filter='all'">All</button>
                    <button class="gc-gallery-filter" :class="filter==='training'?'active':''" @click="filter='training'">Training</button>
                    <button class="gc-gallery-filter" :class="filter==='graduation'?'active':''" @click="filter='graduation'">Graduation</button>
                    <button class="gc-gallery-filter" :class="filter==='event'?'active':''" @click="filter='event'">Event</button>
                </div>

                <div class="gc-gallery-grid-3x4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="gc-gallery-item"
                        x-show="filter === 'all' || filter === '<?php echo e($photo->category); ?>'"
                        x-transition>
                        <img src="<?php echo e(asset('storage/' . $photo->image)); ?>" alt="<?php echo e($photo->title); ?>" loading="lazy">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                
                
                <div>
                    <?php echo e($gallery->links('vendor.pagination.custom-numbered')); ?>

                </div>
            <?php else: ?>
                <p style="color:var(--text-muted); font-size: 0.9rem;">No images available.</p>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="gc-sidebar">
            <div class="gc-sidebar-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                Notice Board
            </div>

            <div class="gc-notices-scroll">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notices->isNotEmpty()): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="gc-notice-card <?php echo e($notice->priority); ?>">
                            <strong style="display:block; margin-bottom:4px; font-size:1.25rem; font-weight: 600;">
                                <?php echo e($notice->title); ?>

                            </strong>
                            <span style="color: inherit;"><?php echo e($notice->message); ?></span>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php else: ?>
                    <p style="color:var(--text-muted); font-size: 0.85rem;">There are no new notices at the moment.</p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <div class="gc-sidebar-stats">
                <div class="gc-stats-grid">
                    <div class="gc-stat-box">
                        <div class="gc-stat-number">200+</div>
                        <div class="gc-stat-label">Success Students</div>
                    </div>
                    <div class="gc-stat-box">
                        <div class="gc-stat-number">100%</div>
                        <div class="gc-stat-label">Practical Training</div>
                    </div>
                </div>
                
                <button class="gc-sidebar-apply-btn" @click="applyModalOpen = true">
                    Apply Now
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </div>
        </div>
        

    </div>

    
    <div style="margin-bottom: 64px;">
        <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'grooming_middle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    
    <div id="batches-section">
        <div class="gc-section-head">
            <div class="gc-section-eyebrow">Upcoming Batches</div>
            <h2 class="gc-section-title">Upcoming <strong>Batches</strong></h2>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batches->isEmpty()): ?>
            <div style="text-align:center; padding: 48px; background: var(--bg-surface); border: 1px dashed var(--border-strong); margin-bottom: 64px;">
                <p style="color: var(--text-muted); font-size: 0.9rem;">There are no upcoming batches at the moment. Check back soon!</p>
            </div>
        <?php else: ?>
            <div class="gc-batches">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="gc-batch-card">
                        <div class="gc-batch-status <?php echo e($batch->status); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->status === 'open'): ?> Open
                            <?php elseif($batch->status === 'filling_fast'): ?> Filling Fast
                            <?php else: ?> Full <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <a href="<?php echo e(route('grooming.show', $batch->id)); ?>" style="text-decoration: none;">
                            <div class="gc-batch-name" 
                                style="transition: color 0.2s;" 
                                onmouseover="this.style.color='var(--gold)'" 
                                onmouseout="this.style.color='var(--text-primary)'">
                                <?php echo e($batch->title); ?>

                            </div>
                        </a>

                        <div class="gc-batch-meta">
                            <div class="gc-batch-meta-row">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                Start Date: <?php echo e($batch->start_date->format('d M Y')); ?>

                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->trainer): ?>
                            <div class="gc-batch-meta-row">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                                Trainer: <?php echo e($batch->trainer); ?>

                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($batch->schedule_json)): ?>
                            <div class="gc-batch-meta-row">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                <?php echo e(collect($batch->schedule_json)->map(fn($s) => ($s['day'] ?? '') . ' ' . ($s['time'] ?? ''))->implode(', ')); ?>

                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="gc-seat-bar-wrap">
                            <div class="gc-seat-bar-label">
                                <span>Seat Availability</span>
                                <span><?php echo e($batch->filled_seats); ?>/<?php echo e($batch->seat_limit); ?> Seats</span>
                            </div>
                            <div class="gc-seat-bar">
                                <div class="gc-seat-bar-fill" style="width: <?php echo e($batch->fill_percentage); ?>%"></div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->remaining_seats <= 5 && $batch->remaining_seats > 0): ?>
                                <div style="font-size:0.72rem; color:var(--gold); font-weight:700; margin-top:5px;">
                                    ⚡ Only <?php echo e($batch->remaining_seats); ?> seats left!
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <div class="gc-batch-fee">
                            ৳<?php echo e(number_format($batch->fee)); ?>

                            <span>/ Person</span>
                        </div>

                        <div style="display: flex; gap: 12px; margin-top: 16px;">
                            
                            <a href="<?php echo e(route('grooming.show', $batch->id)); ?>"
                            style="flex: 1; padding: 12px; border: 1px solid var(--gold); color: var(--gold); text-align: center; font-family: 'SolaimanLipi', 'Jost', sans-serif; font-size: 1rem; font-weight: 600; text-transform: uppercase; text-decoration: none; transition: all 0.2s; display: flex; align-items: center; justify-content: center;"
                            onmouseover="this.style.background='var(--gold)'; this.style.color='#fff';"
                            onmouseout="this.style.background='transparent'; this.style.color='var(--gold)';">
                                View Details
                            </a>

                            
                            <button
                                class="gc-apply-btn"
                                style="flex: 1; margin: 0; width: auto;"
                                wire:click="$set('batch_id', '<?php echo e($batch->id); ?>')"
                                <?php if($batch->status === 'full'): ?> disabled <?php endif; ?>
                                @click="applyModalOpen = true"
                            >
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($batch->status === 'full'): ?>
                                    Seat Full
                                <?php else: ?>
                                    Apply Now
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </button>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div style="margin-bottom: 40px;">
        <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'grooming_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
    
    <div class="gc-cta-banner">
        <div class="gc-cta-banner-title">Get Your Career Started Today</div>
        <p class="gc-cta-banner-sub">Limited Seats Available. Apply Now or Contact Us for More Information.</p>
        
        <div style="position: relative; z-index: 10; display: flex; gap: 16px; justify-content: center; align-items: center; flex-wrap: wrap;">
            
            
            <button class="gc-hero-cta" @click="applyModalOpen = true" style="margin: 0;">
                Apply Now
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                </svg>
            </button>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings?->contact_phone): ?>
            <?php
                $wa = preg_replace('/[^0-9]/', '', $settings->contact_phone);
            ?>
            <a href="https://wa.me/<?php echo e($wa); ?>?text=আমি%20গ্রুমিং%20ক্লাস%20সম্পর্কে%20বিস্তারিত%20জানতে%20চাই।"
               target="_blank"
               style="display: inline-flex; align-items: center; gap: 10px; padding: 15px 32px; background: #25D366; color: #fff; font-family: 'SolaimanLipi', 'Jost', sans-serif; font-size: 1.125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.12em; border-radius: 2px; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(37, 211, 102, 0.25)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Whatsapp
            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

</div>


<div id="gc-apply-modal" x-show="applyModalOpen" style="display: none;" class="gc-modal-overlay">
    <div class="gc-modal">

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submitted): ?>
            
            <div class="gc-success">
                <div class="gc-success-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                    </svg>
                </div>
                <div class="gc-success-title">Application successfully submitted! 🎉</div>
                <p class="gc-success-sub">
                    Your application number: <strong>#<?php echo e($applicationId); ?></strong><br>
                    Our team will verify your payment shortly and confirm with you.
                </p>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings?->contact_phone): ?>
                <?php
                    $wa = preg_replace('/[^0-9]/', '', $settings->contact_phone);
                ?>
                <a href="https://wa.me/<?php echo e($wa); ?>?text=আমি%20গ্রুমিং%20ক্লাসে%20আবেদন%20করেছি।%20আমার%20আবেদন%20নম্বর%20%23<?php echo e($applicationId); ?>"
                   target="_blank"
                   style="display:inline-flex;align-items:center;gap:10px;padding:14px 28px;background:#25D366;color:#fff;font-weight:600;font-size:0.9rem;border-radius:4px;text-decoration:none;margin-top:8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    Confirm on Whatsapp
                </a>

                <br><br>
                <button @click="applyModalOpen = false"
                    style="padding:10px 24px;border:1px solid var(--border-strong);background:transparent;color:var(--text-secondary);font-family:'Jost',sans-serif;font-size:0.8rem;cursor:pointer;">
                    Close
                </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

        <?php else: ?>
            
            <div class="gc-modal-header">
                <div class="gc-modal-title">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step === 1): ?> Personal Information
                    <?php elseif($step === 2): ?> Physical Information
                    <?php elseif($step === 3): ?> Career Interest
                    <?php elseif($step === 4): ?> Batch Selection
                    <?php else: ?> Payment Information
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <button class="gc-modal-close" @click="applyModalOpen = false">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            
            <div class="gc-steps-bar">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($i = 1; $i <= $totalSteps; $i++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="gc-step-dot <?php echo e($i < $step ? 'done' : ($i === $step ? 'active' : '')); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i < $step): ?>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        <?php else: ?>
                            <?php echo e($i); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($i < $totalSteps): ?>
                        <div class="gc-step-line <?php echo e($i < $step ? 'done' : ''); ?>"></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="gc-modal-body">

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step === 1): ?>
                    <div class="gc-field">
                        <label>Full Name <span style="color:var(--gold)">*</span></label>
                        <input type="text" wire:model.defer="full_name" placeholder="Your full name">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="gc-grid-2">
                        <div class="gc-field">
                            <label>Mobile Number <span style="color:var(--gold)">*</span></label>
                            <input type="tel" wire:model.defer="phone" placeholder="01XXXXXXXXX">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="gc-field">
                            <label>WhatsApp</label>
                            <input type="tel" wire:model.defer="whatsapp" placeholder="01XXXXXXXXX">
                        </div>
                    </div>
                    <div class="gc-field">
                        <label>Email</label>
                        <input type="email" wire:model.defer="email" placeholder="you@example.com">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                
                <?php elseif($step === 2): ?>
                    <div class="gc-grid-2">
                        <div class="gc-field">
                            <label>Age</label>
                            <input type="number" wire:model.defer="age" placeholder="e.g. 22">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="gc-field">
                            <label>Gender</label>
                            <select wire:model.defer="gender">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="gc-field">
                            <label>Height</label>
                            <input type="text" wire:model.defer="height" placeholder='e.g. 5&apos;6"'>
                        </div>
                        <div class="gc-field">
                            <label>Weight</label>
                            <input type="text" wire:model.defer="weight" placeholder="e.g. 55 kg">
                        </div>
                    </div>
                    <div class="gc-field">
                        <label>Address</label>
                        <input type="text" wire:model.defer="address" placeholder="Your full address">
                    </div>

                
                <?php elseif($step === 3): ?>
                    <div class="gc-field">
                        <label>Career Interests (Select multiple)</label>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['Modeling', 'Acting', 'Personality Development', 'Fashion Industry']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <label style="
                                display: flex;
                                align-items: center;
                                gap: 10px;
                                padding: 12px 16px;
                                border: 2px solid <?php echo e(in_array($interest, $career_interests) ? '#16a34a' : 'var(--border-strong)'); ?>;
                                background: <?php echo e(in_array($interest, $career_interests) ? 'rgba(22,163,74,0.08)' : 'var(--bg-primary)'); ?>;
                                cursor: pointer;
                                font-size: 0.92rem;
                                font-weight: 600;
                                color: <?php echo e(in_array($interest, $career_interests) ? '#16a34a' : 'var(--text-secondary)'); ?>;
                                transition: all 0.2s;
                                border-radius: 4px;
                            ">
                                <input type="checkbox" wire:model.live="career_interests" value="<?php echo e($interest); ?>"
                                    style="width: 18px; height: 18px; accent-color: #16a34a; cursor: pointer; flex-shrink: 0;">
                                <span><?php echo e($interest); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($interest, $career_interests)): ?>
                                    <svg style="margin-left: auto; flex-shrink: 0;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                    <div class="gc-field">
                        <label>Experience Level</label>
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
                                'Beginner' => ['label' => 'Beginner', 'sub' => 'নতুন', 'icon' => '🌱'],
                                'Intermediate' => ['label' => 'Intermediate', 'sub' => 'কিছুটা অভিজ্ঞ', 'icon' => '⭐'],
                                'Experienced' => ['label' => 'Experienced', 'sub' => 'অভিজ্ঞ', 'icon' => '🏆'],
                            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <label style="
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                                gap: 4px;
                                padding: 16px 8px;
                                border: 2px solid <?php echo e($experience_level === $val ? '#16a34a' : 'var(--border-strong)'); ?>;
                                background: <?php echo e($experience_level === $val ? 'rgba(22,163,74,0.08)' : 'var(--bg-primary)'); ?>;
                                cursor: pointer;
                                text-align: center;
                                border-radius: 4px;
                                transition: all 0.2s;
                            ">
                                <input type="radio" wire:model.live="experience_level" value="<?php echo e($val); ?>" style="display: none;">
                                <span style="font-size: 1.5rem;"><?php echo e($info['icon']); ?></span>
                                <span style="font-size: 0.82rem; font-weight: 700; color: <?php echo e($experience_level === $val ? '#16a34a' : 'var(--text-primary)'); ?>;">
                                    <?php echo e($info['label']); ?>

                                </span>
                                <span style="font-size: 0.75rem; color: var(--text-muted);"><?php echo e($info['sub']); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($experience_level === $val): ?>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="3">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                
                <?php elseif($step === 4): ?>
                    <div class="gc-batch-select-grid">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $batches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $batch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="gc-batch-select-card <?php echo e($batch_id == $batch->id ? 'selected' : ''); ?>"
                                wire:click="$set('batch_id', '<?php echo e($batch->id); ?>')">
                                <div>
                                    <div class="gc-batch-select-name"><?php echo e($batch->title); ?></div>
                                    <div class="gc-batch-select-meta">
                                        Start Date: <?php echo e($batch->start_date->format('d M Y')); ?>

                                        · Available Seat: <?php echo e($batch->remaining_seats); ?>

                                    </div>
                                </div>
                                <div class="gc-batch-select-fee">৳<?php echo e(number_format($batch->fee)); ?></div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <p style="color:var(--text-muted);font-size:0.9rem;">No batches available.</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['batch_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error" style="margin-top:8px;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <?php elseif($step === 5): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedBatch): ?>
                    <div style="background:var(--gold-bg);border:1px solid var(--border-strong);padding:16px;margin-bottom:20px;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);margin-bottom:3px;">Selected Batch</div>
                            <div style="font-weight:600;color:var(--text-primary);"><?php echo e($selectedBatch->title); ?></div>
                        </div>
                        <div style="font-size:1.6rem;font-weight:700;color:var(--gold);">৳<?php echo e(number_format($selectedBatch->fee)); ?></div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="gc-field">
                        <label>Payment Method <span style="color:var(--gold)">*</span></label>
                        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;margin-bottom:4px;">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['bKash' => 'বিকাশ', 'Nagad' => 'নগদ', 'Rocket' => 'রকেট']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <label style="display:flex;align-items:center;justify-content:center;padding:12px;border:2px solid <?php echo e($payment_method === $val ? 'var(--gold)' : 'var(--border-strong)'); ?>;background:<?php echo e($payment_method === $val ? 'var(--gold-bg)' : 'transparent'); ?>;cursor:pointer;font-weight:600;font-size:0.88rem;color:<?php echo e($payment_method === $val ? 'var(--gold)' : 'var(--text-secondary)'); ?>;transition:all 0.2s;">
                                <input type="radio" wire:model.live="payment_method" value="<?php echo e($val); ?>" style="display:none;">
                                <?php echo e($label); ?>

                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payment_method && $settings): ?>
                    <?php
                        $payNumber = match($payment_method) {
                            'bKash'  => $settings->bkash_number,
                            'Nagad'  => $settings->nagad_number,
                            'Rocket' => $settings->rocket_number,
                            default  => null,
                        };
                    ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($payNumber): ?>
                    <div style="background:var(--bg-secondary);border:1px solid var(--border);padding:16px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--gold)" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                        <div>
                            <div style="font-size:0.72rem;font-weight:700;text-transform:uppercase;color:var(--text-muted);">এই নম্বরে Send Money করুন</div>
                            <div style="font-size:1.4rem;font-weight:700;color:var(--gold);margin-top:2px;"><?php echo e($payNumber); ?></div>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="gc-field">
                        <label>Sender Number <span style="color:var(--gold)">*</span></label>
                        <input type="tel" wire:model.defer="sender_number" placeholder="01XXXXXXXXX">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['sender_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div class="gc-field">
                        <label>Transaction ID (TrxID) <span style="color:var(--gold)">*</span></label>
                        <input type="text" wire:model.defer="transaction_id" placeholder="e.g. 9J5A6B8C" style="letter-spacing:0.1em;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['transaction_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="gc-field">
                        <label>Payment Screenshot (Optional)</label>
                        <input type="file" wire:model="payment_screenshot" accept="image/*">
                        <div class="gc-field-hint">JPG, PNG — Maximum 3MB</div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['payment_screenshot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="gc-field-error"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div wire:loading wire:target="payment_screenshot" style="font-size:0.78rem;color:var(--gold);margin-top:4px;">Uploading...</div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

            
            <div class="gc-modal-footer">
                <div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step > 1): ?>
                        <button class="gc-btn-prev" wire:click="prevStep">
                            ← Previous
                        </button>
                    <?php else: ?>
                        <div></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div style="font-size:0.72rem;color:var(--text-muted);">
                    Step <?php echo e($step); ?> / <?php echo e($totalSteps); ?>

                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step < $totalSteps): ?>
                    <button class="gc-btn-next" wire:click="nextStep">
                        Next →
                        <div wire:loading wire:target="nextStep">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:spin 0.8s linear infinite;"><circle cx="12" cy="12" r="10" opacity="0.25"/><path d="M12 2a10 10 0 0110 10" stroke-linecap="round"/></svg>
                        </div>
                    </button>
                <?php else: ?>
                    <button class="gc-btn-next" wire:click="submit">
                        <span wire:loading.remove wire:target="submit">Submit Application ✓</span>
                        <span wire:loading wire:target="submit">Submitting...</span>
                    </button>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</div>

</div><?php /**PATH H:\agency-app\resources\views/livewire/grooming-page.blade.php ENDPATH**/ ?>