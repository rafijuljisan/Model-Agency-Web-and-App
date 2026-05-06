<div x-data>
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
        --gc-text-xs:   0.78rem;   /* badges, labels, hints */
        --gc-text-sm:   0.875rem;  /* meta rows, seat bar label, filter buttons */
        --gc-text-base: 0.95rem;   /* body text, notice cards, gallery filters */
        --gc-text-md:   1rem;      /* batch meta rows, apply btn */
        --gc-text-lg:   1.1rem;    /* sidebar title, section eyebrow */
        --gc-text-xl:   1.35rem;   /* section titles, batch name, CTA sub */
        --gc-text-2xl:  1.6rem;    /* batch fee, stat numbers */
        --gc-text-3xl:  clamp(1.75rem, 4vw, 3.2rem); /* hero title */
    }
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
    font-size: var(--gc-text-lg);
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
    font-size: var(--gc-text-base);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    line-height: 1.5;
    border: 1px solid var(--border);
}
.gc-notice-card.critical { background: rgba(197,0,0,0.05); border-color: rgba(197,0,0,0.2); color: var(--gold); }
.gc-notice-card.normal { background: var(--bg-secondary); }
.gc-notice-card.low { background: var(--bg-primary); }

/* Update Gallery Grid to 3 Columns */
.gc-gallery-grid-3x4 {
    column-count: 4;
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
    font-size: var(--gc-text-2xl);
    font-weight: 700;
    color: var(--gold);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    line-height: 1;
    margin-bottom: 4px;
}
.gc-stat-label {
    font-size: var(--gc-text-xs);
    color: var(--text-muted);
    font-weight: 600;
}
.gc-sidebar-apply-btn {
    width: 100%;
    padding: 14px;
    background: var(--gold);
    color: #fff;
    border: none;
    font-size: var(--gc-text-lg);
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
/* ── Image Lightbox Modal ── */
.gc-lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.9);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.gc-lightbox-overlay img {
    max-width: 100%;
    max-height: 90vh;
    border-radius: 6px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
    object-fit: contain;
}
.gc-lightbox-close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: var(--gold, #ca8a04);
    color: #fff;
    border: none;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: transform 0.2s, background 0.2s;
    z-index: 10001;
}
.gc-lightbox-close:hover {
    transform: scale(1.1);
    background: #fff;
    color: #000;
}
/* Responsive fix for smaller screens */
@media (max-width: 992px) {
    .gc-content-wrapper { grid-template-columns: 1fr; } /* Stack vertically on mobile */
    .gc-gallery-grid-3x4 { column-count: 2; }
}
@media (max-width: 576px) {
    .gc-gallery-grid-3x4 {
        column-count: 2;
        column-gap: 6px; /* Slightly smaller gap for mobile */
    }
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
    font-size: var(--gc-text-lg);
    font-weight: 600;
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
    font-size: var(--gc-text-xl);
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.15;
    position: relative;
    margin-bottom: 16px;
}
.gc-hero-title strong { font-weight: 600; }
.gc-hero-sub {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: var(--gc-text-lg);
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
    font-size: var(--gc-text-md);
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
    font-size: var(--gc-text-md);
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
    font-size: var(--gc-text-lg);
    font-weight: 700;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 8px;
}
.gc-section-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: var(--gc-text-xl);
    font-weight: 300;
    color: var(--text-primary);
}
.gc-section-title strong { font-weight: 600; }

/* ── Batch Cards ── */
.gc-batches {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Forces exactly 2 columns */
    gap: 24px;
    margin-bottom: 64px;
}
.gc-batch-card {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 28px;
    transition: border-color 0.25s, transform 0.25s;
    position: relative;
    /* Removed the flex and max-width properties that were causing uneven sizing */
}
.gc-batch-card:hover {
    border-color: var(--gold);
    transform: translateY(-3px);
}
.gc-batch-status {
    position: absolute;
    top: 16px; right: 16px;
    font-size: var(--gc-text-xs);
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 10px;
    border-radius: 2px;
}
.gc-batch-status.open         { background: rgba(22,163,74,0.1); color: #16a34a; }
.gc-batch-status.filling_fast { background: rgba(234,179,8,0.1);  color: #ca8a04; }
.gc-batch-status.full         { background: rgba(197,0,0,0.1);    color: var(--gold); }

.gc-batch-name {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: var(--gc-text-lg);
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
    font-size: var(--gc-text-md);
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
    font-size: var(--gc-text-xs);
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
    font-size: var(--gc-text-2xl);
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 16px;
}
.gc-batch-fee span { font-size: var(--gc-text-sm); color: var(--text-muted); font-weight: 300; }

.gc-apply-btn {
    width: 100%;
    padding: 12px;
    background: var(--gold);
    color: #fff;
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: var(--gc-text-md);
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
.gc-benefit-text { font-size: var(--gc-text-base); font-family: 'SolaimanLipi', 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.6; }
.gc-benefit-text strong { display: block; color: var(--text-primary); font-family: 'SolaimanLipi', 'Jost', sans-serif; font-weight: 600; font-size: var(--gc-text-md); margin-bottom: 3px; }

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
    font-size: var(--gc-text-sm);
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
    font-size: var(--gc-text-lg);
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 12px;
    position: relative;
}
.gc-cta-banner-sub {
    font-size: var(--gc-text-md);
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    color: var(--text-muted);
    margin-bottom: 28px;
    position: relative;
}

/* ══════════════════════════════════════════
   GROOMING MODAL — FULL RESPONSIVE SYSTEM
══════════════════════════════════════════ */

/* ── Overlay ── */
.gc-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.75);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    overflow-y: auto;
}

/* ── Modal Box ── */
.gc-modal {
    background: var(--bg-secondary);
    border: 1px solid var(--border-strong);
    width: 100%;
    max-width: 560px;
    max-height: 92vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    border-radius: 8px;
    position: relative;
}

/* ── Modal Header ── */
.gc-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    background: var(--bg-secondary);
    z-index: 10;
    flex-shrink: 0;
}

.gc-modal-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-primary);
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.gc-modal-close {
    background: transparent;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    border-radius: 4px;
    transition: color 0.2s;
}
.gc-modal-close:hover { color: var(--text-primary); }

/* ── Step Progress Bar ── */
.gc-steps-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px 24px;
    border-bottom: 1px solid var(--border);
    gap: 0;
    flex-shrink: 0;
    background: var(--bg-secondary);
}

.gc-step-dot {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    color: var(--text-muted);
    font-size: 0.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: all 0.3s;
}
.gc-step-dot.active {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}
.gc-step-dot.done {
    border-color: #16a34a;
    background: #16a34a;
    color: #fff;
}

.gc-step-line {
    flex: 1;
    height: 2px;
    background: var(--border-strong);
    min-width: 12px;
    transition: background 0.3s;
}
.gc-step-line.done { background: #16a34a; }

/* ── Modal Body ── */
.gc-modal-body {
    padding: 24px;
    flex: 1;
    overflow-y: auto;
}

/* ── Modal Footer ── */
.gc-modal-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    border-top: 1px solid var(--border);
    background: var(--bg-secondary);
    position: sticky;
    bottom: 0;
    z-index: 10;
    flex-shrink: 0;
    gap: 12px;
}

/* ── Buttons ── */
.gc-btn-prev {
    padding: 10px 20px;
    border: 1px solid var(--border-strong);
    background: transparent;
    color: var(--text-secondary);
    font-family: 'Jost', sans-serif;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    border-radius: 4px;
    transition: all 0.2s;
    white-space: nowrap;
}
.gc-btn-prev:hover {
    border-color: var(--gold);
    color: var(--gold);
}

.gc-btn-next {
    padding: 10px 22px;
    background: var(--gold);
    color: #ffffff;
    font-family: 'Jost', sans-serif;
    font-size: 1rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s;
    white-space: nowrap;
}
.gc-btn-next:hover { opacity: 0.88; }

/* ── Form Fields ── */
.gc-field {
    margin-bottom: 18px;
}
.gc-field label {
    display: block;
    font-size: 0.95rem;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--text-muted);
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
    font-family: 'Jost', sans-serif;
    font-size: 1.125rem;
    outline: none;
    border-radius: 4px;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
}
.gc-field input:focus,
.gc-field select:focus,
.gc-field textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px var(--gold-bg);
}
.gc-field-error {
    font-size: 0.85rem;
    color: #ef4444;
    margin-top: 5px;
    font-weight: 500;
}
.gc-field-hint {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-top: 5px;
}

/* ── 2-column grid ── */
.gc-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

/* ── Step 3: Career Interest checkboxes ── */
.gc-interest-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.gc-interest-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-secondary);
    transition: all 0.2s;
    border-radius: 6px;
    user-select: none;
}
.gc-interest-card.selected {
    border-color: #16a34a;
    background: rgba(22, 163, 74, 0.08);
    color: #16a34a;
}
.gc-interest-card input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #16a34a;
    cursor: pointer;
    flex-shrink: 0;
    margin: 0;
    padding: 0;
}
.gc-interest-check {
    margin-left: auto;
    flex-shrink: 0;
}

/* ── Step 3: Experience Level ── */
.gc-exp-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.gc-exp-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 16px 6px;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    cursor: pointer;
    text-align: center;
    border-radius: 6px;
    transition: all 0.2s;
    user-select: none;
}
.gc-exp-card.selected {
    border-color: #16a34a;
    background: rgba(22, 163, 74, 0.08);
}
.gc-exp-card input[type="radio"] { display: none; }
.gc-exp-icon { font-size: 1.4rem; line-height: 1; }
.gc-exp-label {
    font-size: 0.9rem;
    font-weight: 700;
    color: var(--text-primary);
}
.gc-exp-card.selected .gc-exp-label { color: #16a34a; }
.gc-exp-sub { font-size: 0.8rem; color: var(--text-muted); }

/* ── Step 4: Batch cards ── */
.gc-batch-select-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.gc-batch-select-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 16px;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.2s;
}
.gc-batch-select-card:hover { border-color: var(--gold); }
.gc-batch-select-card.selected {
    border-color: var(--gold);
    background: var(--gold-bg);
}
.gc-batch-select-name {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 4px;
}
.gc-batch-select-meta {
    font-size: 0.85rem;
    color: var(--text-muted);
}
.gc-batch-select-fee {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--gold);
    white-space: nowrap;
    flex-shrink: 0;
}

/* ══════════════════════════════════════════
   PAYMENT METHOD TABS WITH BRAND ICONS
══════════════════════════════════════════ */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
    margin-bottom: 20px;
}
.payment-method-label {
    display: block;
    cursor: pointer;
    position: relative;
}
.payment-method-label input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
}
.payment-method-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 8px;
    border: 2px solid var(--border-strong);
    background: var(--bg-primary);
    color: var(--text-secondary);
    border-radius: 6px;
    transition: all 0.25s ease;
    user-select: none;
}
.payment-method-label:hover .payment-method-tab {
    border-color: var(--gold);
}
.payment-method-label input[type="radio"]:checked ~ .payment-method-tab {
    border-color: var(--gold);
    background: var(--gold-bg);
}
.pm-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    overflow: hidden;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
.pm-brand-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.pm-label {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--text-secondary);
    transition: color 0.2s;
}
.payment-method-label input[type="radio"]:checked ~ .payment-method-tab .pm-label {
    color: var(--gold);
}

/* ── Payment info box (send money to) ── */
.gc-pay-info-box {
    display: flex;
    align-items: center;
    gap: 14px;
    background: var(--bg-primary);
    border: 1px solid var(--border-strong);
    border-left: 3px solid var(--gold);
    padding: 14px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
}
.gc-pay-info-label {
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-bottom: 4px;
    font-family: 'SolaimanLipi', sans-serif;
}
.gc-pay-info-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gold);
    letter-spacing: 0.04em;
}

/* ── Selected batch summary (Step 5) ── */
.gc-batch-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    padding: 14px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.gc-batch-summary-label {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted);
    margin-bottom: 3px;
}
.gc-batch-summary-name {
    font-weight: 700;
    font-size: 1.05rem;
    color: var(--text-primary);
}
.gc-batch-summary-fee {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--gold);
    white-space: nowrap;
}

/* ── Pre-filled member badge ── */
.gc-member-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    background: rgba(22, 163, 74, 0.07);
    border-bottom: 1px solid rgba(22, 163, 74, 0.2);
    font-size: 0.78rem;
    color: #16a34a;
    font-weight: 600;
    flex-shrink: 0;
}

/* ── Success screen ── */
.gc-success {
    padding: 40px 28px;
    text-align: center;
}
.gc-success-icon {
    width: 60px;
    height: 60px;
    background: rgba(22, 163, 74, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: #16a34a;
}
.gc-success-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 12px;
}
.gc-success-sub {
    font-size: 0.95rem;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 24px;
}

/* ── Step 0: Quick Start ── */
.gc-quickstart-body {
    padding: 44px 28px;
    text-align: center;
}
.gc-quickstart-icon {
    width: 60px;
    height: 60px;
    background: var(--gold-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
}
.gc-quickstart-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 8px;
}
.gc-quickstart-sub {
    color: var(--text-muted);
    font-size: 0.86rem;
    line-height: 1.65;
    margin-bottom: 28px;
    max-width: 320px;
    margin-left: auto;
    margin-right: auto;
}
.gc-quickstart-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}
.gc-btn-gold {
    padding: 13px 26px;
    background: var(--gold);
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
    border: none;
    cursor: pointer;
    border-radius: 4px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.2s;
    font-family: 'Jost', sans-serif;
    white-space: nowrap;
}
.gc-btn-gold:hover { opacity: 0.88; }
.gc-btn-ghost {
    padding: 13px 26px;
    background: transparent;
    border: 1px solid var(--border-strong);
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    border-radius: 4px;
    font-family: 'Jost', sans-serif;
    transition: all 0.2s;
    white-space: nowrap;
}
.gc-btn-ghost:hover {
    border-color: var(--gold);
    color: var(--gold);
}

/* ══════════════════════════════════════════
   RESPONSIVE BREAKPOINTS
══════════════════════════════════════════ */

/* Tablet and below */
@media (max-width: 600px) {
    .gc-modal-overlay {
        padding: 0;
        align-items: flex-end;
    }
    .gc-modal {
        max-width: 100%;
        max-height: 96vh;
        border-radius: 16px 16px 0 0;
        border-bottom: none;
    }
    .gc-modal-header {
        padding: 16px 18px;
    }
    .gc-modal-body {
        padding: 18px;
    }
    .gc-modal-footer {
        padding: 14px 18px;
    }
    .gc-steps-bar {
        padding: 12px 18px;
    }
    .gc-step-dot {
        width: 26px;
        height: 26px;
        font-size: 0.85rem;
    }
    .gc-step-line {
        min-width: 8px;
    }

    /* 2-col → 1-col */
    .gc-grid-2 {
        gap: 0;
    }

    /* Career interests: 2-col → 1-col */
    .gc-interest-grid {
        grid-template-columns: 1fr;
    }

    /* Experience: 3-col stays (cards are small enough) */
    .gc-exp-grid {
        gap: 8px;
    }
    .gc-exp-card { padding: 12px 4px; }
    .gc-exp-icon { font-size: 1.2rem; }
    .gc-exp-label { font-size: 0.72rem; }
    .gc-exp-sub { font-size: 0.68rem; }

    /* Payment methods: 3-col stays */
    .payment-methods {
        gap: 8px;
    }
    .pm-icon-wrap { width: 36px; height: 36px; }
    .pm-label { font-size: 0.88rem; }
    .payment-method-tab { padding: 12px 6px; gap: 6px; }

    /* Batch cards */
    .gc-batch-select-card { flex-wrap: wrap; }
    .gc-batch-select-fee { width: 100%; text-align: right; }

    /* Quickstart */
    .gc-quickstart-body { padding: 32px 20px; }
    .gc-quickstart-actions { flex-direction: column; }
    .gc-btn-gold, .gc-btn-ghost { width: 100%; justify-content: center; }

    /* Success */
    .gc-success { padding: 32px 20px; }

    /* Footer buttons */
    .gc-btn-prev { padding: 10px 14px; font-size: 0.82rem; }
    .gc-btn-next { padding: 10px 16px; font-size: 0.85rem; }

    /* Member badge */
    .gc-member-badge { font-size: 0.74rem; padding: 9px 16px; }
}

/* Very small phones */
@media (max-width: 380px) {
    .gc-exp-grid { gap: 6px; }
    .gc-exp-label { font-size: 0.68rem; }
    .pm-icon-wrap { width: 30px; height: 30px; border-radius: 7px; }
    .gc-modal-title { font-size: 0.88rem; }
}

/* Spin animation for loading */
@keyframes spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
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
    .gc-batches { grid-template-columns: 1fr; }
}
</style>

{{-- ══════════════════════════════════
     HERO
══════════════════════════════════ --}}
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
    {{-- AD SLOT 1: Grooming Page Top --}}
    <div style="margin-bottom: 40px;">
        <x-ad-banner position="grooming_top" />
    </div>
    {{-- ══════════════════════════════════
        GALLERY & NOTICES SIDEBAR
    ══════════════════════════════════ --}}
    <div class="gc-content-wrapper">

        {{-- 🟦 LEFT COLUMN: Batches, Ad, and Gallery --}}
        <div class="gc-main-column" style="display: flex; flex-direction: column; min-width: 0;">

            {{-- 1. UPCOMING BATCHES --}}
            <div id="batches-section">
                <div class="gc-section-head">
                    <div class="gc-section-eyebrow">Upcoming Batches</div>
                </div>

                @if($batches->isEmpty())
                    <div style="text-align:center; padding: 48px; background: var(--bg-surface); border: 1px dashed var(--border-strong); margin-bottom: 64px;">
                        <p style="color: var(--text-muted); font-size: 1.125rem;">There are no upcoming batches at the moment. Check back soon!</p>
                    </div>
                @else
                    <div class="gc-batches">
                        @foreach($batches as $batch)
                            <div class="gc-batch-card">
                                <div class="gc-batch-status {{ $batch->status }}">
                                    @if($batch->status === 'open') Open
                                    @elseif($batch->status === 'filling_fast') Filling Fast
                                    @else Full @endif
                                </div>

                                <a href="{{ route('grooming.show', $batch->id) }}" style="text-decoration: none;">
                                    <div class="gc-batch-name"
                                        style="transition: color 0.2s;"
                                        onmouseover="this.style.color='var(--gold)'"
                                        onmouseout="this.style.color='var(--text-primary)'">
                                        {{ $batch->title }}
                                    </div>
                                </a>

                                <div class="gc-batch-meta">
                                    <div class="gc-batch-meta-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        Start Date: {{ $batch->start_date->format('d M Y') }}
                                    </div>
                                    @if($batch->trainer)
                                    <div class="gc-batch-meta-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                                        Trainer: {{ $batch->trainer }}
                                    </div>
                                    @endif
                                    @if($batch->venue)
                                    <div class="gc-batch-meta-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        {{ $batch->venue }}
                                    </div>
                                    @endif
                                    @if(!empty($batch->schedule_json))
                                    <div class="gc-batch-meta-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                        {{ collect($batch->schedule_json)->map(fn($s) => ($s['day'] ?? '') . ' ' . ($s['time'] ?? ''))->implode(', ') }}
                                    </div>
                                    @endif
                                </div>

                                {{-- Seat bar --}}
                                @if($batch->show_seats_public)
                                    <div class="gc-seat-bar-wrap">
                                        <div class="gc-seat-bar-label">
                                            <span>Seat Availability</span>
                                            <span>{{ $batch->filled_seats }}/{{ $batch->seat_limit }} Seats</span>
                                        </div>
                                        <div class="gc-seat-bar">
                                            <div class="gc-seat-bar-fill" style="width: {{ $batch->fill_percentage }}%"></div>
                                        </div>
                                        @if($batch->remaining_seats <= 5 && $batch->remaining_seats > 0)
                                            <div style="font-size:0.95rem; color:var(--gold); font-weight:700; margin-top:5px;">
                                                ⚡ Only {{ $batch->remaining_seats }} seats left!
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <div class="gc-batch-fee">
                                    ৳{{ number_format($batch->fee) }}
                                    <span>/ Person</span>
                                </div>

                                <div style="display: flex; gap: 12px; margin-top: 16px;">
                                    {{-- View Details Button --}}
                                    <a href="{{ route('grooming.show', $batch->id) }}"
                                    style="flex: 1; padding: 12px; border: 1px solid var(--gold); color: var(--gold); text-align: center; font-family: 'SolaimanLipi', 'Jost', sans-serif; font-size: 1rem; font-weight: 600; text-transform: uppercase; text-decoration: none; transition: all 0.2s; display: flex; align-items: center; justify-content: center;"
                                    onmouseover="this.style.background='var(--gold)'; this.style.color='#fff';"
                                    onmouseout="this.style.background='transparent'; this.style.color='var(--gold)';">
                                        View Details
                                    </a>

                                    {{-- Quick Apply Button --}}
                                    <button
                                        class="gc-apply-btn"
                                        style="flex:1; margin:0; width:auto;"
                                        @if($batch->status === 'full') disabled @endif
                                        @click="$dispatch('open-grooming-modal')"
                                    >
                                        @if($batch->status === 'full') Seat Full @else Apply Now @endif
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- AD SLOT 2: MIDDLE (Perfectly placed between Batches and Gallery) --}}
            <div style="margin-bottom: 64px; display:flex; justify-content:center;">
                <x-ad-banner position="grooming_middle" />
            </div>

            {{-- 2. GALLERY --}}
            <div class="gc-gallery-side" x-data="{ filter: 'all', modalOpen: false, currentImage: '' }">
                <div class="gc-section-head" style="text-align: left;">
                    <div class="gc-section-eyebrow">Gallery</div>
                    <h2 class="gc-section-title">Class <strong>Moments</strong></h2>
                </div>

                @if($gallery->isNotEmpty())
                    <div class="gc-gallery-filters" style="justify-content: flex-start;">
                        <button class="gc-gallery-filter" :class="filter==='all'?'active':''" @click="filter='all'">All</button>
                        <button class="gc-gallery-filter" :class="filter==='training'?'active':''" @click="filter='training'">Training</button>
                        <button class="gc-gallery-filter" :class="filter==='graduation'?'active':''" @click="filter='graduation'">Graduation</button>
                        <button class="gc-gallery-filter" :class="filter==='event'?'active':''" @click="filter='event'">Event</button>
                    </div>

                    <div class="gc-gallery-grid-3x4">
                        @foreach($gallery as $photo)
                        <div class="gc-gallery-item"
                            x-show="filter === 'all' || filter === '{{ $photo->category }}'"
                            x-transition
                            @click="currentImage = '{{ asset('storage/' . $photo->image) }}'; modalOpen = true">
                            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" loading="lazy">
                        </div>
                        @endforeach
                    </div>

                    {{-- Custom Pagination Link --}}
                    <div>
                        {{ $gallery->links('vendor.pagination.custom-numbered') }}
                    </div>
                    <!-- Lightbox Modal -->
                    <div class="gc-lightbox-overlay"
                        x-show="modalOpen"
                        x-transition.opacity.duration.300ms
                        @click.self="modalOpen = false"
                        @keydown.escape.window="modalOpen = false"
                        style="display: none;">

                        <button class="gc-lightbox-close" @click="modalOpen = false">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>

                        <img :src="currentImage" alt="Expanded View" @click.stop>
                    </div>
                @else
                    <p style="color:var(--text-muted); font-size: 0.9rem;">No images available.</p>
                @endif
            </div>

        </div> {{-- End Left Column --}}

        {{-- 🟧 RIGHT COLUMN: SIDEBAR --}}
        <div class="gc-sidebar">
            <div class="gc-sidebar-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                Notice Board
            </div>

            <div class="gc-notices-scroll">
                @if($notices->isNotEmpty())
                    @foreach($notices as $notice)
                        <div class="gc-notice-card {{ $notice->priority }}">
                            <strong style="display:block; margin-bottom:4px; font-size:1.25rem; font-weight: 600;">
                                {{ $notice->title }}
                            </strong>
                            <span style="color: inherit;">{{ $notice->message }}</span>
                        </div>
                    @endforeach
                @else
                    <p style="color:var(--text-muted); font-size: 0.95rem;">There are no new notices at the moment.</p>
                @endif
            </div>

            {{-- Registration Stats Box --}}
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

                <button class="gc-sidebar-apply-btn" @click="$dispatch('open-grooming-modal')">
                    Apply Now
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                </button>
            </div>
        </div>

    </div>


    {{-- AD SLOT 3: Grooming Page Bottom --}}
    <div style="margin-bottom: 40px;">
        <x-ad-banner position="grooming_bottom" />
    </div>
    {{-- ══════════════════════════════════
         CTA BANNER
    ══════════════════════════════════ --}}
    <div class="gc-cta-banner">
        <div class="gc-cta-banner-title">Get Your Career Started Today</div>
        <p class="gc-cta-banner-sub">Limited Seats Available. Apply Now or Contact Us for More Information.</p>

        <div style="position: relative; z-index: 10; display: flex; gap: 16px; justify-content: center; align-items: center; flex-wrap: wrap;">

            {{-- আবেদন বাটন --}}
            <button class="gc-hero-cta" @click="$dispatch('open-grooming-modal')" style="margin: 0;">
                Apply Now
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                </svg>
            </button>

            {{-- হোয়াটসঅ্যাপ বাটন --}}
            @if($settings?->contact_phone)
            @php
                $wa = preg_replace('/[^0-9]/', '', $settings->contact_phone);
            @endphp
            <a href="https://wa.me/{{ $wa }}?text=আমি%20গ্রুমিং%20ক্লাস%20সম্পর্কে%20বিস্তারিত%20জানতে%20চাই।"
               target="_blank"
               style="display: inline-flex; align-items: center; gap: 10px; padding: 15px 32px; background: #25D366; color: #fff; font-family: 'SolaimanLipi', 'Jost', sans-serif; font-size: var(--gc-text-md); font-weight: 600; text-transform: uppercase; letter-spacing: 0.12em; border-radius: 2px; text-decoration: none; transition: transform 0.2s, box-shadow 0.2s;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(37, 211, 102, 0.25)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                </svg>
                Whatsapp
            </a>
            @endif
        </div>
    </div>

</div>

</div>
