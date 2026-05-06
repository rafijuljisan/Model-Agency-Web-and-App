<div x-data>
<style>
    /* ── FONTS ── */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    @font-face {
        font-family: 'SolaimanLipi';
        src: local('SolaimanLipi'),
             url('/fonts/SolaimanLipi.woff2') format('woff2'),
             url('/fonts/SolaimanLipi.ttf') format('truetype');
        font-weight: normal; font-style: normal; font-display: swap;
    }

    /* ── TOKENS ── */
    :root {
        --p-gold:        var(--gold, #b89a5a);
        --p-gold-dim:    color-mix(in srgb, var(--p-gold) 15%, transparent);
        --p-gold-mid:    color-mix(in srgb, var(--p-gold) 30%, transparent);
        --p-ink:         var(--text-primary,   #0f0d0a);
        --p-muted:       var(--text-secondary, #6b6359);
        --p-faint:       var(--text-muted,     #a09080);
        --p-surface:     var(--bg-surface,     #ffffff);
        --p-bg:          var(--bg-secondary,   #f7f5f2);
        --p-border:      var(--border,         #e5e0d8);
        --p-border-str:  var(--border-strong,  #ccc4b8);
        --p-font-dis:    'Playfair Display', 'SolaimanLipi', serif;
        --p-font-body:   'DM Sans', 'SolaimanLipi', sans-serif;
        --p-font-bn:     'SolaimanLipi', 'DM Sans', sans-serif;
        --p-radius:      6px;
    }

    .gp-root * { box-sizing: border-box; }
    .gp-root { font-family: var(--p-font-body); color: var(--p-ink); }

    /* ════════════════════════════════
       HERO — dark, cinematic
    ════════════════════════════════ */
   .gp-hero {
        background: var(--p-surface); /* Changed from #0f0d0a */
        color: var(--p-ink); /* Changed from #fff */
        padding: clamp(64px, 10vw, 120px) clamp(20px, 5vw, 80px);
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    /* Radial gold glow behind text */
.gp-hero::before {
        content: '';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: min(700px, 120vw);
        height: min(700px, 120vw);
        /* Uses your light theme's gold-bg variable for a softer effect */
        background: radial-gradient(circle, var(--gold-bg, rgba(184, 74, 74, 0.07)) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Thin horizontal rule above heading */
.gp-hero-rule {
        width: 48px;
        height: 1px;
        background: var(--p-gold);
        margin: 0 auto 24px;
        opacity: 0.7;
    }

.gp-hero-eyebrow {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--p-gold);
        margin-bottom: 20px;
        position: relative;
    }

.gp-hero-title {
        font-family: var(--p-font-dis);
        font-size: clamp(2.6rem, 7vw, 5.5rem);
        font-weight: 400;
        color: var(--p-ink); /* Changed from #fff */
        line-height: 1.1;
        letter-spacing: -0.01em;
        margin: 0 auto 24px;
        position: relative;
        max-width: 820px;
    }

.gp-hero-title em {
        font-style: italic;
        color: var(--p-gold);
    }

    .gp-hero-sub {
        font-family: var(--p-font-bn);
        font-size: clamp(0.9rem, 2vw, 1.05rem);
        color: var(--p-muted); /* Changed from semi-transparent white */
        max-width: 520px;
        margin: 0 auto 40px;
        line-height: 1.8;
        position: relative;
    }

    .gp-hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 15px 36px;
        background: var(--p-gold);
        color: #fff;
        font-family: var(--p-font-body);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
        position: relative;
    }

    .gp-hero-cta:hover { opacity: 0.88; transform: translateY(-2px); }

    /* ── Hero stats bar ── */
.gp-hero-stats {
        display: flex;
        justify-content: center;
        gap: 0;
        margin-top: clamp(48px, 7vw, 80px);
        border-top: 1px solid var(--p-border); /* Changed from semi-transparent white */
        position: relative;
    }

    .gp-hero-stat {
        flex: 1;
        max-width: 180px;
        padding: 24px 16px;
        border-right: 1px solid var(--p-border); /* Changed from semi-transparent white */
        text-align: center;
    }

.gp-hero-stat:last-child { border-right: none; }

    .gp-hero-stat-num {
        font-family: var(--p-font-dis);
        font-size: 2rem;
        font-weight: 700;
        color: var(--p-gold);
        line-height: 1;
        margin-bottom: 6px;
    }

    .gp-hero-stat-label {
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--p-faint); /* Changed from semi-transparent white */
    }

    /* ════════════════════════════════
       PAGE BODY
    ════════════════════════════════ */
    .gp-body {
        max-width: 1360px;
        margin: 0 auto;
        padding: clamp(40px, 6vw, 80px) clamp(16px, 4vw, 60px) clamp(60px, 8vw, 120px);
    }

    /* ── Section header ── */
    .gp-section { margin-bottom: clamp(56px, 7vw, 96px); }

    .gp-section-head {
        margin-bottom: clamp(28px, 4vw, 40px);
    }

    .gp-eyebrow {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--p-gold);
        margin-bottom: 10px;
    }

    .gp-section-title {
        font-family: var(--p-font-dis);
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 400;
        color: var(--p-ink);
        margin: 0;
        line-height: 1.2;
    }

    .gp-section-title em { font-style: italic; color: var(--p-gold); }

    /* ── Ad slot ── */
    .gp-ad { margin-bottom: clamp(40px, 5vw, 64px); display: flex; justify-content: center; }

    /* ════════════════════════════════
       BATCH CARDS
    ════════════════════════════════ */
    .gp-batches {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: clamp(16px, 2.5vw, 28px);
    }

    .gp-batch {
        background: var(--p-surface);
        border: 1px solid var(--p-border);
        border-radius: var(--p-radius);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: border-color 0.25s, box-shadow 0.25s;
    }

    .gp-batch:hover {
        border-color: var(--p-gold);
        box-shadow: 0 8px 40px rgba(0,0,0,0.08);
    }

    /* Gold top accent bar */
    .gp-batch-accent {
        height: 3px;
        background: linear-gradient(90deg, var(--p-gold), color-mix(in srgb, var(--p-gold) 40%, transparent));
    }

    .gp-batch-inner { padding: clamp(20px, 3vw, 32px); flex: 1; display: flex; flex-direction: column; }

    /* Status + date row */
    .gp-batch-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .gp-status {
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 4px 10px;
        border-radius: 2px;
    }

    .gp-status--open   { background: rgba(22,163,74,0.1);  color: #16a34a; }
    .gp-status--fast   { background: rgba(202,138,4,0.12); color: #b45309; }
    .gp-status--full   { background: rgba(185,0,0,0.1);    color: var(--p-gold); }

    .gp-batch-date {
        font-size: 0.72rem;
        font-weight: 500;
        color: var(--p-faint);
        letter-spacing: 0.06em;
    }

    .gp-batch-name {
        font-family: var(--p-font-dis);
        font-size: clamp(1.2rem, 2.2vw, 1.55rem);
        font-weight: 400;
        color: var(--p-ink);
        margin: 0 0 18px;
        line-height: 1.3;
        text-decoration: none;
        display: block;
        transition: color 0.2s;
    }

    .gp-batch-name:hover { color: var(--p-gold); }

    /* Meta list */
    .gp-batch-meta {
        display: flex;
        flex-direction: column;
        gap: 9px;
        margin-bottom: 20px;
    }

    .gp-meta-row {
        display: flex;
        align-items: flex-start;
        gap: 9px;
        font-family: var(--p-font-bn);
        font-size: 0.875rem;
        color: var(--p-muted);
        line-height: 1.5;
    }

    .gp-meta-row svg { color: var(--p-gold); flex-shrink: 0; margin-top: 2px; }

    /* Seat bar */
    .gp-seat { margin-bottom: 20px; }

    .gp-seat-head {
        display: flex;
        justify-content: space-between;
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--p-faint);
        margin-bottom: 7px;
    }

    .gp-seat-track {
        height: 4px;
        background: var(--p-border);
        border-radius: 99px;
        overflow: hidden;
    }

    .gp-seat-fill {
        height: 100%;
        background: var(--p-gold);
        border-radius: 99px;
    }

    .gp-seat-warn {
        font-size: 0.72rem;
        font-weight: 700;
        color: #b45309;
        margin-top: 6px;
    }

    /* Fee */
    .gp-batch-fee {
        font-family: var(--p-font-dis);
        font-size: clamp(1.5rem, 2.5vw, 2rem);
        font-weight: 700;
        color: var(--p-ink);
        margin-bottom: 20px;
        margin-top: auto;
    }

    .gp-batch-fee small {
        font-family: var(--p-font-body);
        font-size: 0.78rem;
        font-weight: 400;
        color: var(--p-faint);
        margin-left: 4px;
    }

    /* Actions */
    .gp-batch-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 4px;
    }

    .gp-btn-outline {
        padding: 11px 16px;
        border: 1.5px solid var(--p-border-str);
        background: transparent;
        color: var(--p-ink);
        font-family: var(--p-font-body);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        text-align: center;
        text-decoration: none;
        border-radius: var(--p-radius);
        cursor: pointer;
        transition: border-color 0.2s, color 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gp-btn-outline:hover { border-color: var(--p-gold); color: var(--p-gold); }

    .gp-btn-gold {
        padding: 11px 16px;
        background: var(--p-gold);
        color: #fff;
        font-family: var(--p-font-body);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: none;
        border-radius: var(--p-radius);
        cursor: pointer;
        transition: opacity 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gp-btn-gold:hover { opacity: 0.88; }
    .gp-btn-gold:disabled { background: var(--p-border-str); cursor: not-allowed; opacity: 1; }

    /* Empty state */
    .gp-empty {
        grid-column: 1 / -1;
        text-align: center;
        padding: 64px 32px;
        border: 1px dashed var(--p-border-str);
        border-radius: var(--p-radius);
        color: var(--p-faint);
        font-family: var(--p-font-bn);
        font-size: 1rem;
        line-height: 1.7;
    }

    /* ════════════════════════════════
       TWO-COL LAYOUT (Gallery + Sidebar)
    ════════════════════════════════ */
    .gp-two-col {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: clamp(24px, 4vw, 48px);
        align-items: start;
    }

    /* ════════════════════════════════
       NOTICE SIDEBAR
    ════════════════════════════════ */
    .gp-sidebar {
        background: var(--p-surface);
        border: 1px solid var(--p-border);
        border-radius: var(--p-radius);
        overflow: hidden;
        position: sticky;
        top: 24px;
    }

    .gp-sidebar-head {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 18px 20px;
        border-bottom: 1px solid var(--p-border);
        background: var(--p-bg);
    }

    .gp-sidebar-head-title {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--p-ink);
    }

    .gp-sidebar-head svg { color: var(--p-gold); flex-shrink: 0; }

    .gp-notices {
        max-height: 520px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: var(--p-border-str) transparent;
    }

    .gp-notices::-webkit-scrollbar { width: 4px; }
    .gp-notices::-webkit-scrollbar-thumb { background: var(--p-border-str); border-radius: 4px; }

    .gp-notice-item {
        padding: 16px 20px;
        border-bottom: 1px solid var(--p-border);
        font-family: var(--p-font-bn);
        font-size: 0.875rem;
        line-height: 1.65;
    }

    .gp-notice-item:last-child { border-bottom: none; }

    .gp-notice-item--critical { border-left: 3px solid var(--p-gold); background: color-mix(in srgb, var(--p-gold) 5%, transparent); }
    .gp-notice-item--normal   { }
    .gp-notice-item--low      { opacity: 0.75; }

    .gp-notice-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--p-ink);
        margin-bottom: 4px;
    }

    .gp-notice-item--critical .gp-notice-title { color: var(--p-gold); }

    .gp-notice-body { color: var(--p-muted); }

    .gp-no-notices {
        padding: 32px 20px;
        text-align: center;
        font-family: var(--p-font-bn);
        font-size: 0.875rem;
        color: var(--p-faint);
    }

    /* Sidebar stats + CTA */
    .gp-sidebar-foot {
        border-top: 1px solid var(--p-border);
        background: var(--p-bg);
        padding: 20px;
    }

    .gp-sb-stats {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 16px;
    }

    .gp-sb-stat {
        text-align: center;
        padding: 14px 8px;
        background: var(--p-surface);
        border: 1px solid var(--p-border);
        border-radius: var(--p-radius);
    }

    .gp-sb-stat-num {
        font-family: var(--p-font-dis);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--p-gold);
        line-height: 1;
        margin-bottom: 4px;
    }

    .gp-sb-stat-label {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--p-faint);
    }

    .gp-sb-apply {
        width: 100%;
        padding: 13px;
        background: var(--p-gold);
        color: #fff;
        font-family: var(--p-font-body);
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border: none;
        border-radius: var(--p-radius);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: opacity 0.2s, transform 0.2s;
    }

    .gp-sb-apply:hover { opacity: 0.88; transform: translateY(-1px); }

    /* ════════════════════════════════
       GALLERY
    ════════════════════════════════ */
    .gp-gallery-filters {
        display: flex;
        gap: 6px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .gp-filter {
        padding: 6px 16px;
        border: 1px solid var(--p-border-str);
        background: transparent;
        color: var(--p-muted);
        font-family: var(--p-font-body);
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border-radius: 2px;
        cursor: pointer;
        transition: all 0.18s;
    }

    .gp-filter.active,
    .gp-filter:hover { border-color: var(--p-gold); color: var(--p-gold); background: var(--p-gold-dim); }

    .gp-gallery-grid {
        columns: 3;
        column-gap: 6px;
    }

    .gp-gallery-item {
        break-inside: avoid;
        margin-bottom: 6px;
        overflow: hidden;
        border-radius: 3px;
        cursor: pointer;
        position: relative;
        background: var(--p-bg);
    }

    .gp-gallery-item img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .gp-gallery-item:hover img { transform: scale(1.06); }

    /* Lightbox */
    .gp-lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.92);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .gp-lightbox img {
        max-width: 100%;
        max-height: 90vh;
        object-fit: contain;
        border-radius: 4px;
    }

    .gp-lightbox-close {
        position: absolute;
        top: 20px; right: 20px;
        width: 42px; height: 42px;
        border-radius: 50%;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s;
        z-index: 10001;
    }

    .gp-lightbox-close:hover { background: rgba(255,255,255,0.22); }

    /* ════════════════════════════════
       CTA BANNER
    ════════════════════════════════ */
    .gp-cta {
        background: #0f0d0a;
        border-radius: 8px;
        padding: clamp(40px, 6vw, 72px) clamp(24px, 5vw, 64px);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .gp-cta::before {
        content: '';
        position: absolute;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        width: 500px; height: 500px;
        background: radial-gradient(circle, color-mix(in srgb, var(--p-gold) 12%, transparent), transparent 65%);
        pointer-events: none;
    }

    .gp-cta-title {
        font-family: var(--p-font-dis);
        font-size: clamp(1.8rem, 3.5vw, 2.8rem);
        font-weight: 400;
        color: #fff;
        margin: 0 0 12px;
        position: relative;
    }

    .gp-cta-sub {
        font-family: var(--p-font-bn);
        font-size: 0.95rem;
        color: rgba(255,255,255,0.5);
        margin: 0 0 36px;
        position: relative;
    }

    .gp-cta-actions {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
        position: relative;
    }

    .gp-cta-btn-gold {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: var(--p-gold);
        color: #fff;
        font-family: var(--p-font-body);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border: none;
        border-radius: 2px;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
    }

    .gp-cta-btn-gold:hover { opacity: 0.88; transform: translateY(-2px); }

    .gp-cta-btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 14px 32px;
        background: #25D366;
        color: #fff;
        font-family: var(--p-font-body);
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border-radius: 2px;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
    }

    .gp-cta-btn-wa:hover { opacity: 0.88; transform: translateY(-2px); }

    /* ════════════════════════════════
       RESPONSIVE
    ════════════════════════════════ */
    @media (max-width: 1024px) {
        .gp-two-col { grid-template-columns: 1fr 260px; }
    }

    @media (max-width: 860px) {
        .gp-two-col {
            grid-template-columns: 1fr;
        }

        /* Move sidebar above gallery on mobile */
        .gp-gallery-col { order: 2; }
        .gp-sidebar    { order: 1; position: static; }

        .gp-hero-stats { gap: 0; flex-wrap: wrap; }
        .gp-hero-stat  { flex: 1 1 80px; }
    }

    @media (max-width: 640px) {
        .gp-batches { grid-template-columns: 1fr; }
        .gp-gallery-grid { columns: 2; }
        .gp-batch-actions { grid-template-columns: 1fr; }
        .gp-cta-actions { flex-direction: column; align-items: center; }
        .gp-cta-btn-gold, .gp-cta-btn-wa { width: 100%; max-width: 280px; justify-content: center; }
    }

    @media (max-width: 400px) {
        .gp-gallery-grid { columns: 2; column-gap: 4px; }
        .gp-gallery-item { margin-bottom: 4px; }
    }
</style>

<div class="gp-root">

    {{-- ════ HERO ════ --}}
    <div class="gp-hero">
        <div class="gp-hero-rule"></div>
        <div class="gp-hero-eyebrow">Dhaka Model Agency</div>
        <h1 class="gp-hero-title">Professional <em>Grooming</em> Classes</h1>
        <p class="gp-hero-sub">Camera confidence, portfolio development, and agency-ready skills — all in one programme.</p>
        <button class="gp-hero-cta" onclick="document.getElementById('gp-batches').scrollIntoView({behavior:'smooth'})">
            View Batches &amp; Apply
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
        </button>

        <div class="gp-hero-stats">
            <div class="gp-hero-stat">
                <div class="gp-hero-stat-num">200+</div>
                <div class="gp-hero-stat-label">Graduates</div>
            </div>
            <div class="gp-hero-stat">
                <div class="gp-hero-stat-num">100%</div>
                <div class="gp-hero-stat-label">Practical</div>
            </div>
            <div class="gp-hero-stat">
                <div class="gp-hero-stat-num">5★</div>
                <div class="gp-hero-stat-label">Rated</div>
            </div>
            <div class="gp-hero-stat">
                <div class="gp-hero-stat-num">Live</div>
                <div class="gp-hero-stat-label">Batches Open</div>
            </div>
        </div>
    </div>

    <div class="gp-body">

        {{-- Ad Top --}}
        <div class="gp-ad"><x-ad-banner position="grooming_top" /></div>

        {{-- ════ BATCHES ════ --}}
        <div class="gp-section" id="gp-batches">
            <div class="gp-section-head">
                <div class="gp-eyebrow">Enrol Now</div>
                <h2 class="gp-section-title">Upcoming <em>Batches</em></h2>
            </div>

            <div class="gp-batches">
                @if($batches->isEmpty())
                    <div class="gp-empty">
                        No upcoming batches right now.<br>Check back soon or contact us for the schedule.
                    </div>
                @else
                    @foreach($batches as $batch)
                    <div class="gp-batch">
                        <div class="gp-batch-accent"></div>
                        <div class="gp-batch-inner">

                            <div class="gp-batch-top">
                                @php
                                    $sc = match($batch->status) { 'open' => 'gp-status--open', 'filling_fast' => 'gp-status--fast', default => 'gp-status--full' };
                                    $sl = match($batch->status) { 'open' => 'Open', 'filling_fast' => 'Filling Fast', default => 'Full' };
                                @endphp
                                <span class="gp-status {{ $sc }}">{{ $sl }}</span>
                                <span class="gp-batch-date">{{ $batch->start_date->format('d M Y') }}</span>
                            </div>

                            <a href="{{ route('grooming.show', $batch->id) }}" class="gp-batch-name">{{ $batch->title }}</a>

                            <div class="gp-batch-meta">
                                @if($batch->trainer)
                                <div class="gp-meta-row">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    {{ $batch->trainer }}
                                </div>
                                @endif
                                @if($batch->venue)
                                <div class="gp-meta-row">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    {{ $batch->venue }}
                                </div>
                                @endif
                                @if(!empty($batch->schedule_json))
                                <div class="gp-meta-row">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                    {{ collect($batch->schedule_json)->map(fn($s) => ($s['day'] ?? '') . ' ' . ($s['time'] ?? ''))->implode(' · ') }}
                                </div>
                                @endif
                            </div>

                            @if($batch->show_seats_public)
                            <div class="gp-seat">
                                <div class="gp-seat-head">
                                    <span>Seats</span>
                                    <span>{{ $batch->filled_seats }} / {{ $batch->seat_limit }}</span>
                                </div>
                                <div class="gp-seat-track">
                                    <div class="gp-seat-fill" style="width:{{ $batch->fill_percentage }}%"></div>
                                </div>
                                @if($batch->remaining_seats > 0 && $batch->remaining_seats <= 5)
                                    <div class="gp-seat-warn">⚡ Only {{ $batch->remaining_seats }} seats left</div>
                                @endif
                            </div>
                            @endif

                            <div class="gp-batch-fee">৳{{ number_format($batch->fee) }}<small>/ person</small></div>

                            <div class="gp-batch-actions">
                                <a href="{{ route('grooming.show', $batch->id) }}" class="gp-btn-outline">View Details</a>
                                <button
                                    class="gp-btn-gold"
                                    @if($batch->status === 'full') disabled @endif
                                    @click="$dispatch('open-grooming-modal')"
                                >
                                    {{ $batch->status === 'full' ? 'Seats Full' : 'Apply Now' }}
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Ad Middle --}}
        <div class="gp-ad"><x-ad-banner position="grooming_middle" /></div>

        {{-- ════ GALLERY + NOTICE SIDEBAR ════ --}}
        <div class="gp-section">
            <div class="gp-two-col">

                {{-- Gallery --}}
                <div class="gp-gallery-col" x-data="{ filter: 'all', lightboxOpen: false, lightboxSrc: '' }">
                    <div class="gp-section-head">
                        <div class="gp-eyebrow">Moments</div>
                        <h2 class="gp-section-title">Class <em>Gallery</em></h2>
                    </div>

                    @if($gallery->isNotEmpty())
                        <div class="gp-gallery-filters">
                            <button class="gp-filter" :class="filter==='all'?'active':''" @click="filter='all'">All</button>
                            <button class="gp-filter" :class="filter==='training'?'active':''" @click="filter='training'">Training</button>
                            <button class="gp-filter" :class="filter==='graduation'?'active':''" @click="filter='graduation'">Graduation</button>
                            <button class="gp-filter" :class="filter==='event'?'active':''" @click="filter='event'">Event</button>
                        </div>

                        <div class="gp-gallery-grid">
                            @foreach($gallery as $photo)
                            <div class="gp-gallery-item"
                                x-show="filter === 'all' || filter === '{{ $photo->category }}'"
                                x-transition
                                @click="lightboxSrc = '{{ asset('storage/' . $photo->image) }}'; lightboxOpen = true">
                                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" loading="lazy">
                            </div>
                            @endforeach
                        </div>

                        <div style="margin-top: 20px;">
                            {{ $gallery->links('vendor.pagination.custom-numbered') }}
                        </div>

                        {{-- Lightbox --}}
                        <div class="gp-lightbox"
                            x-show="lightboxOpen"
                            x-transition.opacity.duration.250ms
                            @click.self="lightboxOpen = false"
                            @keydown.escape.window="lightboxOpen = false"
                            style="display:none">
                            <button class="gp-lightbox-close" @click="lightboxOpen = false">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            </button>
                            <img :src="lightboxSrc" alt="Gallery photo" @click.stop>
                        </div>
                    @else
                        <p style="color:var(--p-faint); font-size:0.9rem; font-family:var(--p-font-bn);">No gallery images yet.</p>
                    @endif
                </div>

                {{-- Notice Sidebar --}}
                <div class="gp-sidebar">
                    <div class="gp-sidebar-head">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        <span class="gp-sidebar-head-title">Notice Board</span>
                    </div>

                    <div class="gp-notices">
                        @if($notices->isNotEmpty())
                            @foreach($notices as $notice)
                            <div class="gp-notice-item gp-notice-item--{{ $notice->priority }}">
                                <div class="gp-notice-title">{{ $notice->title }}</div>
                                <div class="gp-notice-body">{{ $notice->message }}</div>
                            </div>
                            @endforeach
                        @else
                            <div class="gp-no-notices">No new notices.</div>
                        @endif
                    </div>

                    <div class="gp-sidebar-foot">
                        <div class="gp-sb-stats">
                            <div class="gp-sb-stat">
                                <div class="gp-sb-stat-num">200+</div>
                                <div class="gp-sb-stat-label">Graduates</div>
                            </div>
                            <div class="gp-sb-stat">
                                <div class="gp-sb-stat-num">100%</div>
                                <div class="gp-sb-stat-label">Practical</div>
                            </div>
                        </div>
                        <button class="gp-sb-apply" @click="$dispatch('open-grooming-modal')">
                            Apply Now
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Ad Bottom --}}
        <div class="gp-ad"><x-ad-banner position="grooming_bottom" /></div>

        {{-- ════ CTA BANNER ════ --}}
        <div class="gp-cta">
            <h2 class="gp-cta-title">Begin Your Journey Today</h2>
            <p class="gp-cta-sub">Limited seats available. Secure your spot now.</p>
            <div class="gp-cta-actions">
                <button class="gp-cta-btn-gold" @click="$dispatch('open-grooming-modal')">
                    Apply Now
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </button>

                @if($settings?->contact_phone)
                @php $wa = preg_replace('/[^0-9]/', '', $settings->contact_phone); @endphp
                <a href="https://wa.me/{{ $wa }}?text=আমি%20গ্রুমিং%20ক্লাস%20সম্পর্কে%20জানতে%20চাই।"
                   target="_blank" rel="noopener" class="gp-cta-btn-wa">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                    WhatsApp
                </a>
                @endif
            </div>
        </div>

    </div>{{-- /gp-body --}}
</div>{{-- /gp-root --}}
</div>
