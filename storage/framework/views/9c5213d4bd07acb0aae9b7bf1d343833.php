<div>
    <style>
        /* ═══════════════════════════════════════════
   ARTIST DIRECTORY PAGE
═══════════════════════════════════════════ */
@font-face {
        font-family: 'SolaimanLipi';
        src: local('SolaimanLipi'),
             url('/fonts/SolaimanLipi.woff2') format('woff2'),
             url('/fonts/SolaimanLipi.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }
        /* Page hero banner */
        .directory-hero {
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            padding: 56px 0 48px;
            position: relative;
            overflow: hidden;
            transition: background 0.4s;
        }

        .directory-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(90deg,
                    transparent,
                    transparent 60px,
                    var(--border) 60px,
                    var(--border) 61px),
                repeating-linear-gradient(0deg,
                    transparent,
                    transparent 60px,
                    var(--border) 60px,
                    var(--border) 61px);
            opacity: 0.35;
        }

        .directory-hero::after {
            content: '';
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            width: 40%;
            background: linear-gradient(to left, var(--gold-bg), transparent);
        }

        .directory-hero-inner {
            position: relative;
            z-index: 2;
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 40px;
        }

        .directory-hero-eyebrow {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.32em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .directory-hero-eyebrow::before {
            content: '';
            width: 24px;
            height: 1px;
            background: var(--gold);
        }

        .directory-hero-title {
            font-family: 'Jost', sans-serif;
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.15;
            margin-bottom: 10px;
        }

        .directory-hero-title strong {
            font-weight: 600;
        }

        .directory-hero-sub {
            font-size: 0.88rem;
            color: var(--text-muted);
            letter-spacing: 0.06em;
        }

        /* Page body */
        .directory-page {
            max-width: 1440px;
            margin: 0 auto;
            padding: 40px 40px 80px;
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
            align-items: start;
        }

        /* ── Filter sidebar ── */
        .filter-sidebar {
            position: sticky;
            top: calc(var(--nav-h) + 30px + 16px);
        }

        .filter-panel {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 20px;
            transition: background 0.4s, border-color 0.4s;
        }

        .filter-panel-title {
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .filter-clear-btn {
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-muted);
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Jost', sans-serif;
            transition: color 0.22s;
            padding: 0;
        }

        .filter-clear-btn:hover {
            color: var(--gold);
        }

        .filter-group {
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .filter-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .filter-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 10px;
            display: block;
        }

        /* Input/select styles */
        .filter-input,
        .filter-select {
            width: 100%;
            padding: 8px 12px;
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            font-weight: 300;
            outline: none;
            transition: border-color 0.22s, background 0.4s, color 0.4s;
            appearance: none;
            -webkit-appearance: none;
        }

        .filter-input::placeholder {
            color: var(--text-muted);
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color: var(--gold);
        }

        /* Custom select arrow */
        .filter-select-wrap {
            position: relative;
        }

        .filter-select-wrap::after {
            content: '';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--text-muted);
            pointer-events: none;
        }

        .filter-select {
            cursor: pointer;
            padding-right: 36px;
        }

        /* Category pills filter */
        .filter-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .filter-pill {
            padding: 4px 10px;
            border: 1px solid var(--border-strong);
            background: transparent;
            color: var(--text-secondary);
            font-family: 'Jost', sans-serif;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            transition: border-color 0.22s, color 0.22s, background 0.22s;
        }

        .filter-pill:hover,
        .filter-pill.is-active {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
        }

        /* ── Directory main area ── */
        .directory-main {}

        /* Toolbar */
        .directory-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .directory-count {
            font-size: 0.82rem;
            color: var(--text-muted);
            letter-spacing: 0.1em;
        }

        .directory-count strong {
            color: var(--text-primary);
            font-weight: 600;
        }

        /* Loading indicator */
        .loading-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--gold);
            padding: 12px 0;
        }

        .loading-bar svg {
            animation: spin 0.8s linear infinite;
            flex-shrink: 0;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Artist grid */
        .artist-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            transition: opacity 0.25s;
        }

        .artist-grid.is-loading {
            opacity: 0.45;
            pointer-events: none;
        }

        /* Artist card */
        .artist-card {
            position: relative;
            overflow: hidden;
            background: var(--bg-secondary);
            display: block;
            text-decoration: none;
            cursor: pointer;
            border-radius: 15px;
        }

        .artist-card-media {
            aspect-ratio: 3/4;
            overflow: hidden;
            position: relative;
            background: var(--bg-secondary);
        }

        .artist-card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.4s ease, transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .artist-card-media img.is-loaded {
            opacity: 1;
        }

        .artist-card:hover .artist-card-media img {
            transform: scale(1.06);
        }

        .artist-card-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: var(--text-muted);
        }

        .artist-card-placeholder svg {
            opacity: 0.28;
        }

        .artist-card-placeholder span {
            font-size: 0.72rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            opacity: 0.5;
        }

        /* Verified badge */
        /* Remove old verified badge styles and replace with: */
.artist-card-verified {
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 72px 72px 0 0;
    border-color: #ffffff transparent transparent transparent;
    z-index: 3;
}

.artist-card-verified-inner {
    position: absolute;
    top: -68px;
    left: 4px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.artist-card-verified-inner svg {
    width: 14px;
    height: 14px;
}

.artist-card-verified-inner span {
    font-size: 0.5rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #2a7d4f;
    line-height: 1;
}

        /* Info bottom overlay */
        /* Base info — always visible at bottom */
.artist-card-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 48px 16px 16px;
    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.95) 0%,
        rgba(0, 0, 0, 0.75) 40%,
        rgba(0, 0, 0, 0.2) 70%,
        transparent 100%
    );
    transition: opacity 0.3s;
    z-index: 2;
}

/* Hover overlay — full card cover with all details */
.artist-card-hover {
    position: absolute;
    inset: 0;
    background: rgba(10, 8, 6, 0.92);
    backdrop-filter: blur(2px);
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 24px 20px;
    opacity: 0;
    transform: translateY(8px);
    transition: opacity 0.35s ease, transform 0.35s ease;
    z-index: 4;
}

.artist-card:hover .artist-card-hover {
    opacity: 1;
    transform: translateY(0);
}

.artist-card:hover .artist-card-info {
    opacity: 0;
}

/* Hover panel — name */
.artist-hover-name {
    font-family: 'Jost', sans-serif;
    font-size: 1.65rem; /* Increased from 1.5rem */
    font-weight: 600;
    color: #ffffff;
    letter-spacing: 0.02em;
    margin-bottom: 6px;
    line-height: 1.2;
}

/* Hover panel — categories list */
.artist-hover-cats {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 16px;
    margin-top: 8px;
}

.artist-hover-cat-tag {
    padding: 4px 10px;
    border: 1px solid rgba(255, 255, 255, 0.25);
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: normal; /* ← Changed this here as well */
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.85);
    background: rgba(255, 255, 255, 0.08);
}

/* Hover panel — divider */
.artist-hover-divider {
    height: 1px;
    background: rgba(255, 255, 255, 0.12);
    margin-bottom: 14px;
}

/* Hover panel — info rows */
.artist-hover-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.artist-hover-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem; /* Increased from 0.75rem */
    color: rgba(255, 255, 255, 0.8); /* Slightly brighter for better contrast */
}

.artist-hover-row svg {
    flex-shrink: 0;
    opacity: 0.6;
}

.artist-hover-row strong {
    color: #ffffff;
    font-weight: 600;
}

/* Hover panel — CTA button */
.artist-hover-cta {
    margin-top: 18px;
    padding: 12px 16px;
    background: #ffffff;
    color: #111111;
    font-family: 'Poppins', sans-serif;
    font-size: 0.85rem; /* Increased from 0.72rem */
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.2s;
}

.artist-hover-cta:hover {
    background: var(--gold);
    color: #ffffff;
}

        .artist-card:hover .artist-card-info {
            transform: translateY(0);
        }

        .artist-card-cat {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: normal; /* ← Changed this to remove the spacing */
            text-transform: uppercase;
            color: #ffffff;
            margin-bottom: 3px;
            opacity: 0.85;
        }

        .artist-card-name {
            font-family: 'Jost', sans-serif;
            font-size: 1.65rem; /* Increased from 1.55rem */
            font-weight: 500; /* Made slightly bolder */
            color: #fff;
            letter-spacing: 0.02em;
            line-height: 1.2;
        }

        .artist-card-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 8px;
        }

        .artist-card-location {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.9rem; /* Increased from 0.82rem */
            color: rgba(255, 255, 255, 0.75);
        }

        .artist-card-rate {
            font-size: 0.85rem; /* Increased from 0.72rem */
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.06em;
        }

        .artist-card-cta {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #ffffff;
            /* → was rgba(255,255,255,0.65), now full white */
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 8px;
            opacity: 0;
            transform: translateY(3px);
            transition: opacity 0.28s, transform 0.28s;
        }

        .artist-card:hover .artist-card-cta {
            opacity: 1;
            transform: translateY(0);
        }

        /* Empty state */
        .artist-empty {
            grid-column: 1 / -1;
            padding: 80px 20px;
            text-align: center;
            border: 1px dashed var(--border-strong);
            background: var(--bg-surface);
            transition: background 0.4s;
        }

        .artist-empty-icon {
            margin: 0 auto 18px;
            opacity: 0.2;
        }

        .artist-empty-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.6rem;
            font-weight: 300;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .artist-empty-sub {
            font-size: 0.8rem;
            color: var(--text-muted);
            letter-spacing: 0.08em;
        }

        /* Pagination */
        .pagination-wrap {
            margin-top: 40px;
            padding-top: 28px;
            border-top: 1px solid var(--border);
        }

        /* ═══════════════════════════════════════════
           MOBILE SLIDE-OUT FILTER DRAWER
        ═══════════════════════════════════════════ */

        /* Hide mobile buttons on desktop */
        .mobile-filter-toggle {
            display: none;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.2s;
        }

        .mobile-filter-close {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
            padding: 4px;
        }

        .mobile-filter-overlay {
            display: none;
        }

        /* ── Responsive Mobile drawer logic ── */
        @media (max-width: 768px) {
            .mobile-filter-toggle {
                display: flex;
                /* Show the 'Filters' button on mobile */
            }

            .mobile-filter-close {
                display: block;
                /* Show close 'X' icon in panel */
            }

            /* Convert sidebar to a fixed hidden drawer */
            .filter-sidebar {
                position: fixed !important;
                /* Override standard positioning */
                top: 0 !important;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 9999;
                pointer-events: none;
                /* Let clicks pass through when closed */
                display: flex;
                justify-content: flex-end;
                /* Slide in from the right */
            }

            /* The semi-transparent dark background */
            .mobile-filter-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                opacity: 0;
                transition: opacity 0.3s;
            }

            /* The actual filter panel container */
            .filter-panel {
                position: relative;
                width: 320px;
                max-width: 85vw;
                height: 100vh;
                overflow-y: auto;
                background: var(--bg-surface);
                transform: translateX(100%);
                /* Hidden off-screen to the right */
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -4px 0 24px rgba(0, 0, 0, 0.1);
                border-left: 1px solid var(--border);
                margin-top: 0;
                /* Remove top spacing on mobile */
            }

            /* ── Active State (When drawer is open) ── */
            .filter-sidebar.is-open {
                pointer-events: all;
            }

            .filter-sidebar.is-open .mobile-filter-overlay {
                display: block;
                opacity: 1;
            }

            .filter-sidebar.is-open .filter-panel {
                transform: translateX(0);
                /* Slide into view */
            }
        }

        /* ── Responsive ── */
        @media (max-width: 1100px) {
            .artist-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .directory-page {
                grid-template-columns: 240px 1fr;
                gap: 24px;
            }
        }

        @media (max-width: 768px) {
            .directory-page {
                grid-template-columns: 1fr;
                padding: 24px 20px 60px;
            }

            .filter-sidebar {
                position: static;
            }

            .directory-hero-inner {
                padding: 0 20px;
            }

            .artist-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .artist-grid {
                grid-template-columns: 1fr;
            }
        }
        /* ── Advanced Filters Accordion ── */
        .advanced-filters {
            margin-top: 24px;
            border-top: 1px dashed var(--border-strong);
            padding-top: 16px;
        }

        .advanced-filters-summary {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--text-primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            list-style: none; /* Removes default arrow */
            padding: 8px 0;
            user-select: none;
        }

        .advanced-filters-summary::-webkit-details-marker {
            display: none;
        }

        .advanced-filters-summary svg {
            transition: transform 0.3s ease;
        }

        .advanced-filters[open] .advanced-filters-summary svg {
            transform: rotate(180deg);
        }

        .advanced-filters-content {
            margin-top: 16px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        /* Checkbox styling */
        .filter-checkbox-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .filter-checkbox-wrap input {
            accent-color: var(--gold);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .filter-checkbox-wrap span {
            font-size: 0.85rem;
            color: var(--text-primary);
        }
        /* ── Skeleton shimmer for lazy-loaded cards ── */
.sk-bone {
    display: block;
    position: relative;
    overflow: hidden;
    background: rgba(255, 255, 255, 0.08); /* dark overlay base, works on your dark cards */
    border-radius: 4px;
}

.sk-bone::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        transparent 0%,
        transparent 30%,
        rgba(255, 255, 255, 0.12) 50%,
        transparent 70%,
        transparent 100%
    );
    background-size: 300% 300%;
    animation: skDiag 2s ease-in-out infinite;
}

/* ── Skeleton shimmer ── */
@keyframes skDiag {
    0%   { transform: translateX(-100%) translateY(-100%); }
    100% { transform: translateX(100%) translateY(100%); }
}

.artist-card-media.is-loading {
    background: #e8e4de;
}

[data-theme="dark"] .artist-card-media.is-loading,
.dark .artist-card-media.is-loading {
    background: #2a2620;
}

.artist-card-media.is-loading::after {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 1;
    /* Use transform instead of background-position — far more reliable */
    background: linear-gradient(
        135deg,
        transparent 25%,
        rgba(255, 220, 220, 0.55) 50%,   /* warm gold-white streak */
        transparent 75%
    );
    background-size: 200% 200%;
    animation: skDiag 1.6s ease-in-out infinite;
    pointer-events: none;
}

.artist-card-media img {
    /* already exists — just add: */
    opacity: 0;
    transition: opacity 0.4s ease, transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.artist-card-media img.is-loaded {
    opacity: 1;
}
/* ── Pagination overlay ring ── */
#page-loading-ring {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: 2.5px solid transparent;
    border-top-color: var(--gold);
    border-bottom-color: var(--gold);
    animation: ringSpinGlow 1.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
    box-shadow:
        0 0 18px rgba(180, 140, 60, 0.35),
        inset 0 0 18px rgba(180, 140, 60, 0.15);
}

@keyframes ringSpinGlow {
    0%   { transform: rotate(0deg)   scale(0.92); box-shadow: 0 0 10px rgba(180,140,60,0.2),  inset 0 0 10px rgba(180,140,60,0.1); }
    50%  { transform: rotate(180deg) scale(1.08); box-shadow: 0 0 28px rgba(180,140,60,0.55), inset 0 0 28px rgba(180,140,60,0.3); }
    100% { transform: rotate(360deg) scale(0.92); box-shadow: 0 0 10px rgba(180,140,60,0.2),  inset 0 0 10px rgba(180,140,60,0.1); }
}
    </style>
    
    <div id="page-loading-overlay" style="
        position: fixed;
        inset: 0;
        z-index: 9998;
        background: radial-gradient(circle at center, rgba(252,248,240,0.6) 0%, rgba(252,248,240,0.92) 80%);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease;
    ">
        <div id="page-loading-ring"></div>
    </div>

    
    <div class="directory-hero">
        <div class="directory-hero-inner">
            <div class="directory-hero-eyebrow">Verified Talent Directory</div>
            <h1 class="directory-hero-title">
                Find Your <strong>Perfect Talent.</strong>
            </h1>
            <p class="directory-hero-sub">
                Browse <strong><?php echo e($totalCount); ?></strong> verified professionals — models, actors, photographers &amp; more.
            </p>
        </div>
    </div>

    
    <div class="directory-page">

        
        <aside class="filter-sidebar <?php echo e($showMobileFilters ? 'is-open' : ''); ?>" aria-label="Filter talent">

            
            <div class="mobile-filter-overlay" wire:click="$set('showMobileFilters', false)"></div>

            <div class="filter-panel">
                <div class="filter-panel-title">
                    Filter

                    <div style="display: flex; gap: 12px; align-items: center;">
                        
                        <button class="filter-clear-btn" wire:click="resetFilters">
                            Clear all
                        </button>

                        <button class="mobile-filter-close" wire:click="$set('showMobileFilters', false)">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                

                <div class="filter-group">
                    <label class="filter-label" for="filter-search">Search Name</label>
                    <input id="filter-search" class="filter-input" type="text" placeholder="e.g. Artist name…"
                        wire:model.live.debounce.300ms="search" autocomplete="off">
                </div>

                <div class="filter-group">
                    <label class="filter-label" for="filter-category">Category</label>
                    <div class="filter-select-wrap">
                        <select id="filter-category" class="filter-select" wire:model.live="category">
                            <option value="">All Categories</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $cats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <optgroup label="<?php echo e($groupName); ?>" style="color: var(--gold); font-weight: 600; text-transform: uppercase;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($cat->name); ?>" style="color: var(--text-primary); font-weight: 300; text-transform: none;">
                                            <?php echo e($cat->name); ?>

                                        </option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </optgroup>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                </div>

                <div class="filter-group">
                    <label class="filter-label" for="filter-district">Location (District)</label>
                    <div class="filter-select-wrap">
                        <select id="filter-district" class="filter-select" wire:model.live="district">
                            <option value="">All of Bangladesh</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($loc); ?>"><?php echo e(ucfirst($loc)); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($district): ?>
                    <div class="filter-group anim-fade-up">
                        <label class="filter-label" for="filter-upazila">Thana / Upazila</label>
                        <div class="filter-select-wrap">
                            <select id="filter-upazila" class="filter-select" wire:model.live="upazila">
                                <option value="">All of <?php echo e(ucfirst($district)); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $upazilas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $upa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($upa); ?>"><?php echo e(ucfirst($upa)); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="filter-group">
                    <label class="filter-label" for="filter-gender">Gender</label>
                    <div class="filter-select-wrap">
                        <select id="filter-gender" class="filter-select" wire:model.live="gender">
                            <option value="">Any Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="filter-group">
                    <span class="filter-label">Age Range (Years)</span>
                    <div style="display: flex; gap: 8px;">
                        <input class="filter-input" type="number" placeholder="Min" wire:model.live.debounce.500ms="minAge" min="13">
                        <input class="filter-input" type="number" placeholder="Max" wire:model.live.debounce.500ms="maxAge">
                    </div>
                </div>

                <div class="filter-group">
                    <span class="filter-label">Height Range (Ft)</span>
                    <div style="display: flex; gap: 8px;">
                        <input class="filter-input" type="number" placeholder="Min ft" wire:model.live.debounce.500ms="minHeight">
                        <input class="filter-input" type="number" placeholder="Max ft" wire:model.live.debounce.500ms="maxHeight">
                    </div>
                </div>

                
                <details class="advanced-filters">
                    <summary class="advanced-filters-summary">
                        Advanced Filters
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </summary>

                    <div class="advanced-filters-content">

                        
                        <div class="filter-group" style="border: none; padding: 0; margin: 0;">
                            <label class="filter-label">Experience Level</label>
                            <div class="filter-select-wrap">
                                <select class="filter-select" wire:model.live="experienceLevel">
                                    <option value="">Any Experience</option>
                                    <option value="Fresher">Fresher (No Experience)</option>
                                    <option value="1-3 Years">1–3 Years</option>
                                    <option value="Professional">Professional (3+ Years)</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="filter-group" style="border: none; padding: 0; margin: 0;">
                            <span class="filter-label">Hourly Rate (BDT)</span>
                            <div style="display: flex; gap: 8px;">
                                <input class="filter-input" type="number" placeholder="Min ৳" wire:model.live.debounce.500ms="minRate">
                                <input class="filter-input" type="number" placeholder="Max ৳" wire:model.live.debounce.500ms="maxRate">
                            </div>
                        </div>

                        
                        <div class="filter-group" style="border: none; padding: 0; margin: 0;">
                            <label class="filter-label">Skin Tone</label>
                            <div class="filter-select-wrap">
                                <select class="filter-select" wire:model.live="skinTone">
                                    <option value="">Any Skin Tone</option>
                                    <option value="Fair">Fair</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Dusky">Dusky</option>
                                    <option value="Deep">Deep</option>
                                </select>
                            </div>
                        </div>

                        
                        <div style="display: flex; gap: 8px;">
                            <div class="filter-select-wrap" style="flex: 1;">
                                <select class="filter-select" wire:model.live="hairColor">
                                    <option value="">Hair Color</option>
                                    <option value="Black">Black</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Light Brown">Light Brown</option>
                                    <option value="Blonde">Blonde</option>
                                </select>
                            </div>
                            <div class="filter-select-wrap" style="flex: 1;">
                                <select class="filter-select" wire:model.live="hairLength">
                                    <option value="">Length</option>
                                    <option value="Bald">Bald</option>
                                    <option value="Short">Short</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Long">Long</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="filter-group" style="border: none; padding: 0; margin: 0;">
                            <label class="filter-label">Availability</label>
                            <div class="filter-select-wrap">
                                <select class="filter-select" wire:model.live="availability">
                                    <option value="">Any Availability</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Weekends Only">Weekends Only</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>

                        
                        <label class="filter-checkbox-wrap">
                            <input type="checkbox" wire:model.live="willingToTravel">
                            <span>Willing to travel for projects</span>
                        </label>

                    </div>
                </details>

            </div>
        </aside>

        
        <div class="directory-main">

            
            
            <div class="directory-toolbar">
                <div class="directory-count">
                    Showing <strong><?php echo e($artists->count()); ?></strong> of <strong><?php echo e($totalCount); ?></strong> talents
                </div>

                <div style="display: flex; align-items: center; gap: 16px;">
                    
                    <div style="display: flex; align-items: center; gap: 8px;">
                        <span style="font-size: 0.65rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.15em; color: var(--text-muted);">Show</span>
                        <select wire:model.live="perPage" style="padding: 6px 12px; font-size: 0.85rem; font-family: 'Jost', sans-serif; background: var(--bg-surface); border: 1px solid var(--border-strong); color: var(--text-primary); cursor: pointer; outline: none;">
                            <option value="12">12</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="all">All</option>
                        </select>
                    </div>

                    
                    <button class="mobile-filter-toggle" wire:click="$toggle('showMobileFilters')">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="4" y1="21" x2="4" y2="14"></line>
                            </svg>
                        Filters
                    </button>
                </div>
            </div>

            
            <div wire:loading class="loading-bar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <circle cx="12" cy="12" r="10" opacity="0.25" />
                    <path d="M12 2a10 10 0 0110 10" stroke-linecap="round" />
                </svg>
                Searching…
            </div>

            
            <div class="artist-grid" wire:loading.class="is-loading">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <a href="<?php echo e(route('artist.show', ['slug' => \Illuminate\Support\Str::slug($artist->name) . '-' . $artist->id])); ?>" class="artist-card" aria-label="View <?php echo e($artist->name); ?>'s profile">

                        
                        <div class="artist-card-verified">
                            <div class="artist-card-verified-inner">
                                <svg viewBox="0 0 24 24" fill="#2a7d4f">
                                    <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                </svg>
                                <span>Verified</span>
                            </div>
                        </div>

                        
                        <div class="artist-card-media <?php echo e(($artist->hasMedia('avatar') || $artist->hasMedia('portfolio')) ? 'is-loading' : ''); ?>">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->hasMedia('avatar')): ?>
                                <img src="<?php echo e($artist->getFirstMediaUrl('avatar')); ?>"
                                    alt="<?php echo e($artist->name); ?>"
                                    loading="lazy"
                                    class="artist-img"
                                    onload="this.classList.add('is-loaded'); this.closest('.artist-card-media').classList.remove('is-loading');"
                                    onerror="this.closest('.artist-card-media').classList.remove('is-loading');">
                            <?php elseif($artist->hasMedia('portfolio')): ?>
                                <img src="<?php echo e($artist->getFirstMediaUrl('portfolio')); ?>"
                                    alt="<?php echo e($artist->name); ?>"
                                    loading="lazy"
                                    class="artist-img"
                                    onload="this.classList.add('is-loaded'); this.closest('.artist-card-media').classList.remove('is-loading');"
                                    onerror="this.closest('.artist-card-media').classList.remove('is-loading');">
                            <?php else: ?>
                                <div class="artist-card-placeholder">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1">
                                        <circle cx="12" cy="8" r="4"/>
                                        <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                    </svg>
                                    <span>No Photo</span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        
                        <div class="artist-card-info">
                            <?php
                                $artistCats = (array) ($artist->profile?->categories ?? []);
                                $displayGroups = [];

                                if (!empty($artistCats)) {
                                    // Look up the matching categories, apply your custom sort order, and get unique groups
                                    $displayGroups = \App\Models\Category::whereIn('name', $artistCats)
                                        ->customOrdered()
                                        ->pluck('group')
                                        ->unique()
                                        ->toArray();
                                }
                            ?>

                            <div class="artist-card-cat">
                                <?php echo e(!empty($displayGroups) ? implode(' · ', $displayGroups) : 'Professional'); ?>

                            </div>
                            <div class="artist-card-name"><?php echo e($artist->name); ?></div>
                            <div class="artist-card-meta">
                                <div class="artist-card-location">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                        <circle cx="12" cy="9" r="2.5"/>
                                    </svg>
                                    <?php echo e(implode(', ', array_filter([
                                        $artist->profile?->upazila,
                                        $artist->profile?->district
                                    ])) ?: 'Bangladesh'); ?>

                                </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                                    <div class="artist-card-rate">
                                        <?php echo e(number_format($artist->profile->hourly_rate)); ?> BDT/hr
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="artist-card-hover">

                            <div class="artist-hover-name"><?php echo e($artist->name); ?></div>

                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->categories)): ?>
                                <div class="artist-hover-cats">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $artist->profile->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <span class="artist-hover-cat-tag"><?php echo e($cat); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <div class="artist-hover-divider"></div>

                            <div class="artist-hover-meta">

                                
                                <div class="artist-hover-row">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.5">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                                        <circle cx="12" cy="9" r="2.5"/>
                                    </svg>
                                    <?php echo e(implode(', ', array_filter([
                                        $artist->profile?->upazila,
                                        $artist->profile?->district,
                                        $artist->profile?->country
                                    ])) ?: 'Location not specified'); ?>

                                </div>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->gender || $artist->profile?->date_of_birth): ?>
                                    <div class="artist-hover-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="8" r="4"/>
                                            <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                        </svg>
                                        <?php echo e($artist->profile?->gender ?? ''); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->date_of_birth): ?>
                                            &nbsp;·&nbsp;
                                            <strong>
                                                <?php echo e(\Carbon\Carbon::parse($artist->profile->date_of_birth)->age); ?> yrs
                                            </strong>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->height_cm): ?>
                                    <div class="artist-hover-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path d="M8 3v18M5 6h3M5 10h3M5 14h3M5 18h3M16 3l4 4-4 4M20 7H8"/>
                                        </svg>
                                        <strong><?php echo e($artist->profile->height_cm); ?> ft</strong>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                                    <div class="artist-hover-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <circle cx="12" cy="12" r="10"/>
                                            <path d="M9 8h6M9 12h6M9 16h4"/>
                                        </svg>
                                        Starting from&nbsp;
                                        <strong><?php echo e(number_format($artist->profile->hourly_rate)); ?> BDT/hr</strong>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->languages)): ?>
                                    <div class="artist-hover-row">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path d="M2 5h20M2 12h20M2 19h20"/>
                                        </svg>
                                        <?php echo e(implode(', ', (array)$artist->profile->languages)); ?>

                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>

                            
                            <div class="artist-hover-cta">
                                View Full Profile
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none">
                                    <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor"
                                        stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                        </div>

                    </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="artist-empty">
                        <svg class="artist-empty-icon" width="52" height="52" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1" aria-hidden="true">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <div class="artist-empty-title">No Talent Found</div>
                        <div class="artist-empty-sub">Try adjusting your search filters.</div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="pagination-wrap">
                <?php echo e($artists->links('vendor.pagination.custom-numbered')); ?>

            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.artist-card-media.is-loading img').forEach(img => {
            if (img.complete && img.naturalWidth > 0) {
                img.classList.add('is-loaded');
                img.closest('.artist-card-media').classList.remove('is-loading');
            }
        });
    </script>
    <script>
        (function () {
            const overlay = document.getElementById('page-loading-overlay');

            function showOverlay() {
                overlay.style.opacity = '1';
                overlay.style.pointerEvents = 'all';
                const grid = document.querySelector('.artist-grid');
                if (grid) grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }

            function hideOverlay() {
                overlay.style.opacity = '0';
                overlay.style.pointerEvents = 'none';
            }

            if (window.Livewire) {
                Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
                    if (
                        commit.calls?.some(c =>
                            ['nextPage', 'previousPage', 'gotoPage'].includes(c.method)
                        )
                    ) {
                        showOverlay();
                        succeed(({ snapshot, effect }) => {
                            setTimeout(hideOverlay, 350);
                        });
                    }
                });
            }

            document.addEventListener('livewire:navigated', hideOverlay);
            document.addEventListener('livewire:load', hideOverlay);
        })();
    </script>
</div>
<?php /**PATH /var/www/html/resources/views/livewire/artist-directory.blade.php ENDPATH**/ ?>