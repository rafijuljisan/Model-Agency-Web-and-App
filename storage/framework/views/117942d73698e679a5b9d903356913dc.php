<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Verified Talent Directory'); ?> | Dhaka Model Agency</title>

    <?php $seo = \App\Models\Setting::first(); ?>

    
    <meta name="description" content="<?php echo e($seo?->meta_description ?? 'Verified talent directory — Bangladesh'); ?>">
    <meta name="keywords" content="<?php echo e($seo?->meta_keywords); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:title" content="<?php echo e($title ?? $seo?->meta_title ?? config('app.name')); ?>">
    <meta property="og:description" content="<?php echo e($seo?->meta_description); ?>">
    <meta property="og:image" content="<?php echo e($seo?->og_image ? asset('storage/' . $seo->og_image) : ''); ?>">
    <meta property="og:site_name" content="<?php echo e($seo?->site_name ?? config('app.name')); ?>">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($title ?? $seo?->meta_title ?? config('app.name')); ?>">
    <meta name="twitter:description" content="<?php echo e($seo?->meta_description); ?>">
    <meta name="twitter:image" content="<?php echo e($seo?->og_image ? asset('storage/' . $seo->og_image) : ''); ?>">

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo?->google_search_console_id): ?>
        <meta name="google-site-verification" content="<?php echo e($seo->google_search_console_id); ?>">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo?->google_tag_manager_id): ?>
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?php echo e($seo->google_tag_manager_id); ?>');</script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo?->google_analytics_id): ?>
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($seo->google_analytics_id); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '<?php echo e($seo->google_analytics_id); ?>');
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo?->facebook_pixel_id): ?>
        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq) return; n = f.fbq = function () {
                    n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                }; if (!f._fbq) f._fbq = n;
                n.push = n; n.loaded = !0; n.version = '2.0'; n.queue = []; t = b.createElement(e); t.async = !0;
                t.src = v; s = b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t, s)
            }(window,
                document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?php echo e($seo->facebook_pixel_id); ?>');
            fbq('track', 'PageView');
        </script>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,500&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>


    <style>
        /* ═══════════════════════════════════════════
           DESIGN TOKENS — Light Mode (default)
        ═══════════════════════════════════════════ */
        :root,
        [data-theme="light"] {
            --bg-primary: #faf5f5;
            --bg-secondary: #f2e6e6;
            --bg-surface: #ffffff;
            --bg-nav: rgba(250, 245, 245, 0.94);
            --border: rgba(180, 118, 118, 0.2);
            --border-strong: rgba(180, 158, 118, 0.42);
            --text-primary: #1a1414;
            --text-secondary: #000000;
            --text-muted: #4d4545;
            --gold: #c50000;
            --gold-light: #e24c4c;
            --gold-bg: rgba(184, 74, 74, 0.07);
            --shadow-sm: 0 1px 4px rgba(60, 40, 10, 0.07);
            --shadow-md: 0 4px 24px rgba(60, 40, 10, 0.09);
            --shadow-lg: 0 16px 56px rgba(60, 40, 10, 0.12);
            --btn-fill-bg: #1a1714;
            --btn-fill-color: #faf5f5;
            --btn-fill-hover: #2e2820;
            --badge-ok-bg: #eef6ee;
            --badge-ok-color: #2d6a30;
            --ticker-bg: #d40303;
            --ticker-color: #faf5f5;
            --nav-h: 72px;
        }

        /* ═══════════════════════════════════════════
           DESIGN TOKENS — Dark Mode
        ═══════════════════════════════════════════ */
        [data-theme="dark"] {
            --bg-primary: #0a0a0a;
            /* Shifted from warm-brown to pure dark */
            --bg-secondary: #121212;
            --bg-surface: #1a1a1a;
            --bg-nav: rgba(10, 10, 10, 0.93);
            --border: rgba(255, 255, 255, 0.10);
            /* Removed old gold RGB */
            --border-strong: rgba(255, 255, 255, 0.22);
            /* Removed old gold RGB */
            --text-primary: #ffffff;
            --text-secondary: #e0e0e0;
            --text-muted: #e4e3e3;
            --gold: #ff0000;
            /* Softer, highly visible red for dark mode text/icons */
            --gold-light: #ff8888;
            --gold-bg: rgba(255, 68, 68, 0.12);
            /* Red RGB background tint */
            --shadow-sm: 0 1px 4px rgba(0, 0, 0, 0.45);
            --shadow-md: 0 4px 24px rgba(0, 0, 0, 0.55);
            --shadow-lg: 0 16px 56px rgba(0, 0, 0, 0.65);
            --btn-fill-bg: #d40303;
            /* Deep red for buttons */
            --btn-fill-color: #ffffff;
            /* White text on red provides much better contrast */
            --btn-fill-hover: #ff1a1a;
            /* Brighter red on hover */
            --badge-ok-bg: rgba(46, 106, 48, 0.18);
            --badge-ok-color: #81c784;
            --ticker-bg: #1a1a1a;
            --ticker-color: #ff4444;
            --nav-h: 72px;
        }

        /* ═══════════════════════════════════════════
           BASE
        ═══════════════════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Jost', sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-weight: 300;
            letter-spacing: 0.01em;
            line-height: 1.65;
            min-height: 100vh;
            overflow-x: hidden;
            transition: background-color 0.4s ease, color 0.4s ease;
        }

        /* Subtle paper grain overlay */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9998;
            opacity: 0.028;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 300 300' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        ul,
        ol {
            list-style: none;
        }

        /* ═══════════════════════════════════════════
           TOPBAR (Contact & License)
        ═══════════════════════════════════════════ */
        .site-topbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 36px;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            z-index: 1001;
            display: flex;
            align-items: center;
            justify-content: center;

            /* --- UPDATED FONT SIZE --- */
            font-size: 0.75rem;
            /* Increased from 0.65rem */

            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-secondary);
            transition: background 0.4s, color 0.4s, border-color 0.4s;
        }

        .topbar-inner {
            width: 100%;
            max-width: 1440px;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .site-topbar a {
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .site-topbar a:hover {
            color: var(--gold);
        }

        .topbar-left {
            display: flex;
            gap: 24px;
            align-items: center;
        }

        .topbar-right {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .topbar-right svg {
            width: 15px;
            height: 15px;
            transition: transform 0.2s ease;
            /* Optional: adds a smooth effect */
        }

        /* Optional: Makes them pop slightly when you hover over them */
        .site-topbar a:hover svg {
            transform: scale(1.15);
        }

        /* Push existing fixed elements down by 36px */
        .site-nav {
            top: 36px;
        }

        .site-ticker {
            top: calc(var(--nav-h) + 36px);
        }

        .site-main {
            padding-top: calc(var(--nav-h) + 36px + 36px);
        }

        .nav-drawer {
            padding-top: calc(var(--nav-h) + 36px + 24px);
        }

        @media (max-width: 768px) {
            .topbar-inner {
                padding: 0 20px;
            }

            .topbar-right {
                display: none;
            }

            /* --- UPDATED MOBILE FONT SIZE --- */
            .topbar-left {
                width: 100%;
                justify-content: space-between;
                font-size: 0.75rem;
                gap: 10px;
            }

            /* Increased from 0.55rem */
        }

        /* ═══════════════════════════════════════════
           NAVIGATION
        ═══════════════════════════════════════════ */
        .site-nav {
            position: fixed;
            /* REMOVED top: 36px; */
            left: 0;
            right: 0;
            height: var(--nav-h);
            z-index: 1000;
            display: flex;
            align-items: center;
            transition: background 0.45s, box-shadow 0.45s, backdrop-filter 0.45s;
        }

        .site-nav.is-scrolled {
            background: var(--bg-nav);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
            box-shadow: 0 1px 0 var(--border), var(--shadow-sm);
        }

        .nav-inner {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        /* Brand */
        /* ── Dynamic Logo ── */
        .nav-brand-logo {
            height: 52px;
            /* Base size within the 72px navbar */
            width: auto;
            object-fit: contain;
            display: block;

            /* The Overlap Magic */
            transform: scale(1.45);
            /* Visually scales it to ~75px to break the boundary */
            transform-origin: left center;
            /* Keeps it locked to the left edge */

            /* Adds a soft shadow so the overlapping part pops off the red ticker */
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.12));

            transition: transform 0.3s ease;
        }

        [data-theme="dark"] .nav-brand-logo {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.4));
        }

        /* Mobile adjustments for the overlapping logo */
        @media (max-width: 768px) {
            .nav-brand-logo {
                height: 42px;
                transform: scale(1.25);
                /* A slightly smaller overlap on mobile */
            }
        }

        .nav-brand {
            display: flex;
            flex-direction: column;
            line-height: 1;
            flex-shrink: 0;
        }

        .nav-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.55rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-primary);
            transition: color 0.3s;
        }

        .nav-brand-name em {
            color: var(--gold);
            font-style: normal;
        }

        .nav-brand-sub {
            font-size: 0.65rem;
            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 3px;
            transition: color 0.3s;
        }

        /* Centre links */
        .nav-links {
            display: flex;
            align-items: center;
        }

        .nav-links>li>a,
        .nav-links>li>.nav-drop-btn {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 6px 15px;

            /* --- UPDATED FONT SIZE --- */
            font-size: 1rem;
            /* Increased from 0.68rem */

            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-secondary);
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Jost', sans-serif;
            transition: color 0.22s;
            white-space: nowrap;
            position: relative;
        }

        .nav-links>li>a::after {
            content: '';
            position: absolute;
            left: 15px;
            right: 15px;
            bottom: 0;
            height: 1px;
            background: var(--gold);
            transform: scaleX(0);
            transition: transform 0.28s ease;
        }

        .nav-links>li>a:hover,
        .nav-links>li>.nav-drop-btn:hover {
            color: var(--text-primary);
        }

        .nav-links>li>a:hover::after {
            transform: scaleX(1);
        }

        .chevron {
            width: 9px;
            height: 9px;
            flex-shrink: 0;
            transition: transform 0.25s;
            opacity: 0.5;
        }

        .nav-dropdown:hover .chevron {
            transform: rotate(180deg);
            opacity: 1;
        }

        /* Dropdown panel */
        .nav-dropdown {
            position: relative;
        }

        .nav-drop-panel {
            position: absolute;
            top: 100%;
            /* ← Remove the gap */
            left: 50%;
            transform: translateX(-50%) translateY(8px);
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            box-shadow: var(--shadow-lg);
            min-width: 196px;
            padding: 6px 0;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s, transform 0.2s;

            /* ── Bridge: fills the invisible gap so mouse doesn't lose hover ── */
            padding-top: 8px;
            /* ← Replaces the top gap with internal padding */
            margin-top: 0;
        }

        /* ── Invisible bridge between button and panel ── */
        .nav-dropdown::after {
            content: '';
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            height: 12px;
            /* Covers any remaining gap */
            background: transparent;
        }

        .nav-dropdown:hover .nav-drop-panel {
            opacity: 1;
            pointer-events: all;
            transform: translateX(-50%) translateY(0);
        }

        .nav-drop-panel a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;

            /* --- UPDATED FONT SIZE --- */
            font-size: 1.00rem;
            /* Increased from 0.90rem */

            font-weight: 400;
            color: var(--text-secondary);
            transition: background 0.18s, color 0.18s;
        }

        .nav-drop-panel a .dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--gold);
            opacity: 0;
            flex-shrink: 0;
            transition: opacity 0.18s;
        }

        .nav-drop-panel a:hover {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .nav-drop-panel a:hover .dot {
            opacity: 1;
        }

        /* Right actions */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        /* Theme toggle */
        .theme-toggle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid var(--border-strong);
            background: var(--bg-surface);
            color: var(--text-muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: border-color 0.25s, color 0.25s, background 0.25s, transform 0.3s;
            flex-shrink: 0;
        }

        .theme-toggle:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
            transform: rotate(22deg);
        }

        .theme-toggle svg {
            width: 15px;
            height: 15px;
        }

        /* Show sun in dark mode, moon in light mode */
        .icon-sun {
            display: none;
        }

        .icon-moon {
            display: block;
        }

        [data-theme="dark"] .icon-sun {
            display: block;
        }

        [data-theme="dark"] .icon-moon {
            display: none;
        }

        /* Buttons */
        .btn-ghost {
            /* --- UPDATED FONT SIZE --- */
            font-size: 0.875rem;
            /* Increased from 0.68rem */

            font-weight: 500;
            text-transform: uppercase;
            color: var(--text-secondary);
            transition: color 0.22s;
            white-space: nowrap;
        }

        .btn-ghost:hover {
            color: var(--gold);
        }

        .btn-fill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 22px;
            background: var(--btn-fill-bg);
            color: var(--btn-fill-color);
            font-family: 'Jost', sans-serif;

            /* --- UPDATED FONT SIZE --- */
            font-size: 0.875rem;
            /* Increased from 0.67rem */

            font-weight: 500;
            text-transform: uppercase;
            border: none;
            cursor: pointer;
            transition: background 0.25s, transform 0.2s;
            white-space: nowrap;
        }

        .btn-fill:hover {
            background: var(--btn-fill-hover);
            transform: translateY(-1px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 22px;
            border: 1px solid var(--border-strong);
            background: transparent;
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            cursor: pointer;
            transition: border-color 0.25s, color 0.25s, transform 0.2s;
            white-space: nowrap;
        }

        .btn-outline:hover {
            border-color: var(--gold);
            color: var(--gold);
            transform: translateY(-1px);
        }

        /* Hamburger */
        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }

        .nav-hamburger span {
            display: block;
            width: 22px;
            height: 1.5px;
            background: var(--text-primary);
            transition: transform 0.3s, opacity 0.3s;
        }

        /* Mobile drawer */
        .nav-drawer {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 999;
            background: var(--bg-primary);
            padding: 130px 36px 40px;
            /* Increased top padding from 96px to 130px */
            flex-direction: column;
            overflow-y: auto;
        }

        .nav-drawer.is-open {
            display: flex;
        }

        .nav-drawer a {
            display: block;
            padding: 15px 0;
            font-family: 'Jost', sans-serif;
            font-size: 1.45rem;
            font-weight: 400;
            letter-spacing: 0.04em;
            color: var(--text-primary);
            border-bottom: 1px solid var(--border);
            transition: color 0.22s, padding-left 0.22s;
        }

        .nav-drawer a:hover {
            color: var(--gold);
            padding-left: 8px;
        }

        .drawer-actions {
            margin-top: 28px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .drawer-actions .btn-fill,
        .drawer-actions .btn-outline {
            justify-content: center;
        }

        /* ═══════════════════════════════════════════
           ANNOUNCEMENT TICKER
        ═══════════════════════════════════════════ */
        .site-ticker {
            position: fixed;
            /* REMOVED top: calc... */
            left: 0;
            right: 0;
            z-index: 999;
            height: 36px;
            background: var(--ticker-bg);
            color: var(--ticker-color);
            font-family: 'Jost', sans-serif;
            font-size: 0.90rem;
            font-weight: 500;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            overflow: hidden;
            transition: background 0.4s, color 0.4s;
        }

        .ticker-track {
            display: flex;
            white-space: nowrap;
            /* --- SLOWER SPEED --- */
            /* Increased from 32s to 60s. (Higher number = slower speed) */
            animation: ticker 60s linear infinite;
        }

        .ticker-track span {
            padding: 0 30px;
        }

        .ticker-track span::before {
            content: '✦';
            margin-right: 30px;
            opacity: 0.55;
        }

        @keyframes ticker {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* ═══════════════════════════════════════════
           MAIN CONTENT AREA
        ═══════════════════════════════════════════ */
        .site-main {
            /* Accounts for Nav Height (72px) + Topbar (36px) + Ticker (36px) */
            padding-top: calc(var(--nav-h) + 72px);
            min-height: 78vh;
        }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        .site-footer {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            margin-top: 80px;
            transition: background 0.4s;
        }

        .footer-top {
            max-width: 1440px;
            margin: 0 auto;
            padding: 64px 40px 0;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
        }

        /* Footer brand */
        .footer-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            font-weight: 600;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .footer-brand-name em {
            color: var(--gold);
            font-style: normal;
        }

        .footer-brand-sub {
            font-size: 0.75rem;
            letter-spacing: 0.36em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 18px;
        }

        .footer-brand-desc {
            font-size: 1.2rem;
            color: var(--text-secondary);
            line-height: 1.8;
            max-width: 290px;
            margin-bottom: 22px;
        }

        /* Social icons */
        .footer-socials {
            display: flex;
            gap: 8px;
        }

        .social-btn {
            width: 34px;
            height: 34px;
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            transition: border-color 0.22s, color 0.22s, background 0.22s;
        }

        .social-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
        }

        /* Footer columns */
        .footer-col-title {
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 18px;
        }

        .footer-col-links {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .footer-col-links a {
            font-size: 1.2rem;
            color: var(--text-secondary);
            transition: color 0.22s, padding-left 0.22s;
            display: block;
        }

        .footer-col-links a:hover {
            color: var(--gold);
            padding-left: 5px;
        }

        /* Footer bottom bar */
        .footer-bottom {
            max-width: 1440px;
            margin: 0 auto;
            padding: 22px 40px;
            border-top: 1px solid var(--border);
            margin-top: 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-copy {
            font-size: 0.85rem;
            color: var(--text-muted);
            letter-spacing: 0.07em;
        }

        .footer-legal {
            display: flex;
            gap: 22px;
        }

        .footer-legal a {
            font-size: 0.85rem;
            color: var(--text-muted);
            letter-spacing: 0.07em;
            transition: color 0.22s;
        }

        .footer-legal a:hover {
            color: var(--gold);
        }

        /* ═══════════════════════════════════════════
           GLOBAL UTILITY CLASSES
        ═══════════════════════════════════════════ */
        .badge-verified {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 2px 8px;
            background: var(--badge-ok-bg);
            color: var(--badge-ok-color);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 2px;
            transition: background 0.3s, color 0.3s;
        }

        .divider-rule {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--gold);
            font-family: 'Jost', sans-serif;
            font-size: 1rem;
        }

        .divider-rule::before,
        .divider-rule::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-strong);
        }

        @keyframes fade-up {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .anim-fade-up {
            animation: fade-up 0.65s ease both;
        }

        .anim-d1 {
            animation-delay: 0.08s;
        }

        .anim-d2 {
            animation-delay: 0.18s;
        }

        .anim-d3 {
            animation-delay: 0.30s;
        }

        /* ═══════════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .nav-links {
                display: none;
            }

            .nav-hamburger {
                display: flex;
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }

            /* Add this to hide the top-right buttons on mobile */
            .nav-actions .btn-ghost,
            .nav-actions .btn-fill,
            .nav-actions .btn-outline {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .nav-inner {
                padding: 0 20px;
            }

            .footer-top {
                grid-template-columns: 1fr;
                padding: 40px 20px 0;
            }

            .footer-bottom {
                padding: 18px 20px;
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* ═══════════════════════════════════════════
   MODERN CARD MEGA MENU
═══════════════════════════════════════════ */
        .nav-drop-panel.mega-menu-modern {
            width: 640px;
            max-width: 90vw;
            /* Removed redundant left, padding-top, and margin-top */
            transform: translateX(-50%) translateY(10px);
            padding: 0;
            cursor: default;
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        .nav-dropdown:hover .nav-drop-panel.mega-menu-modern {
            transform: translateX(-50%) translateY(0);
        }

        .mega-menu-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* 2x3 Grid */
            background: var(--bg-surface);
        }

        .mega-menu-card {
            padding: 24px 32px;
            border-bottom: 1px solid var(--border);
            border-right: 1px solid var(--border);
            text-decoration: none;
            transition: background 0.3s;
        }

        .mega-menu-card:nth-child(even) {
            border-right: none;
        }

        .mega-menu-card:nth-last-child(-n+2) {
            border-bottom: none;
        }

        /* Hide bottom borders on last row */

        .mega-menu-card:hover {
            background: var(--gold-bg);
        }

        .mega-menu-card-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
            transition: color 0.3s;
        }

        .mega-menu-card:hover .mega-menu-card-title {
            color: var(--gold);
        }

        .mega-menu-card-sub {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .mega-menu-footer {
            background: var(--bg-secondary);
            padding: 16px 32px;
            text-align: center;
            border-top: 1px solid var(--border);
        }

        .mega-menu-all {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-primary);
            text-decoration: none;
            transition: color 0.2s;
        }

        .mega-menu-all:hover {
            color: var(--gold);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .mega-menu-cards {
                grid-template-columns: 1fr;
            }

            .mega-menu-card {
                border-right: none;
            }

            .mega-menu-card:nth-last-child(2) {
                border-bottom: 1px solid var(--border);
            }

            .nav-drop-panel.mega-menu-modern {
                width: 100%;
                left: 0;
                transform: none !important;
            }
        }
        /* ── Mobile Drawer button overrides ── */
        @media (max-width: 1024px) {
            .nav-drawer .drawer-actions .btn-outline {
                border-color: var(--border-strong);
                color: var(--text-primary);
                background: var(--bg-surface);
            }

            .nav-drawer .drawer-actions .btn-fill {
                background: var(--btn-fill-bg);
                color: var(--btn-fill-color);
            }
        }
        /* Logout Icon Button (Desktop) */
        .logout-icon-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.25s, transform 0.2s;
            margin-left: 4px;
        }

        .logout-icon-btn:hover {
            color: var(--gold);
            transform: translateX(2px);
        }
    </style>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo): ?>
    <?php
        $socialLinks = array_values(array_filter([
            $seo->facebook_url,
            $seo->instagram_url,
            $seo->youtube_url,
            $seo->linkedin_url
        ]));

        $schemaData = [
            "@context" => "https://schema.org",
            "@type" => $seo->schema_org_type ?? 'Organization',
            "name" => $seo->site_name ?? config('app.name'),
            "description" => $seo->meta_description,
            "url" => url('/'),
            "telephone" => $seo->contact_phone,
            "email" => $seo->contact_email,
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => "Dhaka",
                "addressCountry" => "BD"
            ]
        ];

        if (!empty($socialLinks)) {
            $schemaData["sameAs"] = $socialLinks;
        }
    ?>

    <script type="application/ld+json">
    <?php echo json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

    </script>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</head>

<body>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($seo?->google_tag_manager_id): ?>
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo e($seo->google_tag_manager_id); ?>"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php
        $settings = \App\Models\Setting::first();
    ?>
    <div class="site-topbar" aria-label="Top contact bar">
        <div class="topbar-inner">
            <div class="topbar-left">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->contact_phone): ?>
                    <a href="tel:<?php echo e($settings->contact_phone); ?>" aria-label="Call us">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                        </svg>
                        Call Us: <?php echo e($settings->contact_phone); ?>

                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->license_number): ?>
                    <span>Lic. No: <?php echo e($settings->license_number); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="topbar-right">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->facebook_url): ?>
                    <a href="<?php echo e($settings->facebook_url); ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg
                            viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                        </svg></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->instagram_url): ?>
                    <a href="<?php echo e($settings->instagram_url); ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="2" y="2" width="20" height="20" rx="5" />
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->youtube_url): ?>
                    <a href="<?php echo e($settings->youtube_url); ?>" target="_blank" rel="noopener" aria-label="YouTube"><svg
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="var(--bg-secondary)" />
                        </svg></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->linkedin_url): ?>
                    <a href="<?php echo e($settings->linkedin_url); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><svg
                            viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z" />
                        </svg></a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
    
    <nav class="site-nav" id="siteNav" aria-label="Primary navigation">
        <div class="nav-inner">

            <?php
                // Fetch the settings (assuming you have a Setting model holding the first row)
                // $settings = \App\Models\Setting::first();

                $siteName = $settings->site_name ?? 'Dhaka Model Agency';
                $siteSub = $settings->site_description ?? 'Verified Talent Directory';
                $logo = $settings->logo ? asset('storage/' . $settings->logo) : null;
            ?>

            
            <a href="/" class="nav-brand" aria-label="<?php echo e($siteName); ?> — home">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($logo): ?>
                    
                    <img src="<?php echo e($logo); ?>" alt="<?php echo e($siteName); ?> Logo" class="nav-brand-logo">
                <?php else: ?>
                    
                    <span class="nav-brand-name"><?php echo e($siteName); ?></span>
                    <span class="nav-brand-sub"><?php echo e($siteSub); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>

            
            <ul class="nav-links" role="list">
                <li><a href="/artists">Browse Talent</a></li>

                <li class="nav-dropdown">
                    <button class="nav-drop-btn" type="button" aria-haspopup="listbox" aria-expanded="false">
                        Categories
                        <svg class="chevron" viewBox="0 0 10 6" fill="none" aria-hidden="true">
                            <path d="M1 1l4 4 4-4" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div class="nav-drop-panel mega-menu-modern" role="listbox">
                        <div class="mega-menu-cards">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <a href="/artists?group=<?php echo e(urlencode($group)); ?>" class="mega-menu-card">
                                    <div class="mega-menu-card-title"><?php echo e($group); ?></div>
                                    <div class="mega-menu-card-sub">
                                        Browse all <?php echo e($group); ?> talent
                                    </div>
                                </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <div class="mega-menu-footer">
                            <a href="/artists" class="mega-menu-all">Browse All Talent &rarr;</a>
                        </div>
                    </div>
                </li>

                <li><a href="/casting">Casting Calls</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/videos">Videos</a></li>
                <li><a href="/editorial">Editorial</a></li>
            </ul>

            
            <div class="nav-actions">

                
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                    
                    <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        aria-hidden="true">
                        <circle cx="12" cy="12" r="4" />
                        <path
                            d="M12 2v2M12 20v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M2 12h2M20 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                    </svg>
                    
                    <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        aria-hidden="true">
                        <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                    </svg>
                </button>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="/account" class="btn-outline">Dashboard</a>
                    
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline-flex;">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="logout-icon-btn" aria-label="Log out" title="Log Out">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                        </button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="btn-ghost">Sign In</a>
                    <a href="/register" class="btn-fill">
                        Join as Talent
                        <svg width="9" height="9" viewBox="0 0 9 9" fill="none" aria-hidden="true">
                            <path d="M1 4.5h7M4.5 1l3.5 3.5L4.5 8" stroke="currentColor" stroke-width="1.4"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <button class="nav-hamburger" id="navHamburger" aria-label="Open menu" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    
    <div class="nav-drawer" id="navDrawer" role="dialog" aria-label="Mobile menu" aria-hidden="true">
        <a href="/artists" style="font-weight: 600;">Browse All Talent</a>

        
        <div style="font-size:0.65rem; font-weight:700; letter-spacing:0.15em;
                    text-transform:uppercase; color:var(--gold);
                    margin:16px 0 4px 20px; opacity:0.8;">
            Categories
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $navGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <a href="/artists?group=<?php echo e(urlencode($group)); ?>"
            style="padding-left:28px;
                    font-size:1.25rem;
                    padding-top:8px;
                    padding-bottom:8px;
                    font-family:'Cormorant Garamond', serif;
                    font-weight:500;">
                <?php echo e($group); ?>

            </a>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

        <a href="/casting">Casting Calls</a>
        <a href="/about">About</a>
        <a href="/contact">Contact</a>
        <a href="/videos">Videos</a>
        <a href="/editorial">Editorial</a>

        <div class="drawer-actions">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <a href="/account" class="btn-fill" style="width: 100%; justify-content: center; margin-bottom: 10px;">Dashboard</a>
                
                
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="width: 100%;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-outline" style="width: 100%; justify-content: center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 6px;">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Log Out
                    </button>
                </form>
            <?php else: ?>
                <a href="/login" class="btn-outline" style="width: 100%; justify-content: center; margin-bottom: 10px;">Sign
                    In</a>
                <a href="/register" class="btn-fill" style="width: 100%; justify-content: center;">Join as Talent</a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="site-ticker" aria-live="polite" aria-label="Site announcements">
        <div class="ticker-track" aria-hidden="true">
            <?php
                // Fetch the latest 8 published editorials
                $tickerEditorials = \App\Models\Editorial::where('is_published', true)
                    ->latest('published_at')
                    ->take(8)
                    ->get();

                // Fallback text if no editorials exist yet
                if ($tickerEditorials->isEmpty()) {
                    $tickerEditorials = collect([
                        (object) ['title' => 'Welcome to Dhaka Model Agency'],
                        (object) ['title' => 'New Casting Calls Posted Daily'],
                        (object) ['title' => 'Models & Actors — Create Your Free Verified Profile']
                    ]);
                }
            ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tickerEditorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editorial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <span>
                    
                    
                        <?php echo e($editorial->title); ?>

                        
                </span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tickerEditorials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $editorial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <span><?php echo e($editorial->title); ?></span>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    
    <main class="site-main" id="main-content">
        <?php echo e($slot); ?>

    </main>

    
    <footer class="site-footer" aria-label="Site footer">
        <div class="footer-top">

            
            <div>
                <div class="footer-brand-name">Dhaka Model<em>Agency</em></div>
                <div class="footer-brand-sub">Verified Talent Directory</div>
                <p class="footer-brand-desc">
                    Bangladesh's leading creative talent platform — connecting models, actors, photographers, content
                    creators, and brand promoters with brands and production houses.
                </p>
                <div class="footer-socials">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->facebook_url): ?>
                        <a href="<?php echo e($settings->facebook_url); ?>" target="_blank" rel="noopener noreferrer" class="social-btn"
                            aria-label="Facebook">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                            </svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->instagram_url): ?>
                        <a href="<?php echo e($settings->instagram_url); ?>" target="_blank" rel="noopener noreferrer"
                            class="social-btn" aria-label="Instagram">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="2" y="2" width="20" height="20" rx="5" />
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                            </svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->youtube_url): ?>
                        <a href="<?php echo e($settings->youtube_url); ?>" target="_blank" rel="noopener noreferrer" class="social-btn"
                            aria-label="YouTube">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                                <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="var(--bg-secondary)" />
                            </svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->linkedin_url): ?>
                        <a href="<?php echo e($settings->linkedin_url); ?>" target="_blank" rel="noopener noreferrer" class="social-btn"
                            aria-label="LinkedIn">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z" />
                            </svg>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div>
                <div class="footer-col-title">Talent</div>
                <ul class="footer-col-links">
                    <?php
                        // Safely fetch distinct, active category groups directly from the database
                        $footerGroups = \App\Models\Category::where('is_active', true)
                            ->select('group')
                            ->distinct()
                            ->orderBy('group')
                            ->pluck('group');
                    ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $footerGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <li>
                            <a href="/artists?group=<?php echo e(urlencode($group)); ?>">
                                <?php echo e($group); ?>

                            </a>
                        </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>
            </div>

            
            <div>
                <div class="footer-col-title">Platform</div>
                <ul class="footer-col-links">
                    <li><a href="/casting">Casting Calls</a></li>
                    <li><a href="/register">Join as Talent</a></li>
                    <li><a href="/hire">Hire Talent</a></li>
                    <li><a href="/pricing">Pricing Plans</a></li>
                    <li><a href="/editorial">Editorial</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="/videos">Videos</a></li>
                </ul>
            </div>

            
            <div>
                <div class="footer-col-title">Support</div>
                <ul class="footer-col-links">
                    <li><a href="/help">Help Center</a></li>
                    <li><a href="/contact">Contact Us</a></li>
                    <li><a href="/privacy">Privacy Policy</a></li>
                    <li><a href="/terms">Terms of Service</a></li>
                    <li><a href="/legal">Legal &amp; Copyright</a></li>
                    <li><a href="/admin/login">Admin Login</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span class="footer-copy">
                &copy; <?php echo e(date('Y')); ?> Dhaka Model Agency. All rights reserved. &nbsp;&middot;&nbsp; Dhaka, Bangladesh
            </span>

            <span class="footer-copy" style="font-size: 0.875rem;">
                Developed by
                <a href="https://jisan.openwindowbd.com" target="_blank" rel="noopener"
                    style="color: var(--text-secondary); letter-spacing: 0.1em;">
                    Jisan Sheikh
                </a>
            </span>
            <ul class="footer-legal">
                <li><a href="/privacy">Privacy</a></li>
                <li><a href="/terms">Terms</a></li>
                <li><a href="/legal">Legal</a></li>
                <li><a href="/sitemap">Sitemap</a></li>
            </ul>
        </div>
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>


    <script>
        /* ──────────────────────────────────────
           THEME TOGGLE — light default, persisted
        ────────────────────────────────────── */
        (function () {
            const html = document.documentElement;
            const btn = document.getElementById('themeToggle');
            const KEY = 'am_theme';

            function apply(theme) {
                html.setAttribute('data-theme', theme);
                localStorage.setItem(KEY, theme);
                btn.setAttribute('aria-label', theme === 'dark' ? 'Switch to light mode' : 'Switch to dark mode');
            }

            // Restore saved preference; default = light
            apply(localStorage.getItem(KEY) || 'light');

            btn.addEventListener('click', function () {
                apply(html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
            });
        })();

        /* ──────────────────────────────────────
           NAV & TICKER — Smooth scroll tracking
        ────────────────────────────────────── */
        (function () {
            const nav = document.getElementById('siteNav');
            const ticker = document.querySelector('.site-ticker');

            function tick() {
                const scrollY = window.scrollY;

                // 1. Toggle frosted glass effect when scrolled past 10px
                nav.classList.toggle('is-scrolled', scrollY > 10);

                // 2. Smoothly slide the nav and ticker up as the topbar scrolls away
                // 36 is the height of the topbar
                const navTop = Math.max(0, 36 - scrollY);
                nav.style.top = navTop + 'px';

                if (ticker) {
                    // Ticker sits exactly below the nav (nav is 72px tall)
                    ticker.style.top = (navTop + 72) + 'px';
                }
            }

            window.addEventListener('scroll', tick, { passive: true });
            tick(); // Run once on load to set initial positions
        })();

        /* ──────────────────────────────────────
           MOBILE DRAWER
        ────────────────────────────────────── */
        (function () {
            const hamburger = document.getElementById('navHamburger');
            const drawer = document.getElementById('navDrawer');
            const spans = hamburger.querySelectorAll('span');
            let open = false;

            function toggle() {
                open = !open;
                drawer.classList.toggle('is-open', open);
                hamburger.setAttribute('aria-expanded', open);
                drawer.setAttribute('aria-hidden', !open);
                document.body.style.overflow = open ? 'hidden' : '';

                if (open) {
                    spans[0].style.transform = 'translateY(6.5px) rotate(45deg)';
                    spans[1].style.opacity = '0';
                    spans[2].style.transform = 'translateY(-6.5px) rotate(-45deg)';
                } else {
                    spans[0].style.transform = '';
                    spans[1].style.opacity = '';
                    spans[2].style.transform = '';
                }
            }

            hamburger.addEventListener('click', toggle);
            drawer.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () { if (open) toggle(); });
            });
        })();
    </script>
</body>

</html><?php /**PATH H:\agency-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>