<div x-data="{ faqOpen: null }">
<style>
    /* ── FONTS ── */
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500;600&display=swap');

    @font-face {
        font-family: 'SolaimanLipi';
        src: local('SolaimanLipi'),
             url('/fonts/SolaimanLipi.woff2') format('woff2'),
             url('/fonts/SolaimanLipi.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

    /* ── DESIGN TOKENS ── */
    :root {
        --g-gold:       var(--gold, #b89a5a);
        --g-gold-light: color-mix(in srgb, var(--g-gold) 12%, transparent);
        --g-gold-mid:   color-mix(in srgb, var(--g-gold) 25%, transparent);
        --g-surface:    var(--bg-surface, #fff);
        --g-bg:         var(--bg-secondary, #f8f7f5);
        --g-border:     var(--border, #e8e3da);
        --g-text:       var(--text-primary, #1a1410);
        --g-muted:      var(--text-secondary, #7a7063);
        --g-faint:      var(--text-muted, #a89e92);
        --font-display: 'Cormorant Garamond', 'SolaimanLipi', serif;
        --font-body:    'DM Sans', 'SolaimanLipi', sans-serif;
        --font-bangla:  'SolaimanLipi', 'DM Sans', sans-serif;
        --radius:       8px;
        --shadow-sm:    0 2px 12px rgba(0,0,0,0.06);
        --shadow-md:    0 8px 32px rgba(0,0,0,0.10);
        --shadow-lg:    0 20px 60px rgba(0,0,0,0.13);
    }

    /* ── GLOBAL RESET FOR THIS COMPONENT ── */
    .gb-page * { box-sizing: border-box; }
    .gb-page { font-family: var(--font-body); color: var(--g-text); }

    /* ════════════════════════════════════════
       HERO — cinematic top section
    ════════════════════════════════════════ */
    .gb-hero {
        background: var(--g-bg);
        border-bottom: 1px solid var(--g-border);
        padding: clamp(32px, 6vw, 72px) clamp(16px, 5vw, 80px) 0;
        overflow: hidden;
        position: relative;
    }

    /* Gold accent line top */
    .gb-hero::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--g-gold), transparent);
    }

    .gb-hero__inner {
        max-width: 1320px;
        margin: 0 auto;
    }

    .gb-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.72rem;
        font-weight: 500;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--g-muted);
        text-decoration: none;
        margin-bottom: 28px;
        transition: color 0.2s;
    }
    .gb-back:hover { color: var(--g-gold); }

    .gb-hero__grid {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 32px;
        align-items: end;
        padding-bottom: 40px;
    }

    .gb-badge-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .gb-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        border-radius: 2px;
        font-family: var(--font-body);
    }

    .gb-badge--open   { background: #d4edda; color: #1a7336; }
    .gb-badge--fast   { background: #fff3cd; color: #8a6000; }
    .gb-badge--closed { background: #f5e0e0; color: #8a1c1c; }

    .gb-hero__title {
        font-family: var(--font-display);
        font-size: clamp(2.4rem, 5.5vw, 4.2rem);
        font-weight: 300;
        color: var(--g-text);
        line-height: 1.15;
        letter-spacing: -0.01em;
        margin: 0 0 24px;
    }

    /* Share bar */
    .gb-share {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .gb-share-label {
        font-size: 0.68rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--g-faint);
    }

    .gb-share-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 4px;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        border: 1.5px solid transparent;
        cursor: pointer;
        text-decoration: none;
        background: none;
        transition: transform 0.15s, opacity 0.15s;
    }
    .gb-share-btn:hover { transform: translateY(-1px); opacity: 0.85; }
    .gb-share-btn--fb   { background: #1877F2; color: #fff; border-color: #1877F2; }
    .gb-share-btn--ig   { background: linear-gradient(135deg,#f09433,#dc2743,#bc1888); color:#fff; }
    .gb-share-btn--copy { background: var(--g-surface); color: var(--g-text); border-color: var(--g-border); }
    .gb-share-btn--copy.copied { color: #16a34a; border-color: #16a34a; }

    /* Hero stats strip */
    .gb-stat-strip {
        display: flex;
        gap: 0;
        border-top: 1px solid var(--g-border);
        margin-top: 32px;
        overflow-x: auto;
        scrollbar-width: none;
    }
    .gb-stat-strip::-webkit-scrollbar { display: none; }

    .gb-stat {
        flex: 1;
        min-width: 120px;
        padding: 18px 24px;
        border-right: 1px solid var(--g-border);
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .gb-stat:last-child { border-right: none; }

    .gb-stat__label {
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--g-faint);
    }

    .gb-stat__value {
        font-family: var(--font-bangla);
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--g-text);
        white-space: nowrap;
    }

    .gb-stat__value--gold { color: var(--g-gold); }
    /* Your existing CSS stays here... */

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .gb-hide-mobile {
            display: none !important;
        }
    }

    /* ════════════════════════════════════════
       LAYOUT
    ════════════════════════════════════════ */
    .gb-layout {
        max-width: 1320px;
        margin: 0 auto;
        padding: clamp(32px, 5vw, 60px) clamp(16px, 5vw, 80px) clamp(60px, 8vw, 120px);
        display: grid;
        grid-template-columns: 1fr 360px;
        grid-template-areas: "main sidebar";
        gap: clamp(32px, 4vw, 60px);
        align-items: start;
    }

    .gb-main    { grid-area: main; min-width: 0; }
    .gb-sidebar { grid-area: sidebar; }

    /* ════════════════════════════════════════
       AD SLOTS
    ════════════════════════════════════════ */
    .gb-ad { margin-bottom: 40px; }

    /* ════════════════════════════════════════
       SECTION HEADINGS
    ════════════════════════════════════════ */
    .gb-section { margin-bottom: clamp(48px, 6vw, 72px); }

    .gb-section-head {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .gb-section-eyebrow {
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.22em;
        text-transform: uppercase;
        color: var(--g-gold);
        white-space: nowrap;
    }

    .gb-section-line {
        flex: 1;
        height: 1px;
        background: var(--g-border);
    }

    .gb-section-title {
        font-family: var(--font-display);
        font-size: clamp(1.6rem, 3vw, 2.2rem);
        font-weight: 300;
        color: var(--g-text);
        margin: 0 0 24px;
        line-height: 1.25;
    }

    /* ════════════════════════════════════════
       COURSE DESCRIPTION
    ════════════════════════════════════════ */
    .gb-description {
        font-family: var(--font-bangla);
        font-size: clamp(0.9rem, 1.8vw, 1.0rem);
        color: var(--g-muted);
        line-height: 1.9;
    }

    .gb-description p { margin: 0 0 1em; }
    .gb-description p:last-child { margin-bottom: 0; }

    /* ════════════════════════════════════════
       TRAINER CARD
    ════════════════════════════════════════ */
    .gb-trainer-card {
        display: flex;
        align-items: center;
        gap: 24px;
        background: var(--g-surface);
        border: 1px solid var(--g-border);
        border-radius: var(--radius);
        padding: clamp(20px, 3vw, 32px);
        box-shadow: var(--shadow-sm);
    }

    .gb-trainer-img {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--g-gold-light);
        flex-shrink: 0;
        background: var(--g-bg);
    }

    .gb-trainer-initials {
        width: 88px;
        height: 88px;
        border-radius: 50%;
        background: var(--g-gold-light);
        border: 3px solid var(--g-gold-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-display);
        font-size: 1.8rem;
        font-weight: 300;
        color: var(--g-gold);
        flex-shrink: 0;
    }

    .gb-trainer-name {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--g-text);
        margin: 0 0 4px;
    }

    .gb-trainer-role {
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--g-gold);
        margin: 0 0 10px;
    }

    .gb-trainer-bio {
        font-family: var(--font-bangla);
        font-size: 0.875rem;
        color: var(--g-muted);
        line-height: 1.7;
        margin: 0;
    }

    /* ════════════════════════════════════════
       BENEFITS GRID
    ════════════════════════════════════════ */
    .gb-benefits {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .gb-benefit {
        background: var(--g-surface);
        border: 1px solid var(--g-border);
        border-radius: var(--radius);
        padding: clamp(18px, 2.5vw, 26px);
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.25s, border-color 0.25s;
    }

    .gb-benefit::before {
        content: '';
        position: absolute;
        top: 0; left: 0;
        width: 3px; height: 100%;
        background: var(--g-gold);
        opacity: 0;
        transition: opacity 0.25s;
    }

    .gb-benefit:hover { box-shadow: var(--shadow-sm); border-color: var(--g-gold-mid); }
    .gb-benefit:hover::before { opacity: 1; }

    .gb-benefit__icon {
        width: 36px; height: 36px;
        border-radius: 50%;
        background: var(--g-gold-light);
        display: flex; align-items: center; justify-content: center;
        color: var(--g-gold);
        margin-bottom: 14px;
    }

    .gb-benefit__title {
        font-family: var(--font-bangla);
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--g-text);
        margin: 0 0 8px;
        line-height: 1.45;
    }

    .gb-benefit__desc {
        font-family: var(--font-bangla);
        font-size: 0.9rem;
        color: var(--g-muted);
        line-height: 1.65;
        margin: 0;
    }

    /* ════════════════════════════════════════
       COURSE MODULES — timeline style
    ════════════════════════════════════════ */
    .gb-modules { display: flex; flex-direction: column; gap: 0; }

    .gb-module {
        display: grid;
        grid-template-columns: 48px 1fr;
        gap: 0 20px;
        position: relative;
    }

    .gb-module__line-col {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .gb-module__dot {
        width: 14px; height: 14px;
        border-radius: 50%;
        background: var(--g-surface);
        border: 2px solid var(--g-gold);
        flex-shrink: 0;
        margin-top: 4px;
        z-index: 1;
        position: relative;
    }

    .gb-module__connector {
        width: 1px;
        flex: 1;
        background: var(--g-border);
        margin-top: 4px;
    }

    .gb-module:last-child .gb-module__connector { display: none; }

    .gb-module__body {
        background: var(--g-surface);
        border: 1px solid var(--g-border);
        border-radius: var(--radius);
        padding: clamp(16px, 2vw, 22px);
        margin-bottom: 14px;
        transition: border-color 0.2s;
    }

    .gb-module:hover .gb-module__body { border-color: var(--g-gold-mid); }

    .gb-module__name {
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--g-gold);
        margin-bottom: 8px;
        font-family: var(--font-body);
    }

    .gb-module__topics {
        font-family: var(--font-bangla);
        font-size: 0.9rem;
        color: var(--g-text);
        line-height: 1.75;
        margin: 0;
    }

    /* ════════════════════════════════════════
       ELIGIBILITY
    ════════════════════════════════════════ */
    .gb-eligibility-list {
        list-style: none;
        padding: 0; margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .gb-eligibility-list li {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        font-family: var(--font-bangla);
        font-size: 0.92rem;
        color: var(--g-muted);
        line-height: 1.6;
        padding: 14px 18px;
        background: var(--g-surface);
        border: 1px solid var(--g-border);
        border-radius: var(--radius);
    }

    .gb-eligibility-list li svg { color: var(--g-gold); flex-shrink: 0; margin-top: 2px; }

    /* ════════════════════════════════════════
       FAQ ACCORDION
    ════════════════════════════════════════ */
    .gb-faq { display: flex; flex-direction: column; gap: 8px; }

    .gb-faq-item {
        border: 1px solid var(--g-border);
        border-radius: var(--radius);
        background: var(--g-surface);
        overflow: hidden;
        transition: border-color 0.2s;
    }

    .gb-faq-item.is-open { border-color: var(--g-gold-mid); }

    .gb-faq-q {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        padding: 18px 22px;
        font-family: var(--font-bangla);
        font-size: 0.92rem;
        font-weight: 600;
        color: var(--g-text);
        cursor: pointer;
        background: none;
        border: none;
        text-align: left;
    }

    .gb-faq-chevron {
        flex-shrink: 0;
        color: var(--g-gold);
        transition: transform 0.3s;
    }

    .gb-faq-item.is-open .gb-faq-chevron { transform: rotate(180deg); }

    .gb-faq-a {
        display: none;
        padding: 0 22px 18px;
        font-family: var(--font-bangla);
        font-size: 0.875rem;
        color: var(--g-muted);
        line-height: 1.75;
    }

    .gb-faq-item.is-open .gb-faq-a { display: block; }

    /* ════════════════════════════════════════
       STICKY SIDEBAR
    ════════════════════════════════════════ */
    .gb-sidebar-card {
        background: var(--g-surface);
        border: 1px solid var(--g-border);
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        overflow: hidden;
        position: sticky;
        top: 24px;
    }

    .gb-sidebar-top {
        background: var(--g-text);
        padding: clamp(22px, 3vw, 32px);
        position: relative;
        overflow: hidden;
    }

    /* subtle gold shimmer on dark sidebar top */
    .gb-sidebar-top::after {
        content: '';
        position: absolute;
        bottom: -40px; right: -40px;
        width: 140px; height: 140px;
        border-radius: 50%;
        background: radial-gradient(circle, color-mix(in srgb, var(--g-gold) 22%, transparent), transparent 70%);
        pointer-events: none;
    }

    .gb-sb-fee-label {
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
        margin-bottom: 6px;
    }

    .gb-sb-fee {
        font-family: var(--font-display);
        font-size: clamp(3rem, 4vw, 2.8rem);
        font-weight: 700;
        color: var(--g-gold);
        line-height: 1;
        margin-bottom: 20px;
    }

    .gb-sb-apply {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        gap: 8px;
        padding: 14px 20px;
        background: var(--g-gold);
        color: #fff;
        font-family: var(--font-bangla);
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s, transform 0.2s;
    }

    .gb-sb-apply:hover { opacity: 0.9; transform: translateY(-1px); }

    .gb-sidebar-body {
        padding: clamp(20px, 3vw, 28px);
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .gb-sb-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--g-border);
    }

    .gb-sb-row:last-child { border-bottom: none; padding-bottom: 0; }

    .gb-sb-icon {
        width: 36px; height: 36px;
        background: var(--g-gold-light);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--g-gold);
        flex-shrink: 0;
    }

    .gb-sb-key {
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--g-faint);
        margin-bottom: 4px;
    }

    .gb-sb-val {
        font-family: var(--font-bangla);
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--g-text);
        line-height: 1.5;
    }

    /* Schedule pills */
    .gb-schedule-pills { display: flex; flex-direction: column; gap: 6px; margin-top: 4px; }

    .gb-schedule-pill {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 7px 12px;
        background: var(--g-bg);
        border: 1px solid var(--g-border);
        border-radius: 4px;
        font-size: 0.82rem;
    }

    .gb-schedule-pill span:first-child { font-weight: 500; color: var(--g-text); font-family: var(--font-bangla); }
    .gb-schedule-pill span:last-child  { font-weight: 600; color: var(--g-gold); font-family: var(--font-bangla); }

    /* Seat bar */
    .gb-seat-bar { margin-top: 8px; }

    .gb-seat-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.75rem;
        color: var(--g-muted);
        margin-bottom: 6px;
    }

    .gb-seat-track {
        height: 5px;
        background: var(--g-border);
        border-radius: 99px;
        overflow: hidden;
    }

    .gb-seat-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--g-gold), color-mix(in srgb, var(--g-gold) 70%, #fff));
        border-radius: 99px;
        transition: width 1s ease;
    }

    /* Sidebar share */
    .gb-sb-share {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
        padding-top: 20px;
        border-top: 1px solid var(--g-border);
    }

    /* ════════════════════════════════════════
       MOBILE STICKY BAR
    ════════════════════════════════════════ */
    .gb-mobile-bar {
        display: none;
        position: fixed;
        bottom: 0; left: 0; right: 0;
        background: var(--g-surface);
        border-top: 1px solid var(--g-border);
        padding: 12px 16px;
        z-index: 200;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        box-shadow: 0 -4px 24px rgba(0,0,0,0.1);
    }

    .gb-mobile-fee {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 600;
        color: var(--g-gold);
    }

    .gb-mobile-apply {
        flex: 1;
        max-width: 220px;
        text-align: center;
        padding: 13px 20px;
        background: var(--g-gold);
        color: #fff;
        font-family: var(--font-bangla);
        font-size: 0.9rem;
        font-weight: 700;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .gb-mobile-apply:hover { opacity: 0.88; }

    /* ════════════════════════════════════════
       RESPONSIVE
    ════════════════════════════════════════ */
    @media (max-width: 1100px) {
        .gb-layout { grid-template-columns: 1fr 320px; }
    }

    @media (max-width: 860px) {
        .gb-layout {
            grid-template-columns: 1fr;
            grid-template-areas: "sidebar" "main";
            padding-bottom: 90px;
        }

        .gb-sidebar-card {
            position: static;
        }

        /* Hide desktop CTA on mobile — mobile bar handles it */
        .gb-sb-apply { display: none; }
        .gb-mobile-bar { display: flex; }

        .gb-hero__grid {
            grid-template-columns: 1fr;
        }

        .gb-benefits { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .gb-trainer-card { flex-direction: column; align-items: flex-start; }
        .gb-stat { min-width: 100px; padding: 14px 16px; }
    }

    @media (max-width: 480px) {
        .gb-share-btn span { display: none; }
        .gb-share-btn { padding: 8px 10px; }
    }
</style>

<div class="gb-page">

    {{-- ════ HERO ════ --}}
    <div class="gb-hero">
        <div class="gb-hero__inner">
            <a href="/grooming-lab" class="gb-back">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                All Courses
            </a>

            <div class="gb-hero__grid">
                <div>
                    <div class="gb-badge-row">
                        @php
                            $statusClass = match($batch->status) {
                                'open'         => 'gb-badge--open',
                                'filling_fast' => 'gb-badge--fast',
                                default        => 'gb-badge--closed',
                            };
                            $statusLabel = match($batch->status) {
                                'open'         => 'Open for Admission',
                                'filling_fast' => '🔥 Filling Fast',
                                default        => 'Admission Closed',
                            };
                        @endphp
                        <span class="gb-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                    </div>

                    <h1 class="gb-hero__title">{{ $batch->title }}</h1>

                    <div class="gb-share">
                        <span class="gb-share-label">Share</span>
                        <a class="gb-share-btn gb-share-btn--fb"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" rel="noopener">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                            <span>Facebook</span>
                        </a>
                        <button class="gb-share-btn gb-share-btn--ig" onclick="gbShareInstagram()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                            <span>Instagram</span>
                        </button>
                        <button class="gb-share-btn gb-share-btn--copy" id="gbCopyBtn1" onclick="gbCopyLink('gbCopyBtn1','gbCopyTxt1')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            <span id="gbCopyTxt1">Copy Link</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Stat strip --}}
            <div class="gb-stat-strip">
                <div class="gb-stat">
                    <div class="gb-stat__label">Course Fee</div>
                    <div class="gb-stat__value gb-stat__value--gold">৳{{ number_format($batch->fee) }}</div>
                </div>
                <div class="gb-stat">
                    <div class="gb-stat__label">Start Date</div>
                    <div class="gb-stat__value">{{ $batch->start_date->format('d M, Y') }}</div>
                </div>
                @if($batch->trainer)
                <div class="gb-stat">
                    <div class="gb-stat__label">Lead Trainer</div>
                    <div class="gb-stat__value">{{ $batch->trainer }}</div>
                </div>
                @endif

                @if($batch->venue)
                <!-- Added 'gb-hide-mobile' class here -->
                <div class="gb-stat gb-hide-mobile">
                    <div class="gb-stat__label">Venue</div>
                    <div class="gb-stat__value">{{ $batch->venue }}</div>
                </div>
                @endif

                @if($batch->show_seats_public)
                <!-- Added 'gb-hide-mobile' class here -->
                <div class="gb-stat gb-hide-mobile">
                    <div class="gb-stat__label">Seats Left</div>
                    <div class="gb-stat__value">{{ $batch->remaining_seats }} / {{ $batch->seat_limit }}</div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ════ LAYOUT ════ --}}
    <div class="gb-layout">

        {{-- ── MAIN ── --}}
        <div class="gb-main">

            <div class="gb-ad"><x-ad-banner position="batch_show_top" /></div>

            {{-- Course Overview --}}
            @if($batch->description)
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">Overview</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">About This Course</h2>
                <div class="gb-description">{!! $batch->description !!}</div>
            </div>
            @endif

            {{-- Trainer --}}
            @if($batch->trainer)
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">Instructor</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">Meet Your Trainer</h2>
                <div class="gb-trainer-card">
                    @if(isset($batch->trainer_image) && $batch->trainer_image)
                        <img src="{{ asset('storage/' . $batch->trainer_image) }}"
                             alt="{{ $batch->trainer }}"
                             class="gb-trainer-img">
                    @else
                        <div class="gb-trainer-initials">
                            {{ mb_strtoupper(mb_substr($batch->trainer, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h3 class="gb-trainer-name">{{ $batch->trainer }}</h3>
                        @if(isset($batch->trainer_designation) && $batch->trainer_designation)
                            <p class="gb-trainer-role">{{ $batch->trainer_designation }}</p>
                        @else
                            <p class="gb-trainer-role">Lead Trainer</p>
                        @endif
                        @if(isset($batch->trainer_bio) && $batch->trainer_bio)
                            <p class="gb-trainer-bio">{{ $batch->trainer_bio }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Benefits --}}
            @if(!empty($batch->benefits))
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">Curriculum</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">What You Will Learn</h2>
                <div class="gb-benefits">
                    @foreach($batch->benefits as $benefit)
                    <div class="gb-benefit">
                        <div class="gb-benefit__icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <h4 class="gb-benefit__title">{{ $benefit['title'] }}</h4>
                        <p class="gb-benefit__desc">{{ $benefit['description'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="gb-ad"><x-ad-banner position="batch_show_middle" /></div>

            {{-- Modules --}}
            @if(!empty($batch->course_modules))
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">Syllabus</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">Course Modules</h2>
                <div class="gb-modules">
                    @foreach($batch->course_modules as $module)
                    <div class="gb-module">
                        <div class="gb-module__line-col">
                            <div class="gb-module__dot"></div>
                            <div class="gb-module__connector"></div>
                        </div>
                        <div class="gb-module__body">
                            <div class="gb-module__name">{{ $module['module_name'] }}</div>
                            <p class="gb-module__topics">{{ $module['topics'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Eligibility --}}
            @if(!empty($batch->eligibility))
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">Requirements</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">Eligibility & Requirements</h2>
                <ul class="gb-eligibility-list">
                    @foreach($batch->eligibility as $item)
                    <li>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        {{ is_array($item) ? ($item['requirement'] ?? $item) : $item }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- FAQ --}}
            @if(!empty($batch->faqs))
            <div class="gb-section">
                <div class="gb-section-head">
                    <span class="gb-section-eyebrow">FAQ</span>
                    <div class="gb-section-line"></div>
                </div>
                <h2 class="gb-section-title">Frequently Asked Questions</h2>
                <div class="gb-faq">
                    @foreach($batch->faqs as $i => $faq)
                    <div class="gb-faq-item" id="faq-{{ $i }}">
                        <button class="gb-faq-q" onclick="gbToggleFaq({{ $i }})">
                            <span>{{ $faq['question'] }}</span>
                            <svg class="gb-faq-chevron" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                        <div class="gb-faq-a">{{ $faq['answer'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>{{-- /main --}}

        {{-- ── SIDEBAR ── --}}
        <div class="gb-sidebar">
            <div class="gb-sidebar-card">

                {{-- Dark top: fee + CTA --}}
                <div class="gb-sidebar-top">
                    <div class="gb-sb-fee-label">Course Fee</div>
                    <div class="gb-sb-fee">৳{{ number_format($batch->fee) }}</div>
                    <button class="gb-sb-apply" @click="$dispatch('open-grooming-modal')">
                        Apply Now
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>

                {{-- Details --}}
                <div class="gb-sidebar-body">

                    {{-- Start Date --}}
                    <div class="gb-sb-row">
                        <div class="gb-sb-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        </div>
                        <div>
                            <div class="gb-sb-key">Start Date</div>
                            <div class="gb-sb-val">{{ $batch->start_date->format('d F, Y') }}</div>
                        </div>
                    </div>

                    {{-- Schedule --}}
                    @if(!empty($batch->schedule_json))
                    <div class="gb-sb-row">
                        <div class="gb-sb-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        </div>
                        <div style="width:100%">
                            <div class="gb-sb-key">Class Schedule</div>
                            <div class="gb-schedule-pills">
                                @foreach($batch->schedule_json as $s)
                                <div class="gb-schedule-pill">
                                    <span>{{ $s['day'] ?? '' }}</span>
                                    <span>{{ $s['time'] ?? '' }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Trainer --}}
                    @if($batch->trainer)
                    <div class="gb-sb-row">
                        <div class="gb-sb-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div>
                            <div class="gb-sb-key">Lead Trainer</div>
                            <div class="gb-sb-val">{{ $batch->trainer }}</div>
                            @if(isset($batch->trainer_designation) && $batch->trainer_designation)
                                <div style="font-size:0.75rem; color:var(--g-faint); margin-top:2px;">{{ $batch->trainer_designation }}</div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Venue --}}
                    @if($batch->venue)
                    <div class="gb-sb-row">
                        <div class="gb-sb-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <div class="gb-sb-key">Venue</div>
                            <div class="gb-sb-val">{{ $batch->venue }}</div>
                        </div>
                    </div>
                    @endif

                    {{-- Seats --}}
                    @if($batch->show_seats_public)
                    <div class="gb-sb-row">
                        <div class="gb-sb-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </div>
                        <div style="width:100%">
                            <div class="gb-sb-key">Seat Availability</div>
                            <div class="gb-seat-bar">
                                <div class="gb-seat-meta">
                                    <span class="gb-sb-val">{{ $batch->remaining_seats }} seats left</span>
                                    <span style="font-size:0.78rem; color:var(--g-faint);">{{ $batch->filled_seats }}/{{ $batch->seat_limit }}</span>
                                </div>
                                <div class="gb-seat-track">
                                    <div class="gb-seat-fill" style="width:{{ $batch->fill_percentage }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Sidebar share --}}
                    <div class="gb-sb-share">
                        <span class="gb-share-label" style="font-size:0.62rem;">Share</span>
                        <a class="gb-share-btn gb-share-btn--fb"
                           href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                           target="_blank" rel="noopener">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <button class="gb-share-btn gb-share-btn--ig" onclick="gbShareInstagram()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                        </button>
                        <button class="gb-share-btn gb-share-btn--copy" id="gbCopyBtn2" onclick="gbCopyLink('gbCopyBtn2')">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        </button>
                    </div>

                    {{-- Sidebar Ad --}}
                    <div><x-ad-banner position="batch_show_sidebar" /></div>

                </div>{{-- /sidebar-body --}}
            </div>
        </div>{{-- /sidebar --}}

    </div>{{-- /layout --}}

    {{-- Mobile sticky bar --}}
    <div class="gb-mobile-bar">
        <span class="gb-mobile-fee">৳{{ number_format($batch->fee) }}</span>
        <button class="gb-mobile-apply" @click="$dispatch('open-grooming-modal')">Apply Now →</button>
    </div>

</div>{{-- /gb-page --}}

<script>
function gbCopyLink(btnId = 'gbCopyBtn1', txtId = null) {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const btn = document.getElementById(btnId);
        if (btn) btn.classList.add('copied');
        if (txtId) {
            const txt = document.getElementById(txtId);
            if (txt) { txt.textContent = 'Copied!'; setTimeout(() => txt.textContent = 'Copy Link', 2000); }
        }
        if (btn) setTimeout(() => btn.classList.remove('copied'), 2000);
    });
}

function gbShareInstagram() {
    gbCopyLink();
    setTimeout(() => window.open('https://www.instagram.com/', '_blank'), 600);
}

function gbToggleFaq(index) {
    const el = document.getElementById('faq-' + index);
    if (!el) return;
    const isOpen = el.classList.contains('is-open');
    document.querySelectorAll('.gb-faq-item.is-open').forEach(i => i.classList.remove('is-open'));
    if (!isOpen) el.classList.add('is-open');
}
</script>
</div>
