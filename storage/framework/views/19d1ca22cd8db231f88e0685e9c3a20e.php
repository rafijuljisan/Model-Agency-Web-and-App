<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Top Verified Talent']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>



<style>

/* ─────────────────────────────────────────────
   FONT FACE
───────────────────────────────────────────── */
@font-face {
    font-family: 'SolaimanLipi';
    src: local('SolaimanLipi'),
         url('/fonts/SolaimanLipi.woff2') format('woff2'),
         url('/fonts/SolaimanLipi.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

/* ─────────────────────────────────────────────
   SHARED LAYOUT UTILITIES
───────────────────────────────────────────── */
.pg-section {
    padding: 96px 0;
}
.pg-section--alt {
    background: var(--bg-secondary);
}
.pg-section--surface {
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
}
.pg-inner {
    max-width: 1380px;
    margin: 0 auto;
    padding: 0 48px;
}
.pg-section-head {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
    margin-bottom: 52px;
}
.pg-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: 'Jost', sans-serif;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 10px;
}
.pg-eyebrow::before {
    content: '';
    width: 24px; height: 1px;
    background: var(--gold);
    flex-shrink: 0;
}
.pg-title {
    font-family: 'Jost', sans-serif;
    font-size: clamp(1.9rem, 3vw, 2.8rem);
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.18;
    margin: 0;
}
.pg-title strong { font-weight: 700; }

/* Shared buttons */
.btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 28px;
    background: var(--gold);
    color: #fff;
    font-family: 'Jost', sans-serif;
    font-size: 0.66rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: filter 0.2s ease, transform 0.15s ease;
    white-space: nowrap;
}
.btn-primary:hover {
    filter: brightness(1.12);
    transform: translateY(-1px);
}
.btn-ghost {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 26px;
    border: 1.5px solid var(--border-strong);
    color: var(--text-primary);
    background: transparent;
    font-family: 'Jost', sans-serif;
    font-size: 0.66rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    text-decoration: none;
    border-radius: 8px;
    transition: border-color 0.2s, color 0.2s, background 0.2s;
    white-space: nowrap;
}
.btn-ghost:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}

/* Entrance animation */
@keyframes hp-fade-up {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim-fade-up { animation: hp-fade-up 0.65s cubic-bezier(.22,.68,0,1.1) both; }
.anim-d1 { animation-delay: 0.08s; }
.anim-d2 { animation-delay: 0.18s; }
.anim-d3 { animation-delay: 0.28s; }


/* ═══════════════════════════════════════════
   1. HERO
═══════════════════════════════════════════ */
.hero {
    position: relative;
    min-height: 70vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: var(--bg-primary);
}

/* Decorative rings + dots */
.hero__deco { position: absolute; inset: 0; pointer-events: none; overflow: hidden; }
.hero__ring {
    position: absolute;
    border-radius: 50%;
    border: 1px solid var(--border);
}
.hero__ring--a { width: 700px; height: 700px; top: -220px; right: -180px; }
.hero__ring--b { width: 440px; height: 440px; top: -80px;  right:  50px; }
.hero__ring--c { width: 920px; height: 920px; bottom: -420px; left: -320px; opacity: .4; }
.hero__vline {
    position: absolute; width: 1px; top: 0; bottom: 0; right: 38%;
    background: var(--border-strong); opacity: .22;
}
.hero__dots {
    position: absolute; top: 72px; right: 72px; width: 110px; height: 110px;
    background-image: radial-gradient(circle, var(--gold) 1px, transparent 1px);
    background-size: 15px 15px; opacity: .12;
}

.hero__inner {
    position: relative; z-index: 2;
    max-width: 1380px; margin: 0 auto;
    padding: 58px 48px 24px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 150px;
    align-items: center;
}

/* Left copy */
.hero__eyebrow {
    display: inline-flex; align-items: center; gap: 10px;
    font-family: 'Jost', sans-serif;
    font-size: 0.58rem; font-weight: 700; letter-spacing: .32em;
    text-transform: uppercase; color: var(--gold); margin-bottom: 20px;
}
.hero__eyebrow-line { width: 26px; height: 1px; background: var(--gold); flex-shrink: 0; }

.hero__headline {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.9rem, 5vw, 5rem);
    font-weight: 400; line-height: 1.05;
    letter-spacing: -0.01em;
    color: var(--text-primary); margin: 0 0 22px;
}
.hero__headline strong { font-weight: 700; display: block; }
.hero__headline em    { font-style: italic; color: var(--gold); display: block; font-weight: 300; }

.hero__sub {
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem; font-weight: 300;
    color: var(--text-secondary); line-height: 1.9;
    max-width: 420px; margin-bottom: 34px; opacity: .78;
}

.hero__cta {
    display: flex; align-items: center;
    gap: 13px; flex-wrap: wrap;
}

.hero__stats {
    display: flex; gap: 32px;
    margin-top: 46px; padding-top: 28px;
    border-top: 1px solid var(--border);
}
.hero__stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.7rem; font-weight: 600;
    color: var(--text-primary); line-height: 1;
}
.hero__stat-num sup { color: var(--gold); font-size: 1.4rem; font-weight: 400; }
.hero__stat-label {
    font-family: 'Jost', sans-serif;
    font-size: 0.6rem; font-weight: 600;
    letter-spacing: .18em; text-transform: uppercase;
    color: var(--text-muted); margin-top: 5px;
}

/* Right: floating card gallery */
.hero__gallery {
    position: relative; height: 560px;
}

.hero__card {
    position: absolute; overflow: hidden;
    border-radius: 16px;
    box-shadow: 0 16px 52px rgba(0,0,0,.13), 0 4px 14px rgba(0,0,0,.07);
    transition: transform .5s cubic-bezier(.22,.68,0,1.15), box-shadow .4s ease;
}
.hero__card:hover {
    transform: translateY(-5px) scale(1.015);
    box-shadow: 0 28px 72px rgba(0,0,0,.19), 0 8px 22px rgba(0,0,0,.10);
    z-index: 9;
}
.hero__card img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: top center; display: block;
    transition: transform .6s ease;
}
.hero__card:hover img { transform: scale(1.05); }

.hero__card--1 { width: 252px; height: 344px; top: 16px;  left: 18px;  z-index: 2; }
.hero__card--2 { width: 204px; height: 276px; top: 26px;  right: 36px; z-index: 2; }
.hero__card--3 { width: 215px; height: 260px; bottom: 8px; left: 106px; z-index: 3; }

.hero__card-label {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 44px 14px 14px;
    background: linear-gradient(to top, rgba(5,5,5,.84) 0%, transparent 100%);
    border-radius: 0 0 16px 16px;
}
.hero__card-cat {
    font-family: 'Jost', sans-serif;
    font-size: 0.53rem; font-weight: 700; letter-spacing: .2em;
    text-transform: uppercase; color: var(--gold-light); margin-bottom: 3px;
}
.hero__card-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.05rem; font-weight: 500; color: #fff; letter-spacing: .02em;
}

/* Verified pill badge */
.hero__badge {
    position: absolute; top: 11px; right: 11px;
    background: rgba(255,255,255,.96);
    backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
    padding: 5px 10px 5px 7px; border-radius: 20px;
    display: inline-flex; align-items: center; gap: 5px;
    font-family: 'Jost', sans-serif;
    font-size: 0.6rem; font-weight: 700; letter-spacing: .06em; color: #111;
    box-shadow: 0 2px 10px rgba(0,0,0,.09);
}
.hero__badge::before {
    content: ''; width: 8px; height: 8px;
    border-radius: 50%; background: #2a7d4f; flex-shrink: 0; display: block;
}

/* NID accent box */
.hero__nid {
    position: absolute; bottom: 18px; right: 18px; z-index: 4;
    background: var(--gold); color: #fff;
    padding: 15px 20px; border-radius: 12px;
    box-shadow: 0 8px 28px rgba(0,0,0,.2);
}
.hero__nid-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2rem; font-weight: 600; line-height: 1;
}
.hero__nid-num sup { font-size: .9rem; font-weight: 400; vertical-align: super; }
.hero__nid-label {
    font-family: 'Jost', sans-serif;
    font-size: 0.52rem; font-weight: 700; letter-spacing: .22em;
    text-transform: uppercase; opacity: .85; margin-top: 4px;
}


/* ═══════════════════════════════════════════
   2. CATEGORIES STRIP
═══════════════════════════════════════════ */
.cats-strip {
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
    border-bottom: 1px solid var(--border);
    overflow: hidden;
}
.cats-inner {
    max-width: 1380px; margin: 0 auto; padding: 0 48px;
    display: flex; align-items: stretch;
}
.cat-item {
    display: flex; align-items: center; gap: 9px;
    padding: 20px 28px;
    border-right: 1px solid var(--border);
    cursor: pointer; flex: 1; justify-content: center;
    text-decoration: none;
    transition: background .22s;
}
.cat-item:first-child { padding-left: 0; }
.cat-item:last-child  { border-right: none; }
.cat-item:hover { background: var(--gold-bg); }
.cat-item:hover .cat-item__icon { color: var(--gold); }
.cat-item:hover .cat-item__label { color: var(--text-primary); }
.cat-item__icon {
    color: var(--text-muted);
    transition: color .22s; flex-shrink: 0;
}
.cat-item__label {
    font-family: 'Jost', sans-serif;
    font-size: 0.72rem; font-weight: 600;
    letter-spacing: .12em; text-transform: uppercase;
    color: var(--text-secondary); transition: color .22s; white-space: nowrap;
}


/* ═══════════════════════════════════════════
   3. FEATURED TALENT GRID
═══════════════════════════════════════════ */
.talent-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.ac {
    position: relative; overflow: hidden;
    background: var(--bg-secondary);
    border-radius: 15px;
    display: block; text-decoration: none; cursor: pointer;
}
.ac__media {
    aspect-ratio: 3/4; overflow: hidden; position: relative;
    background: var(--bg-secondary);
}
.ac__media img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform .55s cubic-bezier(.25,.46,.45,.94);
}
.ac:hover .ac__media img { transform: scale(1.06); }
.ac__placeholder {
    width: 100%; height: 100%;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    gap: 10px; color: var(--text-muted);
}
.ac__placeholder svg { opacity: .25; }
.ac__placeholder span {
    font-size: .7rem; letter-spacing: .18em;
    text-transform: uppercase; opacity: .45;
}

/* Triangle verified corner */
.ac__verified {
    position: absolute; top: 0; left: 0; z-index: 3;
    width: 0; height: 0;
    border-style: solid; border-width: 68px 68px 0 0;
    border-color: #ffffff transparent transparent transparent;
}
.ac__verified-inner {
    position: absolute; top: -64px; left: 4px;
    display: flex; flex-direction: column; align-items: center; gap: 2px;
}
.ac__verified-inner svg { width: 13px; height: 13px; }
.ac__verified-inner span {
    font-size: .48rem; font-weight: 700; letter-spacing: .08em;
    text-transform: uppercase; color: #2a7d4f; line-height: 1;
}

/* Default bottom label */
.ac__info {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 48px 16px 16px;
    background: linear-gradient(to top, rgba(0,0,0,.94) 0%, rgba(0,0,0,.5) 45%, transparent 100%);
    transition: opacity .3s; z-index: 2;
}
.ac:hover .ac__info { opacity: 0; }
.ac__cat {
    font-family: 'Jost', sans-serif;
    font-size: .7rem; font-weight: 600; text-transform: uppercase;
    color: #fff; margin-bottom: 3px; opacity: .8;
}
.ac__name {
    font-family: 'Jost', sans-serif;
    font-size: 1.3rem; font-weight: 500; color: #fff;
    letter-spacing: .02em; line-height: 1.2;
}
.ac__loc {
    display: flex; align-items: center; gap: 4px;
    font-size: .8rem; color: rgba(255,255,255,.65); margin-top: 6px;
}

/* Hover overlay */
.ac__hover {
    position: absolute; inset: 0; z-index: 4;
    background: rgba(10,8,6,.91);
    backdrop-filter: blur(3px);
    display: flex; flex-direction: column; justify-content: center;
    padding: 24px 20px;
    opacity: 0; transform: translateY(8px);
    transition: opacity .35s ease, transform .35s ease;
}
.ac:hover .ac__hover { opacity: 1; transform: translateY(0); }
.ac__hover-name {
    font-family: 'Jost', sans-serif;
    font-size: 1.3rem; font-weight: 700; color: #fff;
    letter-spacing: .02em; margin-bottom: 8px; line-height: 1.2;
}
.ac__hover-tags {
    display: flex; flex-wrap: wrap; gap: 5px; margin-bottom: 14px;
}
.ac__hover-tag {
    padding: 3px 9px;
    border: 1px solid rgba(255,255,255,.22);
    font-family: 'Jost', sans-serif;
    font-size: .68rem; font-weight: 500;
    text-transform: uppercase; color: rgba(255,255,255,.8);
    background: rgba(255,255,255,.07);
}
.ac__hover-div { height: 1px; background: rgba(255,255,255,.12); margin-bottom: 12px; }
.ac__hover-row {
    display: flex; align-items: center; gap: 7px;
    font-size: .82rem; color: rgba(255,255,255,.75); margin-bottom: 7px;
}
.ac__hover-row svg { opacity: .55; flex-shrink: 0; }
.ac__hover-row strong { color: #fff; font-weight: 600; }
.ac__hover-cta {
    margin-top: 16px; padding: 11px 14px;
    background: #fff; color: #111;
    font-family: 'Jost', sans-serif;
    font-size: .78rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
    display: flex; align-items: center; justify-content: center; gap: 8px;
    transition: background .2s, color .2s;
}
.ac__hover-cta:hover { background: var(--gold); color: #fff; }

/* Empty state */
.talent-empty {
    grid-column: 1 / -1; padding: 80px 20px;
    text-align: center; color: var(--text-muted);
}
.talent-empty__icon { margin: 0 auto 18px; opacity: .22; }
.talent-empty__title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.5rem; font-weight: 300; color: var(--text-secondary); margin-bottom: 7px;
}
.talent-empty__sub { font-size: .8rem; letter-spacing: .06em; }

.view-all { margin-top: 44px; text-align: center; }


/* ═══════════════════════════════════════════
   4. GALLERY SLIDER
═══════════════════════════════════════════ */
.gallery-card {
    position: relative; aspect-ratio: 4/5;
    overflow: hidden; background: var(--bg-surface);
    border-radius: 6px; cursor: grab;
}
.gallery-card:active { cursor: grabbing; }
.gallery-card img {
    width: 100%; height: 100%; object-fit: cover;
    transition: transform .6s cubic-bezier(.25,.46,.45,.94);
}
.gallery-card:hover img { transform: scale(1.06); }
.gallery-card__caption {
    position: absolute; bottom: 0; left: 0; right: 0;
    padding: 40px 18px 18px;
    background: linear-gradient(to top, rgba(0,0,0,.82) 0%, transparent 100%);
    color: #fff;
    font-family: 'Jost', sans-serif; font-size: 1rem; font-weight: 500;
    transform: translateY(10px); opacity: 0;
    transition: transform .4s ease, opacity .4s ease;
}
.gallery-card:hover .gallery-card__caption { transform: translateY(0); opacity: 1; }

.gallerySwiper { padding-bottom: 48px !important; }
.swiper-pagination-bullet { background: var(--text-muted) !important; opacity: .4; }
.swiper-pagination-bullet-active { background: var(--gold) !important; opacity: 1; }


/* ═══════════════════════════════════════════
   5. CLIENTS MARQUEE
═══════════════════════════════════════════ */
.clients-section {
    padding: 72px 0;
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
    overflow: hidden;
}
.clients-head { text-align: center; margin-bottom: 44px; }
.marquee-wrap {
    width: 100vw; margin-left: calc(-50vw + 50%);
    display: flex; flex-direction: column; gap: 36px;
}
.marquee-row {
    display: flex; align-items: center;
    gap: 56px; width: max-content;
}
.marquee-row:hover { animation-play-state: paused; }
.marquee-row--ltr { animation: mar-ltr 40s linear infinite; }
.marquee-row--rtl { animation: mar-rtl 40s linear infinite; }

@keyframes mar-ltr { from { transform: translateX(0); } to { transform: translateX(-50%); } }
@keyframes mar-rtl { from { transform: translateX(-50%); } to { transform: translateX(0); } }

.client-logo {
    max-width: 130px; max-height: 64px; flex-shrink: 0;
    object-fit: contain;
    filter: grayscale(100%) opacity(.45);
    transition: filter .4s, transform .4s;
}
.client-logo:hover { filter: grayscale(0%) opacity(1); transform: scale(1.05); }


/* ═══════════════════════════════════════════
   WHY TRUST US — Editorial Row Layout
═══════════════════════════════════════════ */
.trust-section {
    padding: 0;
    background: var(--bg-primary);
    border-top: 1px solid var(--border);
}

/* Two-column layout: sticky intro left, items right */
.trust-layout {
    max-width: 1380px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 360px 1fr;
    min-height: 520px;
}

/* ── Left: sticky label column ── */
.trust-intro {
    padding: 80px 48px 80px 48px;
    border-right: 1px solid var(--border);
    position: sticky;
    top: var(--nav-h, 72px);
    align-self: start;
}
.trust-intro__label {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-family: 'Jost', sans-serif;
    font-size: 0.58rem;
    font-weight: 700;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
}
.trust-intro__label::before {
    content: '';
    width: 22px; height: 1px;
    background: var(--gold);
    flex-shrink: 0;
}
.trust-intro__title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(2.4rem, 3.2vw, 3.6rem);
    font-weight: 400;
    line-height: 1.1;
    color: var(--text-primary);
    margin-bottom: 20px;
}
.trust-intro__title strong {
    font-weight: 700;
    color: var(--gold);
}
.trust-intro__sub {
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem;
    font-weight: 300;
    line-height: 1.85;
    color: var(--text-secondary);
    opacity: 0.75;
    max-width: 260px;
    margin-bottom: 36px;
}
.trust-intro__stat {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 18px;
    border: 1px solid var(--border-strong);
    background: var(--gold-bg);
}
.trust-intro__stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem;
    font-weight: 600;
    color: var(--gold);
    line-height: 1;
}
.trust-intro__stat-label {
    font-family: 'Jost', sans-serif;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--text-muted);
}

/* ── Right: stacked feature rows ── */
.trust-rows {
    display: flex;
    flex-direction: column;
}

.trust-row {
    position: relative;
    display: grid;
    grid-template-columns: 96px 1fr;
    gap: 0;
    border-bottom: 1px solid var(--border);
    overflow: hidden;
    transition: background 0.3s ease;
    cursor: default;
}
.trust-row:last-child { border-bottom: none; }
.trust-row:hover { background: var(--gold-bg); }

/* Animated left accent line */
.trust-row::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    background: var(--gold);
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 0.4s cubic-bezier(.22,.68,0,1.1);
}
.trust-row:hover::before { transform: scaleY(1); }

/* Number column */
.trust-row__num-col {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding-top: 44px;
    border-right: 1px solid var(--border);
}
.trust-row__num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    opacity: 0.5;
    transition: color 0.3s, opacity 0.3s;
    writing-mode: vertical-rl;
    text-orientation: mixed;
    transform: rotate(180deg);
}
.trust-row:hover .trust-row__num {
    color: var(--gold);
    opacity: 1;
}

/* Content column */
.trust-row__content {
    padding: 44px 48px 44px 44px;
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Icon circle */
.trust-row__icon-wrap {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 18px;
}
.trust-row__icon {
    width: 44px; height: 44px;
    border-radius: 50%;
    border: 1.5px solid var(--border-strong);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold);
    background: var(--bg-primary);
    flex-shrink: 0;
    transition: background 0.3s, border-color 0.3s;
}
.trust-row:hover .trust-row__icon {
    background: var(--gold);
    border-color: var(--gold);
    color: #fff;
}
.trust-row__tag {
    font-family: 'Jost', sans-serif;
    font-size: 0.58rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--gold);
    padding: 3px 10px;
    border: 1px solid var(--gold);
    opacity: 0.7;
}

.trust-row__title {
    font-family: 'Jost', sans-serif;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 12px;
    line-height: 1.25;
}
.trust-row__desc {
    font-family: 'Jost', sans-serif;
    font-size: 0.95rem;
    font-weight: 300;
    color: var(--text-secondary);
    line-height: 1.85;
    max-width: 580px;
}
.trust-row__desc p { margin-bottom: 10px; }
.trust-row__desc p:last-child { margin-bottom: 0; }
.trust-row__desc ul { list-style: none; padding: 0; margin: 10px 0; }
.trust-row__desc li {
    display: flex; align-items: flex-start; gap: 8px;
    margin-bottom: 7px; font-size: 0.87rem;
}
.trust-row__desc li::before {
    content: '';
    width: 5px; height: 5px;
    border-radius: 50%;
    background: var(--gold);
    flex-shrink: 0;
    margin-top: 7px;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .trust-layout {
        grid-template-columns: 1fr;
    }
    .trust-intro {
        position: static;
        padding: 64px 28px 48px;
        border-right: none;
        border-bottom: 1px solid var(--border);
        text-align: center;
    }
    .trust-intro__label { justify-content: center; }
    .trust-intro__sub { margin-left: auto; margin-right: auto; }
    .trust-row {
        grid-template-columns: 64px 1fr;
    }
    .trust-row__content {
        padding: 36px 28px 36px 28px;
    }
}
@media (max-width: 640px) {
    .trust-intro { padding: 52px 18px 36px; }
    .trust-row { grid-template-columns: 1fr; }
    .trust-row__num-col {
        display: none;
    }
    .trust-row__content { padding: 32px 20px; }
}


/* ═══════════════════════════════════════════
   7. TESTIMONIALS — Redesigned
═══════════════════════════════════════════ */
.testi-section { padding: 96px 0; background: var(--bg-primary); border-top: 1px solid var(--border); }

.testi-intro { max-width: 540px; }

.testi-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px; margin-top: 52px;
}

.testi-card {
    position: relative;
    background: var(--bg-surface);
    border: 1px solid var(--border);
    border-radius: 2px;
    padding: 0;
    overflow: hidden;
    display: flex; flex-direction: column;
    transition: border-color .35s, transform .35s;
}
.testi-card:hover {
    border-color: var(--gold);
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,.07);
}

/* Accent bar on top */
.testi-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 3px;
    background: var(--gold); transform: scaleX(0);
    transform-origin: left; transition: transform .4s ease;
}
.testi-card:hover::before { transform: scaleX(1); }

.testi-card__body { padding: 36px 36px 28px; flex: 1; position: relative; }

/* Large decorative quotation mark */
.testi-card__q-mark {
    position: absolute; top: 24px; right: 28px;
    font-family: 'Cormorant Garamond', serif;
    font-size: 6rem; font-weight: 700; line-height: 1;
    color: var(--gold); opacity: .08; user-select: none;
    pointer-events: none;
}

.testi-card__stars {
    display: flex; gap: 3px; margin-bottom: 16px;
}
.testi-card__star {
    width: 12px; height: 12px;
    color: var(--gold); fill: var(--gold);
}

.testi-card__text {
    font-family: 'Jost', sans-serif;
    font-size: .95rem; font-weight: 300; font-style: italic;
    color: var(--text-primary); line-height: 1.85;
    position: relative; z-index: 1;
}

.testi-card__foot {
    display: flex; align-items: center; gap: 14px;
    padding: 20px 36px;
    background: var(--bg-secondary);
    border-top: 1px solid var(--border);
}
.testi-card__avatar {
    width: 46px; height: 46px;
    border-radius: 50%; object-fit: cover; flex-shrink: 0;
    border: 2px solid var(--border-strong);
}
.testi-card__avatar-ph {
    width: 46px; height: 46px; border-radius: 50%; flex-shrink: 0;
    background: var(--gold-bg);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); border: 2px solid var(--border-strong);
}
.testi-card__name {
    font-family: 'Jost', sans-serif;
    font-size: 1rem; font-weight: 700; color: var(--text-primary); line-height: 1.2;
}
.testi-card__role {
    font-size: .6rem; font-weight: 700;
    letter-spacing: .15em; text-transform: uppercase;
    color: var(--gold); margin-top: 3px;
}


/* ═══════════════════════════════════════════
   TEAM SECTION
═══════════════════════════════════════════ */
.team-section {
    padding: 96px 0;
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
}

/*
   --tcols is set per-render from PHP based on member count.
   Flexbox + justify-content:center handles orphan centering
   automatically regardless of remainder.
*/
.team-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 52px;
}

.team-card {
    /*
       Each card's width is calculated from the column count variable.
       - fill exactly N columns when a full row is present
       - orphan cards on the last row stay their natural width and
         are centered by justify-content: center on the parent
    */
    flex: 0 0 calc(
        (100% - (var(--tcols, 4) - 1) * 20px) / var(--tcols, 4)
    );
    max-width: 280px;
    min-width: 160px;

    background: var(--bg-primary);
    border: 1px solid var(--border);
    overflow: hidden;
    position: relative;
    transition: border-color .32s ease, transform .32s ease, box-shadow .32s ease;
}
.team-card:hover {
    border-color: var(--gold);
    transform: translateY(-5px);
    box-shadow: 0 16px 48px rgba(0,0,0,.09);
}

/* Red accent bar slides in from bottom on hover */
.team-card::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 3px;
    background: var(--gold);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform .38s cubic-bezier(.22,.68,0,1.1);
}
.team-card:hover::after { transform: scaleX(1); }

/* ── Photo block ── */
.team-card__photo {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 4.5;   /* portrait ratio */
    overflow: hidden;
    background: var(--bg-secondary);
}
.team-card__photo img {
    width: 100%; height: 100%;
    object-fit: cover; object-position: top center;
    transition: transform .5s ease;
    display: block;
}
.team-card:hover .team-card__photo img { transform: scale(1.05); }

/* Photo placeholder */
.team-card__photo-ph {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted);
}
.team-card__photo-ph svg { opacity: .22; }

/* Social icons overlay — appears on photo hover */
.team-card__socials {
    position: absolute;
    inset: 0;
    display: flex; align-items: center; justify-content: center;
    gap: 10px;
    background: rgba(10,8,6,.55);
    opacity: 0;
    transition: opacity .3s ease;
}
.team-card:hover .team-card__socials { opacity: 1; }

.team-card__soc {
    width: 36px; height: 36px;
    border-radius: 50%;
    border: 1.5px solid rgba(255,255,255,.6);
    color: #fff;
    background: transparent;
    display: flex; align-items: center; justify-content: center;
    text-decoration: none;
    transition: background .22s, border-color .22s;
}
.team-card__soc:hover {
    background: var(--gold);
    border-color: var(--gold);
}

/* ── Text block ── */
.team-card__body {
    padding: 18px 16px 20px;
    border-top: 1px solid var(--border);
}
.team-card__name {
    font-family: 'Jost', sans-serif;
    font-size: 1rem; font-weight: 700;
    color: var(--text-primary);
    line-height: 1.25;
    margin-bottom: 5px;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.team-card__role {
    font-family: 'Jost', sans-serif;
    font-size: 0.6rem; font-weight: 700;
    letter-spacing: .18em; text-transform: uppercase;
    color: var(--gold);
}

/* ── Responsive breakpoints ── */
@media (max-width: 1024px) {
    .team-card {
        flex: 0 0 calc(
            (100% - (min(var(--tcols, 4), 3) - 1) * 20px)
            / min(var(--tcols, 4), 3)
        );
    }
}
@media (max-width: 680px) {
    .team-card {
        flex: 0 0 calc((100% - 20px) / 2);
        max-width: none;
    }
}
@media (max-width: 400px) {
    .team-card { flex: 0 0 100%; max-width: none; }
    .team-grid { gap: 14px; }
}

/* ═══════════════════════════════════════════
   9. CTA BANNER
═══════════════════════════════════════════ */
.cta-banner {
    position: relative; padding: 100px 48px;
    background: var(--bg-surface);
    border-top: 1px solid var(--border); overflow: hidden; text-align: center;
}
.cta-banner::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0; height: 1px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
}
.cta-banner__bg-text {
    position: absolute; font-family: 'Jost', sans-serif;
    font-size: 14rem; font-weight: 800; color: var(--border); opacity: .2;
    top: 50%; left: 50%; transform: translate(-50%, -50%);
    white-space: nowrap; user-select: none; letter-spacing: -.02em; pointer-events: none;
}
.cta-banner__inner { position: relative; z-index: 2; max-width: 640px; margin: 0 auto; }
.cta-banner__eyebrow {
    font-family: 'Jost', sans-serif;
    font-size: .62rem; font-weight: 700; letter-spacing: .32em;
    text-transform: uppercase; color: var(--gold); margin-bottom: 18px;
    display: flex; align-items: center; justify-content: center; gap: 14px;
}
.cta-banner__eyebrow::before,
.cta-banner__eyebrow::after { content: ''; width: 24px; height: 1px; background: var(--gold); }
.cta-banner__title {
    font-family: 'Jost', sans-serif;
    font-size: clamp(2rem, 4vw, 3.4rem); font-weight: 300;
    color: var(--text-primary); line-height: 1.15; margin-bottom: 14px;
}
.cta-banner__title strong { font-weight: 700; }
.cta-banner__sub {
    font-family: 'Jost', sans-serif;
    font-size: .95rem; color: var(--text-secondary); line-height: 1.85; margin-bottom: 32px; opacity: .78;
}
.cta-banner__btns { display: flex; align-items: center; justify-content: center; gap: 13px; flex-wrap: wrap; }


/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media (max-width: 1200px) {
    .team-card { flex: 0 0 calc(33.33% - 13px); max-width: calc(33.33% - 13px); }
}

@media (max-width: 1024px) {
    .pg-inner  { padding: 0 28px; }
    .hero__inner  { grid-template-columns: 1fr; gap: 0; padding: 64px 28px 52px; text-align: center; }
    .hero__gallery { display: none; }
    .hero__sub { margin-left: auto; margin-right: auto; }
    .hero__eyebrow { justify-content: center; }
    .hero__cta { justify-content: center; }
    .hero__stats { justify-content: center; }
    .talent-grid { grid-template-columns: repeat(2, 1fr); }
    .trust-grid  { grid-template-columns: 1fr; }
    .testi-grid  { grid-template-columns: 1fr; }
    .cats-inner  { overflow-x: auto; padding: 0 20px; }
    .cat-item    { padding: 16px 18px; }
    .team-card   { flex: 0 0 calc(50% - 10px); max-width: calc(50% - 10px); }
}

@media (max-width: 640px) {
    .pg-section  { padding: 64px 0; }
    .pg-inner    { padding: 0 18px; }
    .talent-grid { grid-template-columns: 1fr; }
    .hero__headline { font-size: 2.7rem; }
    .pg-section-head { flex-direction: column; align-items: flex-start; gap: 16px; }
    .cta-banner  { padding: 64px 20px; }
    .cta-banner__bg-text { font-size: 6rem; }
    .trust-card  { padding: 36px 24px; }
    .team-card   { flex: 0 0 100%; max-width: 100%; }
    .testi-card__body { padding: 28px 22px 22px; }
    .testi-card__foot { padding: 16px 22px; }
    .hero__stats { flex-wrap: wrap; gap: 24px; }
}

</style>



<section class="hero" aria-label="Hero">

    <div class="hero__deco" aria-hidden="true">
        <div class="hero__ring hero__ring--a"></div>
        <div class="hero__ring hero__ring--b"></div>
        <div class="hero__ring hero__ring--c"></div>
        <div class="hero__vline"></div>
        <div class="hero__dots"></div>
    </div>

    <div class="hero__inner">

        
        <div class="anim-fade-up">

            <div class="hero__eyebrow">
                <span class="hero__eyebrow-line"></span>
                Bangladesh's Premier Talent Platform
            </div>

            <h1 class="hero__headline">
                Discover &amp;<br>
                <strong>Hire Verified</strong>
                <em>Creative Talent.</em>
            </h1>

            <p class="hero__sub">
                The most trusted directory for producers, directors, and brands to connect
                with verified models, actors, photographers, and content creators across Bangladesh.
            </p>

            <div class="hero__cta">
                <a href="/artists" class="btn-primary">
                    Browse Talent
                    <svg width="12" height="12" viewBox="0 0 10 10" fill="none" aria-hidden="true">
                        <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="/register" class="btn-ghost">Apply as Talent</a>
            </div>

            <div class="hero__stats">
                <div class="hero__stat">
                    <div class="hero__stat-num">500<sup>+</sup></div>
                    <div class="hero__stat-label">Verified Talents</div>
                </div>
                <div class="hero__stat">
                    <div class="hero__stat-num">120<sup>+</sup></div>
                    <div class="hero__stat-label">Active Brands</div>
                </div>
                <div class="hero__stat">
                    <div class="hero__stat-num">6</div>
                    <div class="hero__stat-label">Talent Categories</div>
                </div>
            </div>

        </div>

        
        <div class="hero__gallery anim-fade-up anim-d2" aria-hidden="true">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredArtists->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="hero__card hero__card--<?php echo e($loop->iteration); ?>">

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->hasMedia('avatar')): ?>
                        <img src="<?php echo e($artist->getFirstMediaUrl('avatar')); ?>" alt="<?php echo e($artist->name); ?>" loading="eager">
                    <?php elseif($artist->hasMedia('portfolio')): ?>
                        <img src="<?php echo e($artist->getFirstMediaUrl('portfolio')); ?>" alt="<?php echo e($artist->name); ?>" loading="eager">
                    <?php else: ?>
                        <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($artist->name)); ?>&background=1a1714&color=fff&size=600" alt="<?php echo e($artist->name); ?>">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->iteration <= 2): ?>
                        <div class="hero__badge">Verified</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="hero__card-label">
                        <div class="hero__card-cat">
                            <?php echo e(!empty($artist->profile?->categories) ? collect($artist->profile->categories)->first() : 'Professional'); ?>

                        </div>
                        <div class="hero__card-name"><?php echo e($artist->name); ?></div>
                    </div>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            <div class="hero__nid" aria-label="100% NID Verified">
                <div class="hero__nid-num">100<sup>%</sup></div>
                <div class="hero__nid-label">Verified</div>
            </div>

        </div>
    </div>
</section>



<?php
    $categoryGroups = \Illuminate\Support\Facades\Cache::rememberForever('nav_category_groups', function () {
        return \App\Models\Category::where('is_active', true)
            ->customOrdered()->get()->unique('group')->pluck('group');
    });
?>

<nav class="cats-strip" aria-label="Browse by category">
    <div class="cats-inner">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categoryGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $icon = match($group) {
                    'Artist'          => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>',
                    'Model'           => '<path d="M12 3l1.9 5.8a2 2 0 001.3 1.3L21 12l-5.8 1.9a2 2 0 00-1.3 1.3L12 21l-1.9-5.8a2 2 0 00-1.3-1.3L3 12l5.8-1.9a2 2 0 001.3-1.3L12 3z"/>',
                    'Brand Promoter'  => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
                    'Content Creator' => '<rect x="2" y="2" width="20" height="20" rx="2"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/>',
                    'Director'        => '<rect x="2" y="6" width="20" height="12" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/><line x1="7" y1="6" x2="7" y2="10"/><line x1="12" y1="6" x2="12" y2="10"/>',
                    'Creative Crew'   => '<path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z"/><circle cx="12" cy="13" r="4"/>',
                    default           => '<circle cx="12" cy="12" r="10"/>',
                };
                $label = $group === 'Creative Crew' ? $group : \Illuminate\Support\Str::plural($group);
            ?>
            <a href="/artists?group=<?php echo e(urlencode($group)); ?>" class="cat-item">
                <svg class="cat-item__icon" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><?php echo $icon; ?></svg>
                <span class="cat-item__label"><?php echo e($label); ?></span>
            </a>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
</nav>



<section class="pg-section" aria-labelledby="talent-heading">
    <div class="pg-inner">
        <div class="pg-section-head">
            <div>
                <div class="pg-eyebrow">Exclusively Verified</div>
                <h2 class="pg-title" id="talent-heading">Featured <strong>Talent</strong></h2>
            </div>
            <a href="/artists" class="btn-ghost">View All Talent</a>
        </div>

        <div class="talent-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $featuredArtists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('artist.show', ['slug' => \Illuminate\Support\Str::slug($artist->name).'-'.$artist->id])); ?>"
                   class="ac" aria-label="View <?php echo e($artist->name); ?>">

                    <div class="ac__verified">
                        <div class="ac__verified-inner">
                            <svg viewBox="0 0 24 24" fill="#2a7d4f">
                                <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                            </svg>
                            <span>Verified</span>
                        </div>
                    </div>

                    <div class="ac__media">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->hasMedia('avatar')): ?>
                            <img src="<?php echo e($artist->getFirstMediaUrl('avatar')); ?>" alt="<?php echo e($artist->name); ?>" loading="lazy">
                        <?php elseif($artist->hasMedia('portfolio')): ?>
                            <img src="<?php echo e($artist->getFirstMediaUrl('portfolio')); ?>" alt="<?php echo e($artist->name); ?>" loading="lazy">
                        <?php else: ?>
                            <div class="ac__placeholder">
                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                </svg>
                                <span>No Photo</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="ac__info">
                        <?php
                            $artistCats = (array) ($artist->profile?->categories ?? []);
                            $dg = [];
                            if (!empty($artistCats)) {
                                $dg = \App\Models\Category::whereIn('name', $artistCats)
                                    ->customOrdered()->pluck('group')->unique()->toArray();
                            }
                        ?>
                        <div class="ac__cat"><?php echo e(!empty($dg) ? implode(' · ', $dg) : 'Professional'); ?></div>
                        <div class="ac__name"><?php echo e($artist->name); ?></div>
                        <div class="ac__loc">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                <circle cx="12" cy="9" r="2.5"/>
                            </svg>
                            <?php echo e(implode(', ', array_filter([$artist->profile?->upazila, $artist->profile?->district])) ?: 'Bangladesh'); ?>

                        </div>
                    </div>

                    <div class="ac__hover">
                        <div class="ac__hover-name"><?php echo e($artist->name); ?></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->categories)): ?>
                            <div class="ac__hover-tags">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $artist->profile->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <span class="ac__hover-tag"><?php echo e($cat); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="ac__hover-div"></div>
                        <div class="ac__hover-meta">
                            <div class="ac__hover-row">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                    <circle cx="12" cy="9" r="2.5"/>
                                </svg>
                                <?php echo e(implode(', ', array_filter([$artist->profile?->upazila, $artist->profile?->district, $artist->profile?->country])) ?: 'Location not specified'); ?>

                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->gender || $artist->profile?->date_of_birth): ?>
                                <div class="ac__hover-row">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                    </svg>
                                    <?php echo e($artist->profile?->gender ?? ''); ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->date_of_birth): ?>
                                        · <strong><?php echo e(\Carbon\Carbon::parse($artist->profile->date_of_birth)->age); ?> yrs</strong>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->height_cm): ?>
                                <div class="ac__hover-row">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M8 3v18M5 6h3M5 10h3M5 14h3M5 18h3M16 3l4 4-4 4M20 7H8"/>
                                    </svg>
                                    <strong><?php echo e($artist->profile->height_cm); ?> ft</strong>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                                <div class="ac__hover-row">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <circle cx="12" cy="12" r="10"/><path d="M9 8h6M9 12h6M9 16h4"/>
                                    </svg>
                                    From <strong><?php echo e(number_format($artist->profile->hourly_rate)); ?> BDT/hr</strong>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="ac__hover-cta">
                            View Full Profile
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="talent-empty">
                    <div class="talent-empty__icon">
                        <svg width="52" height="52" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                        </svg>
                    </div>
                    <div class="talent-empty__title">Talent Profiles Coming Soon</div>
                    <div class="talent-empty__sub">Our verified talent directory is growing.</div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($featuredArtists) && $featuredArtists->count() > 0): ?>
            <div class="view-all">
                <a href="/artists" class="btn-primary">
                    Explore Full Directory
                    <svg width="11" height="11" viewBox="0 0 10 10" fill="none">
                        <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </div>
</section>



<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($galleryPhotos) && $galleryPhotos->count() > 0): ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<section class="pg-section pg-section--alt anim-fade-up" aria-labelledby="gallery-heading">
    <div class="pg-inner">
        <div class="pg-section-head">
            <div>
                <div class="pg-eyebrow">Our Portfolio</div>
                <h2 class="pg-title" id="gallery-heading">Recent <strong>Shoots</strong></h2>
            </div>
            <a href="/gallery" class="btn-ghost">View Full Gallery</a>
        </div>

        <div class="swiper gallerySwiper">
            <div class="swiper-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $galleryPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="swiper-slide">
                        <div class="gallery-card">
                            <img src="<?php echo e(Storage::url($photo->image)); ?>" alt="<?php echo e($photo->caption ?? 'Gallery'); ?>" loading="lazy">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($photo->caption): ?>
                                <div class="gallery-card__caption"><?php echo e($photo->caption); ?></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.gallerySwiper', {
        slidesPerView: 2, spaceBetween: 10, grabCursor: true,
        pagination: { el: '.swiper-pagination', clickable: true },
        breakpoints: { 768: { slidesPerView: 3, spaceBetween: 18 }, 1024: { slidesPerView: 4, spaceBetween: 22 } }
    });
});
</script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($clients->count() > 0): ?>
<section class="clients-section anim-fade-up" aria-label="Our Clients">
    <div class="pg-inner clients-head">
        <div class="pg-eyebrow" style="justify-content:center;">Trusted By</div>
        <h2 class="pg-title" style="text-align:center;">Our <strong>Partners &amp; Clients</strong></h2>
    </div>

    <?php
        $sc = $clients->shuffle();
        $half = ceil($sc->count() / 2);
        $row1 = $sc->take($half);
        $row2 = $sc->slice($half);
    ?>

    <div class="marquee-wrap">
        <div class="marquee-row marquee-row--ltr">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1,2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $row1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cl->website_url): ?>
                        <a href="<?php echo e($cl->website_url); ?>" target="_blank" rel="noopener">
                            <img src="<?php echo e(Storage::url($cl->logo)); ?>" alt="<?php echo e($cl->name); ?>" class="client-logo">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo e(Storage::url($cl->logo)); ?>" alt="<?php echo e($cl->name); ?>" class="client-logo">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <div class="marquee-row marquee-row--rtl">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [1,2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $row2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cl->website_url): ?>
                        <a href="<?php echo e($cl->website_url); ?>" target="_blank" rel="noopener">
                            <img src="<?php echo e(Storage::url($cl->logo)); ?>" alt="<?php echo e($cl->name); ?>" class="client-logo">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo e(Storage::url($cl->logo)); ?>" alt="<?php echo e($cl->name); ?>" class="client-logo">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



<?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'homepage_middle'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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



<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($teamMembers->count() > 0): ?>

<?php
    $count   = $teamMembers->count();
    /*
     * Column logic:
     *  1–5 members  → exactly $count columns (all fit on one row)
     *  6+ members   → 5 columns (overflow wraps; orphans centered by flexbox)
     *  Cap at 5 so cards never become too narrow on desktop.
     */
    $tcols = min($count, 5);
?>

<section class="team-section pg-section--surface anim-fade-up"
         aria-labelledby="team-heading">
    <div class="pg-inner">

        <div class="pg-section-head">
            <div>
                <div class="pg-eyebrow">Agency Directory</div>
                <h2 class="pg-title" id="team-heading">Leadership <strong>Team</strong></h2>
            </div>
        </div>

        
        <div class="team-grid" style="--tcols: <?php echo e($tcols); ?>">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="team-card">

                    
                    <div class="team-card__photo">

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->image): ?>
                            <img src="<?php echo e(Storage::url($member->image)); ?>"
                                 alt="<?php echo e($member->name); ?>"
                                 loading="lazy">
                        <?php else: ?>
                            <div class="team-card__photo-ph" aria-hidden="true">
                                <svg width="52" height="52" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="0.8">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        
                        <div class="team-card__socials">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->facebook_url): ?>
                                <a href="<?php echo e($member->facebook_url); ?>"
                                   target="_blank" rel="noopener"
                                   class="team-card__soc" aria-label="<?php echo e($member->name); ?> on Facebook">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->instagram_url): ?>
                                <a href="<?php echo e($member->instagram_url); ?>"
                                   target="_blank" rel="noopener"
                                   class="team-card__soc" aria-label="<?php echo e($member->name); ?> on Instagram">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="2" y="2" width="20" height="20" rx="5"/>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->linkedin_url): ?>
                                <a href="<?php echo e($member->linkedin_url); ?>"
                                   target="_blank" rel="noopener"
                                   class="team-card__soc" aria-label="<?php echo e($member->name); ?> on LinkedIn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/>
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($member->twitter_url): ?>
                                <a href="<?php echo e($member->twitter_url); ?>"
                                   target="_blank" rel="noopener"
                                   class="team-card__soc" aria-label="<?php echo e($member->name); ?> on Twitter">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                                    </svg>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                    </div>

                    
                    <div class="team-card__body">
                        <h3 class="team-card__name"><?php echo e($member->name); ?></h3>
                        <div class="team-card__role"><?php echo e($member->designation); ?></div>
                    </div>

                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        </div>

    </div>
</section>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



<section class="trust-section" aria-labelledby="trust-heading">

    <div class="trust-layout">

        
        <div class="trust-intro">
            <div class="trust-intro__label">
                Why <?php echo e($settings?->site_name ?? 'Our Agency'); ?>

            </div>
            <h2 class="trust-intro__title" id="trust-heading">
                Built on<br>
                <strong>Trust.</strong><br>
                Powered by<br>
                Talent.
            </h2>
            <p class="trust-intro__sub">
                Every model, actor, and creator on our platform is manually reviewed and NID verified by our team.
            </p>
            <div class="trust-intro__stat">
                <div class="trust-intro__stat-num">100%</div>
                <div class="trust-intro__stat-label">Verified<br>Talent</div>
            </div>
        </div>

        
        <div class="trust-rows">

            
            <div class="trust-row">
                <div class="trust-row__num-col">
                    <span class="trust-row__num">01</span>
                </div>
                <div class="trust-row__content">
                    <div class="trust-row__icon-wrap">
                        <div class="trust-row__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2z"/>
                            </svg>
                        </div>
                        <span class="trust-row__tag">What We Offer</span>
                    </div>
                    <h3 class="trust-row__title">Professional Services,<br>End to End</h3>
                    <div class="trust-row__desc">
                        <?php echo $settings?->what_we_offer ?? '<p>We connect Bangladesh\'s finest verified talent with brands, production houses, and casting directors through a curated, professional platform built for the creative industry.</p>'; ?>

                    </div>
                </div>
            </div>

            
            <div class="trust-row">
                <div class="trust-row__num-col">
                    <span class="trust-row__num">02</span>
                </div>
                <div class="trust-row__content">
                    <div class="trust-row__icon-wrap">
                        <div class="trust-row__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <span class="trust-row__tag">Our Experience</span>
                    </div>
                    <h3 class="trust-row__title">Years of Industry<br>Expertise</h3>
                    <div class="trust-row__desc">
                        <?php echo $settings?->our_experience ?? '<p>With deep roots in the Bangladesh creative scene, our team brings hands-on expertise in model management, casting, and brand partnerships to every collaboration.</p>'; ?>

                    </div>
                </div>
            </div>

            
            <div class="trust-row">
                <div class="trust-row__num-col">
                    <span class="trust-row__num">03</span>
                </div>
                <div class="trust-row__content">
                    <div class="trust-row__icon-wrap">
                        <div class="trust-row__icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                            </svg>
                        </div>
                        <span class="trust-row__tag">Advice For Models</span>
                    </div>
                    <h3 class="trust-row__title">Guidance for Every<br>Step of Your Career</h3>
                    <div class="trust-row__desc">
                        <?php echo $settings?->models_advice ?? '<p>From your first photoshoot to landing major campaigns, our platform provides the mentorship, visibility, and connections that turn aspiring talent into working professionals.</p>'; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testimonials->count() > 0): ?>
<section class="testi-section anim-fade-up" aria-labelledby="testi-heading">
    <div class="pg-inner">
        <div class="pg-section-head">
            <div class="testi-intro">
                <div class="pg-eyebrow">Success Stories</div>
                <h2 class="pg-title" id="testi-heading">What Our <strong>Models Say</strong></h2>
            </div>
        </div>

        <div class="testi-grid">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="testi-card">
                    <div class="testi-card__body">
                        <div class="testi-card__q-mark">"</div>

                        
                        <div class="testi-card__stars" aria-label="5 out of 5 stars">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php for($s = 0; $s < 5; $s++): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <svg class="testi-card__star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endfor; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>

                        <p class="testi-card__text">"<?php echo e($testi->quote); ?>"</p>
                    </div>

                    <div class="testi-card__foot">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($testi->image): ?>
                            <img src="<?php echo e(Storage::url($testi->image)); ?>" alt="<?php echo e($testi->name); ?>" class="testi-card__avatar">
                        <?php else: ?>
                            <div class="testi-card__avatar-ph" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div>
                            <div class="testi-card__name"><?php echo e($testi->name); ?></div>
                            <div class="testi-card__role"><?php echo e($testi->designation); ?></div>
                        </div>
                    </div>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>



<?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'homepage_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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



<section class="cta-banner" aria-labelledby="cta-heading">
    <div class="cta-banner__bg-text" aria-hidden="true">TALENT</div>
    <div class="cta-banner__inner">
        <div class="cta-banner__eyebrow">Join the Platform</div>
        <h2 class="cta-banner__title" id="cta-heading">
            Ready to <strong>Get Discovered?</strong>
        </h2>
        <p class="cta-banner__sub">
            Create your verified profile today and connect with leading brands,
            production houses, and casting directors across Bangladesh.
        </p>
        <div class="cta-banner__btns">
            <a href="/register" class="btn-primary">
                Create Your Profile
                <svg width="11" height="11" viewBox="0 0 10 10" fill="none">
                    <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="/artists" class="btn-ghost">Browse Talent</a>
        </div>
    </div>
</section>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/welcome.blade.php ENDPATH**/ ?>