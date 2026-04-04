<x-app-layout title="Top Verified Talent">

    <style>
        /* ═══════════════════════════════════════════
           PAGE-LEVEL STYLES
           Inherits CSS tokens from app.blade.php
        ═══════════════════════════════════════════ */

        /* ── Hero ── */
        .hero {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            background: var(--bg-primary);
        }

        /* Geometric background shapes */
        .hero-deco {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .hero-deco-ring {
            position: absolute;
            border-radius: 50%;
            border: 1px solid var(--border);
        }
        .hero-deco-ring-1 {
            width: 680px; height: 680px;
            top: -200px; right: -160px;
        }
        .hero-deco-ring-2 {
            width: 420px; height: 420px;
            top: -60px; right: 60px;
        }
        .hero-deco-ring-3 {
            width: 900px; height: 900px;
            bottom: -400px; left: -300px;
            border-color: var(--border);
            opacity: 0.5;
        }
        .hero-deco-line {
            position: absolute;
            background: var(--border-strong);
        }
        .hero-deco-line-v {
            width: 1px;
            top: 0; bottom: 0;
            right: 38%;
            opacity: 0.4;
        }

        /* Gold dot grid */
        .hero-deco-dots {
            position: absolute;
            top: 80px; right: 80px;
            width: 120px; height: 120px;
            background-image: radial-gradient(circle, var(--gold) 1px, transparent 1px);
            background-size: 16px 16px;
            opacity: 0.18;
        }

        .hero-inner {
            position: relative;
            z-index: 2;
            max-width: 1440px;
            margin: 0 auto;
            padding: 80px 40px 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        }

        /* Hero left */
        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 22px;
        }
        .hero-eyebrow-line {
            width: 32px; height: 1px;
            background: var(--gold);
            flex-shrink: 0;
        }

        .hero-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 5.5vw, 5.2rem);
            font-weight: 300;
            line-height: 1.08;
            letter-spacing: -0.01em;
            color: var(--text-primary);
            margin-bottom: 28px;
        }
        .hero-headline strong {
            font-weight: 600;
            display: block;
        }
        .hero-headline em {
            font-style: italic;
            color: var(--gold);
        }

        .hero-sub {
            font-size: 1rem;
            font-weight: 300;
            color: var(--text-secondary);
            line-height: 1.8;
            max-width: 440px;
            margin-bottom: 40px;
        }

        .hero-cta-row {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        /* Stats strip */
        .hero-stats {
            display: flex;
            gap: 32px;
            margin-top: 56px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
        }
        .hero-stat {}
        .hero-stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1;
        }
        .hero-stat-num span { color: var(--gold); }
        .hero-stat-label {
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 5px;
        }

        /* Hero right — stacked cards */
        .hero-gallery {
            position: relative;
            height: 580px;
        }
        .hero-card {
            position: absolute;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }
        .hero-card img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .hero-card:hover img { transform: scale(1.04); }

        .hero-card-1 {
            width: 260px; height: 360px;
            top: 0; left: 0;
        }
        .hero-card-2 {
            width: 210px; height: 290px;
            top: 60px; right: 20px;
        }
        .hero-card-3 {
            width: 180px; height: 230px;
            bottom: 0; left: 80px;
        }

        .hero-card-label {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 20px 14px 14px;
            background: linear-gradient(to top, rgba(10,8,4,0.85) 0%, transparent 100%);
        }
        .hero-card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 400;
            color: #fff;
            letter-spacing: 0.03em;
        }
        .hero-card-cat {
            font-size: 0.58rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold-light, #d4ab6a);
        }

        /* Floating verified badge on card */
        .hero-card-badge {
            position: absolute;
            top: 12px; right: 12px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px);
            padding: 4px 9px;
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.58rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #1a1714;
        }
        .hero-card-badge svg { color: #2a7d4f; }

        /* Gold accent box */
        .hero-accent-box {
            position: absolute;
            bottom: 30px; right: -10px;
            background: var(--gold);
            padding: 16px 20px;
            color: #faf8f5;
        }
        .hero-accent-box-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 600;
            line-height: 1;
        }
        .hero-accent-box-label {
            font-size: 0.55rem;
            font-weight: 500;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            opacity: 0.8;
            margin-top: 3px;
        }

        /* ── Categories Strip ── */
        .categories-strip {
            background: var(--bg-surface);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            padding: 0;
            overflow: hidden;
        }
        .categories-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: stretch;
        }
        .category-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 22px 32px;
            border-right: 1px solid var(--border);
            cursor: pointer;
            transition: background 0.22s, color 0.22s;
            text-decoration: none;
            flex: 1;
            justify-content: center;
        }
        .category-item:first-child { border-left: none; padding-left: 0; }
        .category-item:last-child { border-right: none; }
        .category-item:hover { background: var(--gold-bg); }
        .category-item:hover .cat-icon { color: var(--gold); }
        .category-item:hover .cat-label { color: var(--text-primary); }
        .cat-icon { color: var(--text-muted); transition: color 0.22s; flex-shrink: 0; }
        .cat-label {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-secondary);
            transition: color 0.22s;
            white-space: nowrap;
        }

        /* ── Featured Talent Section ── */
        .talent-section {
            padding: 100px 0;
            background: var(--bg-primary);
        }
        .section-inner {
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 40px;
        }
        .section-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 56px;
            gap: 24px;
            flex-wrap: wrap;
        }
        .section-header-left {}
        .section-eyebrow {
            font-size: 0.58rem;
            font-weight: 600;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-eyebrow::before {
            content: '';
            width: 28px; height: 1px;
            background: var(--gold);
        }
        .section-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2rem, 3.5vw, 3rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.15;
        }
        .section-title strong { font-weight: 600; }

        /* Talent grid */
        .talent-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2px;
        }

        /* Talent card */
        .talent-card {
            position: relative;
            overflow: hidden;
            background: var(--bg-secondary);
            cursor: pointer;
            display: block;
            text-decoration: none;
        }
        .talent-card-media {
            aspect-ratio: 3/4;
            overflow: hidden;
            position: relative;
            background: var(--bg-secondary);
        }
        .talent-card-media img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .talent-card:hover .talent-card-media img { transform: scale(1.07); }

        /* Placeholder avatar */
        .talent-card-placeholder {
            width: 100%; height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: var(--text-muted);
            background: var(--bg-secondary);
        }
        .talent-card-placeholder svg { opacity: 0.35; }
        .talent-card-placeholder span {
            font-size: 0.6rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            opacity: 0.5;
        }

        /* Card overlay info */
        .talent-card-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 32px 18px 18px;
            background: linear-gradient(to top, rgba(10,8,4,0.9) 0%, rgba(10,8,4,0.4) 60%, transparent 100%);
            transform: translateY(4px);
            transition: transform 0.3s ease;
        }
        .talent-card:hover .talent-card-overlay { transform: translateY(0); }

        .talent-card-verified {
            position: absolute;
            top: 12px; left: 12px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(6px);
            padding: 3px 8px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.56rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #1a1714;
        }

        .talent-card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.15rem;
            font-weight: 400;
            color: #fff;
            letter-spacing: 0.02em;
            line-height: 1.2;
        }
        .talent-card-cat {
            font-size: 0.58rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(201,169,110,0.9);
            margin-top: 4px;
        }
        .talent-card-cta {
            margin-top: 10px;
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.7);
            display: flex;
            align-items: center;
            gap: 6px;
            opacity: 0;
            transform: translateY(4px);
            transition: opacity 0.3s, transform 0.3s;
        }
        .talent-card-cta svg { width: 10px; height: 10px; }
        .talent-card:hover .talent-card-cta { opacity: 1; transform: translateY(0); }

        /* Empty state */
        .talent-empty {
            grid-column: 1 / -1;
            padding: 80px 20px;
            text-align: center;
            color: var(--text-muted);
        }
        .talent-empty-icon { margin: 0 auto 20px; opacity: 0.25; }
        .talent-empty-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.6rem;
            font-weight: 300;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }
        .talent-empty-sub {
            font-size: 0.82rem;
            color: var(--text-muted);
            letter-spacing: 0.06em;
        }

        /* View all button */
        .view-all-wrap {
            margin-top: 48px;
            text-align: center;
        }

        /* ── Why Trust Section ── */
        .trust-section {
            padding: 100px 0;
            background: var(--bg-surface);
            border-top: 1px solid var(--border);
        }
        .trust-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            margin-top: 64px;
        }
        .trust-card {
            background: var(--bg-surface);
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
            transition: background 0.3s;
        }
        .trust-card:hover { background: var(--gold-bg); }
        .trust-card-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 300;
            color: var(--border-strong);
            line-height: 1;
            margin-bottom: 20px;
            transition: color 0.3s;
        }
        .trust-card:hover .trust-card-num { color: var(--gold); opacity: 0.4; }
        .trust-card-icon {
            color: var(--gold);
            margin-bottom: 20px;
        }
        .trust-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 12px;
        }
        .trust-card-desc {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.8;
        }

        /* ── CTA Banner ── */
        .cta-banner {
            position: relative;
            padding: 100px 40px;
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            overflow: hidden;
            text-align: center;
        }
        .cta-banner::before {
            content: '';
            position: absolute;
            top: -1px; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }
        .cta-banner-deco {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .cta-banner-deco-text {
            position: absolute;
            font-family: 'Cormorant Garamond', serif;
            font-size: 16rem;
            font-weight: 700;
            color: var(--border);
            opacity: 0.35;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            user-select: none;
            letter-spacing: -0.02em;
            transition: color 0.4s;
        }
        .cta-banner-inner {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin: 0 auto;
        }
        .cta-eyebrow {
            font-size: 0.6rem;
            font-weight: 600;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
        }
        .cta-eyebrow::before,
        .cta-eyebrow::after {
            content: '';
            width: 28px; height: 1px;
            background: var(--gold);
        }
        .cta-headline {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.2rem, 4vw, 3.6rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.15;
            margin-bottom: 16px;
        }
        .cta-headline strong { font-weight: 600; }
        .cta-sub {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 36px;
        }
        .cta-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .talent-grid { grid-template-columns: repeat(2, 1fr); }
            .trust-grid  { grid-template-columns: 1fr; }
            .hero-inner  { grid-template-columns: 1fr; gap: 48px; }
            .hero-gallery { display: none; }
            .hero-inner  { text-align: center; }
            .hero-sub, .hero-eyebrow { margin-left: auto; margin-right: auto; }
            .hero-cta-row { justify-content: center; }
            .hero-stats  { justify-content: center; }
            .categories-inner { overflow-x: auto; padding: 0 20px; }
            .category-item { padding: 18px 20px; }
        }
        @media (max-width: 640px) {
            .talent-grid { grid-template-columns: 1fr; }
            .hero-headline { font-size: 2.6rem; }
            .section-inner { padding: 0 20px; }
            .cta-banner { padding: 64px 20px; }
        }
    </style>

    {{-- ══════════════════════════════════════════
         HERO
    ══════════════════════════════════════════ --}}
    <section class="hero" aria-label="Hero">

        <div class="hero-deco" aria-hidden="true">
            <div class="hero-deco-ring hero-deco-ring-1"></div>
            <div class="hero-deco-ring hero-deco-ring-2"></div>
            <div class="hero-deco-ring hero-deco-ring-3"></div>
            <div class="hero-deco-line hero-deco-line-v"></div>
            <div class="hero-deco-dots"></div>
        </div>

        <div class="hero-inner">

            {{-- Left copy --}}
            <div class="anim-fade-up">
                <div class="hero-eyebrow">
                    <span class="hero-eyebrow-line"></span>
                    Bangladesh's Premier Talent Platform
                </div>

                <h1 class="hero-headline">
                    Discover &amp;<br>
                    <strong>Hire Verified</strong><br>
                    <em>Creative Talent.</em>
                </h1>

                <p class="hero-sub">
                    The most trusted directory for producers, directors, and brands to connect with verified models, actors, photographers, and content creators across Bangladesh.
                </p>

                <div class="hero-cta-row">
                    <a href="/artists" class="btn-fill">
                        Browse Talent
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true">
                            <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <a href="/register" class="btn-outline">Apply as Talent</a>
                </div>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <div class="hero-stat-num">500<span>+</span></div>
                        <div class="hero-stat-label">Verified Talents</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-num">120<span>+</span></div>
                        <div class="hero-stat-label">Active Brands</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-num">6</div>
                        <div class="hero-stat-label">Talent Categories</div>
                    </div>
                </div>
            </div>

            {{-- Right gallery collage --}}
            <div class="hero-gallery anim-fade-up anim-d2" aria-hidden="true">

                <div class="hero-card hero-card-1">
                    <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=600&q=80" alt="">
                    <div class="hero-card-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                        Verified
                    </div>
                    <div class="hero-card-label">
                        <div class="hero-card-cat">Model</div>
                        <div class="hero-card-name">Anahita R.</div>
                    </div>
                </div>

                <div class="hero-card hero-card-2">
                    <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?w=500&q=80" alt="">
                    <div class="hero-card-badge">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>
                        Verified
                    </div>
                    <div class="hero-card-label">
                        <div class="hero-card-cat">Actress</div>
                        <div class="hero-card-name">Nadia K.</div>
                    </div>
                </div>

                <div class="hero-card hero-card-3">
                    <img src="https://images.unsplash.com/photo-1488161628813-04466f872be2?w=400&q=80" alt="">
                    <div class="hero-card-label">
                        <div class="hero-card-cat">Photographer</div>
                        <div class="hero-card-name">Fiton K.</div>
                    </div>
                </div>

                <div class="hero-accent-box" aria-label="100% NID Verified">
                    <div class="hero-accent-box-num">100%</div>
                    <div class="hero-accent-box-label">NID Verified</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         CATEGORIES STRIP
    ══════════════════════════════════════════ --}}
    <nav class="categories-strip" aria-label="Browse by category">
        <div class="categories-inner">

            <a href="/models" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/></svg>
                <span class="cat-label">Models</span>
            </a>

            <a href="/actors" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 18l9-15 9 15H3z"/><path d="M12 8v6M9 14h6"/></svg>
                <span class="cat-label">Actors</span>
            </a>

            <a href="/photographers" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <span class="cat-label">Photographers</span>
            </a>

            <a href="/musicians" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                <span class="cat-label">Musicians</span>
            </a>

            <a href="/creators" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15 10l4.553-2.069A1 1 0 0121 8.845v6.31a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                <span class="cat-label">Creators</span>
            </a>

            <a href="/brand-promoters" class="category-item">
                <svg class="cat-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                <span class="cat-label">Brand Promoters</span>
            </a>

        </div>
    </nav>

    {{-- ══════════════════════════════════════════
         FEATURED TALENT
    ══════════════════════════════════════════ --}}
    <section class="talent-section" aria-labelledby="talent-heading">
        <div class="section-inner">
            <div class="section-header">
                <div class="section-header-left">
                    <div class="section-eyebrow">Exclusively Verified</div>
                    <h2 class="section-title" id="talent-heading">
                        Featured <strong>Talent</strong>
                    </h2>
                </div>
                <a href="/artists" class="btn-outline">View All Talent</a>
            </div>

            <div class="talent-grid">
                @forelse($featuredArtists as $artist)
                    <a href="/artist/{{ $artist->id }}" class="talent-card">

                        <div class="talent-card-verified">
                            <svg width="9" height="9" viewBox="0 0 24 24" fill="#2a7d4f" aria-hidden="true">
                                <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                            </svg>
                            Verified
                        </div>

                        <div class="talent-card-media">
                            @if($artist->hasMedia('portfolio'))
                                <img
                                    src="{{ $artist->getFirstMediaUrl('portfolio') }}"
                                    alt="{{ $artist->name }}"
                                    loading="lazy"
                                >
                            @else
                                <div class="talent-card-placeholder">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                    </svg>
                                    <span>No Photo Yet</span>
                                </div>
                            @endif
                        </div>

                        <div class="talent-card-overlay">
                            <div class="talent-card-cat">{{ ucfirst($artist->profile->category ?? 'Professional') }}</div>
                            <div class="talent-card-name">{{ $artist->name }}</div>
                            <div class="talent-card-cta">
                                View Profile
                                <svg viewBox="0 0 10 10" fill="none">
                                    <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="talent-empty">
                        <svg class="talent-empty-icon" width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                        </svg>
                        <div class="talent-empty-title">Talent Profiles Coming Soon</div>
                        <div class="talent-empty-sub">Our verified talent directory is growing. Check back shortly.</div>
                    </div>
                @endforelse
            </div>

            @if(isset($featuredArtists) && $featuredArtists->count() > 0)
                <div class="view-all-wrap">
                    <a href="/artists" class="btn-fill">
                        Explore Full Directory
                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true">
                            <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         WHY TRUST US
    ══════════════════════════════════════════ --}}
    <section class="trust-section" aria-labelledby="trust-heading">
        <div class="section-inner">
            <div style="text-align:center; max-width:560px; margin:0 auto;">
                <div class="section-eyebrow" style="justify-content:center;">Why AgencyMarket</div>
                <h2 class="section-title" id="trust-heading" style="text-align:center;">
                    Built on <strong>Trust,</strong><br>Powered by Talent.
                </h2>
            </div>

            <div class="trust-grid">
                <div class="trust-card">
                    <div class="trust-card-num">01</div>
                    <div class="trust-card-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2z"/>
                        </svg>
                    </div>
                    <div class="trust-card-title">100% NID Verified</div>
                    <p class="trust-card-desc">Every talent on AgencyMarket has passed strict national ID verification. You know exactly who you're hiring — no fakes, no risk.</p>
                </div>

                <div class="trust-card">
                    <div class="trust-card-num">02</div>
                    <div class="trust-card-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                    <div class="trust-card-title">Instant Connections</div>
                    <p class="trust-card-desc">Browse verified portfolios, filter by category, and connect directly with talent for your production, campaign, or brand project.</p>
                </div>

                <div class="trust-card">
                    <div class="trust-card-num">03</div>
                    <div class="trust-card-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                        </svg>
                    </div>
                    <div class="trust-card-title">Diverse Talent Pool</div>
                    <p class="trust-card-desc">From runway models and film actors to brand promoters and content creators — all in one curated, professional directory.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════
         CTA BANNER
    ══════════════════════════════════════════ --}}
    <section class="cta-banner" aria-labelledby="cta-heading">
        <div class="cta-banner-deco" aria-hidden="true">
            <div class="cta-banner-deco-text">TALENT</div>
        </div>
        <div class="cta-banner-inner">
            <div class="cta-eyebrow">Join the Platform</div>
            <h2 class="cta-headline" id="cta-heading">
                Ready to <strong>Get Discovered?</strong>
            </h2>
            <p class="cta-sub">
                Create your verified profile today and connect with leading brands, production houses, and casting directors across Bangladesh.
            </p>
            <div class="cta-row">
                <a href="/register" class="btn-fill">
                    Create Your Profile
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true">
                        <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="/artists" class="btn-outline">Browse Talent</a>
            </div>
        </div>
    </section>

</x-app-layout>