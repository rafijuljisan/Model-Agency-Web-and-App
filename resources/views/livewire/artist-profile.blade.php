<div x-data="{
    activeTab: 'about',
    showModal: false
}" x-init="
    // Sync modal state with Livewire
    $watch('$wire.showAgencyModal', val => showModal = val)
">

    <style>
        /* ═══════════════════════════════════════════════════════
   ARTIST PROFILE — REDESIGNED
   Aesthetic: Editorial Luxury · Refined Minimalism
   Font: Cormorant Garamond (display) + Jost (body)
═══════════════════════════════════════════════════════ */

@font-face {
        font-family: 'SolaimanLipi';
        src: local('SolaimanLipi'),
             url('/fonts/SolaimanLipi.woff2') format('woff2'),
             url('/fonts/SolaimanLipi.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }

        /* ── Hero Section ── */
        .ap-hero {
            position: relative;
            height: 280px;
            /* ← Change this from 380px to 280px */
            overflow: hidden;
            background: var(--bg-secondary);
        }

        .ap-hero-pattern {
            position: absolute;
            inset: 0;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 40px, var(--border) 40px, var(--border) 41px),
                repeating-linear-gradient(-45deg, transparent, transparent 40px, var(--border) 40px, var(--border) 41px);
            opacity: 0.25;
        }

        .ap-hero-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg,
                    rgba(197, 0, 0, 0.08) 0%,
                    transparent 50%,
                    rgba(197, 0, 0, 0.04) 100%);
        }

        .ap-hero-bottom-fade {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 160px;
            background: linear-gradient(to top, var(--bg-primary), transparent);
            z-index: 1;
        }

        /* ── Profile Shell ── */
        .ap-shell {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 40px 80px;
        }

        /* ── Profile Card Header ── */
        .ap-header {
            position: relative;
            z-index: 2;
            margin-top: -120px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 32px;
            align-items: flex-end;
            padding-bottom: 32px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 0;
        }

        /* ── Avatar ── */
        .ap-avatar-ring {
            position: relative;
            flex-shrink: 0;
        }

        .ap-avatar {
            width: 160px;
            height: 160px;
            border-radius: 50%;
            border: 5px solid var(--bg-primary);
            overflow: hidden;
            background: var(--bg-secondary);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15), 0 0 0 1px var(--border-strong);
            transition: box-shadow 0.3s;
        }

        .ap-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .ap-avatar:hover img {
            transform: scale(1.05);
        }

        .ap-avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            background: var(--bg-secondary);
        }

        .ap-verified-ring {
            position: absolute;
            bottom: 8px;
            right: 8px;
            width: 36px;
            height: 36px;
            background: #16a34a;
            border: 3px solid var(--bg-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.4);
        }

        /* ── Identity Block ── */
        .ap-identity {
            padding-bottom: 8px;
        }

        .ap-name {
            font-family: 'Jost', sans-serif;
            font-size: 3.2rem;
            font-weight: 500;
            color: var(--text-primary);
            line-height: 1;
            margin: 0 0 12px;
            letter-spacing: -0.01em;
        }

        .ap-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 14px;
        }

        .ap-tag {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--gold);
            background: var(--gold-bg);
            border: 1px solid currentColor;
            padding: 4px 12px;
            border-radius: 2px;
            opacity: 0.9;
        }

        .ap-tag-verified {
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            color: #16a34a;
            background: rgba(22, 163, 74, 0.08);
            border: 1px solid rgba(22, 163, 74, 0.3);
            padding: 4px 12px;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .ap-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .ap-meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.88rem;
            color: var(--text-muted);
            font-weight: 400;
            letter-spacing: 0.03em;
        }

        .ap-meta-item svg {
            opacity: 0.6;
            flex-shrink: 0;
        }

        .ap-meta-dot {
            width: 3px;
            height: 3px;
            border-radius: 50%;
            background: var(--border-strong);
        }

        /* ── Action Buttons ── */
        .ap-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-bottom: 8px;
            align-items: flex-end;
        }

        /* ── Stats Strip ── */
        .ap-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* <-- Changed to 4 columns */
            border: 1px solid var(--border);
            border-top: none;
            background: var(--bg-surface);
            margin-bottom: 32px;
        }

        .ap-stat {
            padding: 20px 28px;
            border-right: 1px solid var(--border);
            transition: background 0.2s;
        }

        .ap-stat:last-child {
            border-right: none;
        }

        .ap-stat:hover {
            background: var(--gold-bg);
        }

        .ap-stat-num {
            font-family: 'Jost', sans-serif;
            font-size: 2rem;
            font-weight: 500;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .ap-stat-num span {
            color: var(--gold);
        }

        .ap-stat-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        /* ── Tab Navigation ── */
        .ap-tabs {
            display: flex;
            gap: 0;
            border-bottom: 1px solid var(--border);
            margin-bottom: 32px;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .ap-tabs::-webkit-scrollbar {
            display: none;
        }

        .ap-tab {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 14px 24px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-muted);
            background: none;
            border: none;
            border-bottom: 2px solid transparent;
            cursor: pointer;
            font-family: 'Jost', sans-serif;
            transition: color 0.2s, border-color 0.2s;
            white-space: nowrap;
            margin-bottom: -1px;
        }

        .ap-tab:hover {
            color: var(--text-primary);
        }

        .ap-tab.is-active {
            color: var(--gold);
            border-bottom-color: var(--gold);
        }

        .ap-tab-count {
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--border-strong);
            color: var(--text-muted);
            padding: 2px 6px;
            border-radius: 999px;
            min-width: 20px;
            text-align: center;
        }

        .ap-tab.is-active .ap-tab-count {
            background: var(--gold-bg);
            color: var(--gold);
        }

        /* ── Main Layout ── */
        .ap-body {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 28px;
            align-items: start;
        }

        .ap-content {}

        /* ── Tab Panels ── */
        .ap-panel {
            display: none;
        }

        .ap-panel.is-active {
            display: block;
        }

        /* ── Content Cards ── */
        .ap-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            margin-bottom: 20px;
            transition: background 0.4s, border-color 0.4s;
        }

        .ap-card:last-child {
            margin-bottom: 0;
        }

        .ap-card-head {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ap-card-head-icon {
            width: 28px;
            height: 28px;
            background: var(--gold-bg);
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
        }

        .ap-card-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: 0.02em;
        }

        .ap-card-body {
            padding: 28px;
        }

        /* Bio */
        .ap-bio {
            font-size: 1rem;
            color: var(--text-secondary);
            line-height: 1.9;
            font-weight: 300;
        }

        /* Skills pills */
        .ap-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ap-skill {
            padding: 7px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-secondary);
            letter-spacing: 0.05em;
            border-radius: 2px;
            transition: border-color 0.2s, color 0.2s, background 0.2s;
        }

        .ap-skill:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
        }

        /* Social links */
        .ap-socials {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .ap-social-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: all 0.22s;
            font-family: 'Jost', sans-serif;
        }

        .ap-social-btn:hover {
            border-color: var(--gold);
            color: var(--gold);
            background: var(--gold-bg);
            transform: translateY(-1px);
        }

        .ap-social-btn.is-portfolio {
            background: var(--gold-bg);
            border-color: var(--gold);
            color: var(--gold);
        }

        .ap-social-btn.is-portfolio:hover {
            background: var(--gold);
            color: #fff;
        }

        /* ── Portfolio Grid ── */
        .ap-portfolio-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3px;
        }

        .ap-portfolio-item {
            aspect-ratio: 1;
            overflow: hidden;
            background: var(--bg-secondary);
            cursor: pointer;
            position: relative;
        }

        .ap-portfolio-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .ap-portfolio-item:hover img {
            transform: scale(1.08);
        }

        .ap-portfolio-overlay {
            position: absolute;
            inset: 0;
            background: rgba(10, 8, 4, 0.55);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .ap-portfolio-item:hover .ap-portfolio-overlay {
            opacity: 1;
        }

        .ap-portfolio-overlay svg {
            color: #fff;
        }

        .ap-portfolio-overlay span {
            font-size: 0.6rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.8);
        }

        .ap-portfolio-empty {
            grid-column: 1 / -1;
            padding: 60px 20px;
            text-align: center;
            border: 1.5px dashed var(--border-strong);
            background: var(--bg-primary);
        }

        .ap-portfolio-empty-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.4rem;
            font-weight: 300;
            color: var(--text-muted);
            margin-top: 16px;
        }

        /* ── Sidebar ── */
        .ap-sidebar {}

        .ap-sidebar-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 24px;
            margin-bottom: 16px;
            position: sticky;
            top: calc(var(--nav-h) + 36px + 20px);
            transition: background 0.4s;
        }

        .ap-sidebar-card:not(:first-child) {
            position: static;
        }

        .ap-sidebar-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        /* Rate display */
        .ap-rate-display {
            text-align: center;
            padding: 16px 0 20px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 20px;
        }

        .ap-rate-num {
            font-family: 'Jost', sans-serif;
            font-size: 2.4rem;
            font-weight: 500;
            color: var(--text-primary);
            line-height: 1;
        }

        .ap-rate-unit {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Attributes */
        .ap-attr {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
        }

        .ap-attr:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .ap-attr-key {
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            color: var(--text-muted);
        }

        .ap-attr-val {
            font-family: 'Jost', sans-serif;
            font-size: 1.05rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Contact reveal box */
        .ap-contact-box {
            background: var(--gold-bg);
            border: 1px solid var(--border-strong);
            padding: 20px;
            text-align: center;
            border-radius: 2px;
        }

        .ap-contact-box-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 8px;
        }

        .ap-contact-phone {
            font-family: 'Jost', sans-serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .ap-contact-email {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-top: 4px;
            word-break: break-all;
        }

        /* ── Lightbox ── */
        .ap-lightbox {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: rgba(4, 3, 2, 0.97);
            backdrop-filter: blur(8px);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s, visibility 0.3s;
        }

        .ap-lightbox.is-open {
            opacity: 1;
            visibility: visible;
        }

        .ap-lightbox-img {
            max-width: 88vw;
            max-height: 88vh;
            object-fit: contain;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transform: scale(0.96);
            transition: transform 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .ap-lightbox.is-open .ap-lightbox-img {
            transform: scale(1);
        }

        .ap-lightbox-close {
            position: absolute;
            top: 28px;
            right: 32px;
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 50%;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        .ap-lightbox-close:hover {
            background: var(--gold);
            border-color: var(--gold);
            transform: rotate(90deg);
        }

        /* ── Agency Modal ── */
        .ap-modal-overlay {
            position: fixed;
            inset: 0;
            z-index: 99998;
            background: rgba(4, 3, 2, 0.88);
            backdrop-filter: blur(6px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .ap-modal {
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            padding: 48px 40px 40px;
            max-width: 440px;
            width: 100%;
            position: relative;
            text-align: center;
            box-shadow: 0 24px 64px rgba(0, 0, 0, 0.4);
            animation: ap-modal-in 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        @keyframes ap-modal-in {
            from {
                opacity: 0;
                transform: translateY(16px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .ap-modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 36px;
            height: 36px;
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background 0.2s, color 0.2s;
        }

        .ap-modal-close:hover {
            background: var(--bg-secondary);
            color: var(--gold);
        }

        .ap-modal-icon {
            width: 52px;
            height: 52px;
            margin: 0 auto 20px;
            background: var(--gold-bg);
            border: 1px solid var(--border-strong);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
        }

        .ap-modal-title {
            font-family: 'Jost', sans-serif;
            font-size: 2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .ap-modal-desc {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .ap-modal-contact-box {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            padding: 20px;
            margin-bottom: 20px;
            text-align: left;
        }

        .ap-modal-contact-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        .ap-modal-contact-row:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .ap-modal-contact-row a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }

        .ap-modal-contact-row a:hover {
            color: var(--gold);
        }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .ap-body {
                grid-template-columns: 1fr;
            }

            .ap-sidebar-card {
                position: static !important;
            }

            .ap-shell {
                padding: 0 24px 60px;
            }
        }

        @media (max-width: 768px) {
            .ap-hero {
                height: 180px;
            }

            .ap-header {
                grid-template-columns: 1fr;
                text-align: center;
                margin-top: -90px;
            }

            .ap-avatar-ring {
                margin: 0 auto;
            }

            .ap-avatar {
                width: 150px;
                height: 150px;
            }

            .ap-identity {
                text-align: center;
            }

            .ap-name {
                font-size: 2.2rem;
            }

            .ap-tags {
                justify-content: center;
            }

            .ap-meta {
                justify-content: center;
            }

            .ap-actions {
                align-items: center;
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .ap-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .ap-stats .ap-stat:nth-child(even) {
                border-right: none;
            }

            /* Removes border for the 2nd and 4th items */
            .ap-stats .ap-stat:nth-child(3),
            .ap-stats .ap-stat:nth-child(4) {
                border-top: 1px solid var(--border);
            }

            /* Adds top border to the bottom row */
            .ap-portfolio-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .ap-tab {
                padding: 12px 16px;
            }

            .ap-shell {
                padding: 0 16px 60px;
            }

            .ap-id-wrapper {
                justify-content: center;
                /* Centers the ID tag exclusively on mobile */
            }
        }

        @media (max-width: 480px) {
            .ap-portfolio-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Animations */
        @keyframes ap-fade-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .ap-fade-1 {
            animation: ap-fade-up 0.5s ease both;
        }

        .ap-fade-2 {
            animation: ap-fade-up 0.5s 0.1s ease both;
        }

        .ap-fade-3 {
            animation: ap-fade-up 0.5s 0.2s ease both;
        }

        .ap-fade-4 {
            animation: ap-fade-up 0.5s 0.3s ease both;
        }

        .ap-id-wrapper {
            display: flex;
            margin-bottom: 12px;
            /* Adds space between the ID and the Category tags */
        }

        /* Bio Truncation */
        .ap-bio-clamped {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Limit to 3 lines */
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        /* Read More Button */
        .ap-bio-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 14px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--gold);
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
        }

        .ap-bio-btn:hover {
            color: var(--text-primary);
        }

        .ap-bio-btn svg {
            transition: transform 0.3s ease;
        }

        .mobile-only {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-only {
                display: inline-flex;
            }
        }
        /* ── Responsive Table Fixes ── */
        .ap-content, .ap-panel {
            min-width: 0; /* Prevents CSS Grid blowout */
        }

        .ap-table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
        }

        .ap-table-wrapper table {
            width: 100%;
            min-width: 700px; /* Forces the scrollbar on small mobile screens */
        }
        /* ── Table Typography Overrides ── */
        .ap-table-wrapper table {
            font-size: 1rem !important; /* Increases the baseline table size */
        }

        .ap-table-wrapper th {
            font-size: 0.78rem !important; /* Bumps up the uppercase headers (was 0.65rem) */
            letter-spacing: 0.12em !important; /* Slightly reduces spacing to fit the larger text */
        }

        .ap-table-wrapper td {
            font-size: 0.95rem !important; /* Increases standard cell text */
            padding: 16px 20px !important; /* Adds a bit more breathing room for larger text */
        }

        /* Specific fix for smaller notes / sub-text in the table */
        .ap-table-wrapper td[style*="font-size: 0.8rem"] {
            font-size: 0.9rem !important; 
        }

        /* Specific fix for the Won/Nominated badges */
        .ap-table-wrapper td span[style*="font-size: 0.68rem"] {
            font-size: 0.85rem !important;
            padding: 4px 12px !important;
        }
        /* ── Header QR Code ── */
        .ap-header-qr-wrap {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-bottom: 12px;
        }

        .ap-header-qr {
            background: #ffffff;
            padding: 8px;
            border: 1px solid var(--border-strong);
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .ap-header-qr:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            border-color: var(--gold);
        }

        .ap-qr-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            border-radius: 4px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.15);
            z-index: 50;
            width: 150px;
            overflow: hidden;
        }

        .ap-qr-dl-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: var(--text-primary);
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            transition: background 0.2s, color 0.2s;
            font-family: 'Jost', sans-serif;
        }

        .ap-qr-dl-link:last-child {
            border-bottom: none;
        }

        .ap-qr-dl-link:hover {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .ap-qr-dl-link strong {
            font-weight: 600;
        }

        /* Ensure the QR code scales perfectly */
        .ap-header-qr svg {
            width: 120px !important;
            height: 120px !important;
        }

        /* Shrink it slightly for mobile screens */
        @media (max-width: 768px) {
            .ap-header-qr svg {
                width: 80px !important;
                height: 80px !important;
            }
        }
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .ap-header-qr-wrap {
                align-items: center; /* Centers the QR code on mobile */
                margin-bottom: 16px;
                width: 100%;
            }
            .ap-qr-dropdown {
                right: auto; /* Centers the dropdown on mobile */
            }
        }
    </style>

    {{-- ══════════════════════════════════════════
    HERO BANNER
    ══════════════════════════════════════════ --}}
    <div class="ap-hero">
        <div class="ap-hero-pattern"></div>
        <div class="ap-hero-gradient"></div>
        <div class="ap-hero-bottom-fade"></div>
    </div>

    <div class="ap-shell">

        {{-- ══════════════════════════════════════════
        PROFILE HEADER
        ══════════════════════════════════════════ --}}
        <div class="ap-header ap-fade-1">

            {{-- Avatar --}}
            <div class="ap-avatar-ring">
                <div class="ap-avatar">
                    @if($artist->hasMedia('avatar'))
                        <img src="{{ $artist->getFirstMediaUrl('avatar') }}" alt="{{ $artist->name }}">
                    @elseif($artist->hasMedia('portfolio'))
                        <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}">
                    @else
                        <div class="ap-avatar-placeholder">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="0.8">
                                <circle cx="12" cy="8" r="4" />
                                <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="ap-verified-ring" title="Identity Verified">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                        <path
                            d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                    </svg>
                </div>
            </div>

            {{-- Identity --}}
            <div class="ap-identity">
                <h1 class="ap-name">{{ $artist->name }}</h1>

                {{-- 1. NEW: Standalone ID Wrapper (Placed immediately under the name) --}}
                @if($artist->member_id)
                    <div class="ap-id-wrapper">
                        <span class="ap-tag"
                            style="color: var(--text-primary); background: var(--bg-secondary); border-color: var(--border-strong);">
                            ID: {{ $artist->member_id }}
                        </span>
                        <span class="ap-tag-verified">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                            </svg>
                            Verified
                        </span>
                    </div>
                @endif

                {{-- 2. Category tags & Verified Badge --}}
                <div class="ap-tags">
                    @if(!empty($artist->profile?->categories))
                        @php
                            // Look up the unique groups for the selected category names
                            $groups = \App\Models\Category::whereIn('name', $artist->profile->categories)
                                ->pluck('group')
                                ->unique()
                                ->toArray();
                        @endphp

                        @foreach(array_slice($groups, 0, 3) as $group)
                            <span class="ap-tag">{{ $group }}</span>
                        @endforeach

                        @if(count($groups) > 3)
                            <span class="ap-tag" style="opacity: 0.6;">+{{ count($groups) - 3 }} more</span>
                        @endif
                    @endif
                </div>

                <div class="ap-meta">
                    @php
                        $location = implode(', ', array_filter([
                            $artist->profile?->upazila,
                            $artist->profile?->district,
                            $artist->profile?->country
                        ]));
                    @endphp
                    @if($location)
                        <div class="ap-meta-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                <circle cx="12" cy="9" r="2.5" />
                            </svg>
                            {{ $location }}
                        </div>
                    @endif

                    @if($artist->profile?->hourly_rate)
                        <div class="ap-meta-dot"></div>
                        <div class="ap-meta-item">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M9 8h6M9 12h6M9 16h4" />
                            </svg>
                            From ৳{{ number_format($artist->profile->hourly_rate) }}/hr
                        </div>
                    @endif

                </div>
            </div>

            {{-- Actions & QR Code --}}
            <div class="ap-actions">
                
                {{-- ── NEW: Clickable QR Code ── --}}
                <div class="ap-header-qr-wrap" x-data="{ openQrMenu: false }">
                    <div class="ap-header-qr" 
                         @click="openQrMenu = !openQrMenu" 
                         @click.outside="openQrMenu = false"
                         title="Click to download QR Code">
                        @php
                            $profileUrl = route('artist.show', ['slug' => \Illuminate\Support\Str::slug($artist->name) . '-' . $artist->id]);
                        @endphp
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(120)->margin(0)->generate($profileUrl) !!}
                    </div>

                    {{-- Dropdown Menu (Hidden by default) --}}
                    <div class="ap-qr-dropdown" 
                         x-show="openQrMenu" 
                         x-transition.opacity.duration.200ms
                         style="display: none;" 
                         :style="openQrMenu ? 'display: block;' : 'display: none;'">
                        
                        <a href="{{ route('artist.qr.download', ['id' => $artist->id, 'format' => 'svg']) }}" class="ap-qr-dl-link">
                            <strong>SVG</strong>
                            <span style="color: var(--text-muted); font-size: 0.65rem;">(Print)</span>
                        </a>
                        <a href="{{ route('artist.qr.download', ['id' => $artist->id, 'format' => 'png']) }}" class="ap-qr-dl-link">
                            <strong>PNG</strong>
                            <span style="color: var(--text-muted); font-size: 0.65rem;">(Web)</span>
                        </a>
                    </div>
                </div>

                {{-- Original Action Buttons --}}
                @auth
                    @if(auth()->id() === $artist->id)
                        <a href="{{ route('account.dashboard') }}" class="btn-outline" style="font-size: 0.78rem;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7" />
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                            Edit Profile
                        </a>
                    @endif
                @endauth

                @if(auth()->check() && (auth()->id() === $artist->id || auth()->user()->hasRole('Super-Admin')))
                    <a href="{{ route('photocard.download', $artist) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                        {{-- heroicon: identification --}}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0M9 14h6"/>
                        </svg>
                        Download Photocard
                    </a>
                @endif
                
                @if(!auth()->check() || auth()->id() !== $artist->id)
                    <button wire:click="revealContact" class="btn-fill mobile-only"
                        style="font-size: 0.78rem; min-width: 160px; justify-content: center;">

                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            style="margin-right: 4px;">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                        </svg>

                        Contact Talent
                    </button>
                @endif
            </div>
        </div>

        {{-- ══════════════════════════════════════════
        STATS STRIP
        ══════════════════════════════════════════ --}}
        <div class="ap-stats ap-fade-2">
            <div class="ap-stat">
                <div class="ap-stat-num">
                    {{ $artist->getMedia('portfolio')->count() }}<span>+</span>
                </div>
                <div class="ap-stat-label">Portfolio Photos</div>
            </div>
            <div class="ap-stat">
                <div class="ap-stat-num">
                    @if($artist->profile?->hourly_rate)
                        ৳{{ number_format($artist->profile->hourly_rate) }}
                    @else
                        <span style="font-size: 1.4rem; color: var(--gold);">Negotiable</span>
                    @endif
                </div>
                <div class="ap-stat-label">Starting Rate / hr</div>
            </div>
            <div class="ap-stat">
                <div class="ap-stat-num">
                    @if($artist->profile?->date_of_birth)
                        {{ \Carbon\Carbon::parse($artist->profile->date_of_birth)->age }}<span>yr</span>
                    @else
                        <span style="font-size: 1.2rem; color: var(--text-muted);">—</span>
                    @endif
                </div>
                <div class="ap-stat-label">Age</div>
            </div>
            <div class="ap-stat">
                <div class="ap-stat-num">
                    {{ $artist->profile?->experience_level ?? '—' }}
                </div>
                <div class="ap-stat-label">Experience</div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════
        TAB NAVIGATION
        ══════════════════════════════════════════ --}}
        <div class="ap-tabs ap-fade-3">
            <button class="ap-tab" :class="activeTab === 'about' ? 'is-active' : ''" @click="activeTab = 'about'">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
                </svg>
                About
            </button>

            <button class="ap-tab" :class="activeTab === 'portfolio' ? 'is-active' : ''"
                @click="activeTab = 'portfolio'">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="1" />
                    <circle cx="8.5" cy="8.5" r="1.5" />
                    <path d="M21 15l-5-5L5 21" />
                </svg>
                Portfolio
                <span class="ap-tab-count">{{ $artist->getMedia('portfolio')->count() }}</span>
            </button>

            <button class="ap-tab" :class="activeTab === 'skills' ? 'is-active' : ''" @click="activeTab = 'skills'">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
                Experience
                <span class="ap-tab-count">{{ $artist->experiences->count() }}</span>
            </button>
        </div>

        {{-- ══════════════════════════════════════════
        MAIN BODY
        ══════════════════════════════════════════ --}}
        <div class="ap-body ap-fade-4">

            {{-- ── Left: Tab Content ── --}}
            <div class="ap-content">

                {{-- TAB: ABOUT ── --}}
                <div class="ap-panel" :class="activeTab === 'about' ? 'is-active' : ''">

                    <div class="ap-card" x-data="{ expanded: false, isOverflowing: false }"
                        x-init="$nextTick(() => { isOverflowing = $refs.bio.scrollHeight > $refs.bio.clientHeight })">

                        <div class="ap-card-head">
                            <div class="ap-card-head-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                            </div>
                            <div class="ap-card-title">Professional Bio</div>
                        </div>

                        <div class="ap-card-body">
                            {{-- The text container (toggles the clamped class based on state) --}}
                            <div class="ap-bio" x-ref="bio" :class="expanded ? '' : 'ap-bio-clamped'">
                                {!! nl2br(e($artist->profile?->bio ?? 'This talent has not added a professional bio yet.')) !!}
                            </div>

                            {{-- The Button (Only shows if text exceeds 5 lines) --}}
                            <button type="button" class="ap-bio-btn" x-show="isOverflowing"
                                @click="expanded = !expanded" style="display: none;"
                                :style="isOverflowing ? 'display: inline-flex;' : 'display: none;'">
                                <span x-text="expanded ? 'Show Less' : 'Read More'"></span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" :style="expanded ? 'transform: rotate(180deg);' : ''">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                        </div>
                    </div>
                    {{-- Showreel ── --}}
                    @if($artist->profile?->showreel_url)
                        <div class="ap-card">
                            <div class="ap-card-head">
                                <div class="ap-card-head-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <polygon points="23 7 16 12 23 17 23 7" />
                                        <rect x="1" y="5" width="15" height="14" rx="2" />
                                    </svg>
                                </div>
                                <div class="ap-card-title">Showreel / Intro Video</div>
                            </div>
                            <div class="ap-card-body">
                                <a href="{{ $artist->profile->showreel_url }}" target="_blank" class="btn-outline"
                                    style="font-size:0.8rem;">
                                    ▶ Watch on YouTube / Vimeo
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="ap-card">
                        <div class="ap-card-head">
                            <div class="ap-card-head-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div class="ap-card-title">Skills & Expertise</div>
                        </div>
                        <div class="ap-card-body">
                            @if(!empty($artist->profile?->categories))
                                <div class="ap-skills">
                                    @foreach($artist->profile->categories as $category)
                                        <span class="ap-skill">{{ $category }}</span>
                                    @endforeach
                                </div>
                            @else
                                <p style="color: var(--text-muted); font-size: 0.9rem;">No skills listed yet.</p>
                            @endif
                        </div>
                    </div>
                    {{-- Special Skills ── --}}
                    @if(!empty($artist->profile?->special_skills))
                        <div class="ap-card">
                            <div class="ap-card-head">
                                <div class="ap-card-head-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" />
                                    </svg>
                                </div>
                                <div class="ap-card-title">Special Skills</div>
                            </div>
                            <div class="ap-card-body">
                                <div class="ap-skills">
                                    @foreach($artist->profile->special_skills as $skill)
                                        <span class="ap-skill">{{ $skill }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="ap-card">
                        <div class="ap-card-head">
                            <div class="ap-card-head-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                                    <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                                </svg>
                            </div>
                            <div class="ap-card-title">Social Media & Links</div>
                        </div>

                        <div class="ap-card-body">
                            <div class="ap-socials">

                                {{-- 🛡️ SECURITY LOGIC: Check if user is Admin or the Profile Owner --}}
                                @php
                                    $canAccessLinks = auth()->check() && (auth()->id() === $artist->id || auth()->user()->hasRole('Super-Admin'));

                                    // Dynamic attributes based on access
                                    $linkAttributes = $canAccessLinks
                                        ? 'target="_blank" rel="noopener noreferrer"'
                                        : 'wire:click.prevent="revealContact" title="Private link. Contact agency to book." style="cursor: pointer;"';
                                @endphp

                                @if($artist->profile?->facebook_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->facebook_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                                        </svg>
                                        Facebook
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif

                                        @if($artist->profile->facebook_followers)
                                            <span style="font-size:0.7rem; opacity:0.7;">·
                                                {{ number_format($artist->profile->facebook_followers) }}</span>
                                        @endif
                                    </a>
                                @endif

                                @if($artist->profile?->instagram_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->instagram_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <rect x="2" y="2" width="20" height="20" rx="5" />
                                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                        </svg>
                                        Instagram
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif

                                        @if($artist->profile->instagram_followers)
                                            <span style="font-size:0.7rem; opacity:0.7;">·
                                                {{ number_format($artist->profile->instagram_followers) }}</span>
                                        @endif
                                    </a>
                                @endif

                                @if($artist->profile?->youtube_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->youtube_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white" />
                                        </svg>
                                        YouTube
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif

                                        @if($artist->profile->youtube_followers)
                                            <span style="font-size:0.7rem; opacity:0.7;">·
                                                {{ number_format($artist->profile->youtube_followers) }}</span>
                                        @endif
                                    </a>
                                @endif

                                @if($artist->profile?->tiktok_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->tiktok_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.34 6.34 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.17 8.17 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z" />
                                        </svg>
                                        TikTok
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif

                                        @if($artist->profile->tiktok_followers)
                                            <span style="font-size:0.7rem; opacity:0.7;">·
                                                {{ number_format($artist->profile->tiktok_followers) }}</span>
                                        @endif
                                    </a>
                                @endif

                                @if($artist->profile?->linkedin_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->linkedin_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                        LinkedIn
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif

                                        @if($artist->profile->linkedin_followers)
                                            <span style="font-size:0.7rem; opacity:0.7;">·
                                                {{ number_format($artist->profile->linkedin_followers) }}</span>
                                        @endif
                                    </a>
                                @endif

                                @if($artist->profile?->portfolio_url)
                                    <a {!! $canAccessLinks ? 'href="' . $artist->profile->portfolio_url . '"' : '' !!} {!! $linkAttributes !!} class="ap-social-btn is-portfolio">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                                            <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                                        </svg>
                                        View Portfolio
                                        @if(!$canAccessLinks) <svg width="10" height="10" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;">
                                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                            <path d="M7 11V7a5 5 0 0110 0v4"></path>
                                        </svg> @endif
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>

                {{-- TAB: PORTFOLIO ── --}}
                <div class="ap-panel" :class="activeTab === 'portfolio' ? 'is-active' : ''">

                    <div class="ap-card">
                        <div class="ap-card-head">
                            <div class="ap-card-head-icon">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="18" height="18" rx="1" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                            </div>
                            <div class="ap-card-title">Portfolio Gallery</div>
                        </div>
                        
                        <div class="ap-card-body" style="padding: 3px;">
                            @if($artist->hasMedia('portfolio'))
                            
                                {{-- 1. Bulletproof Inline Alpine Component for Livewire --}}
                                {{-- 1. Bulletproof Inline Alpine Component for Livewire --}}
                                <div class="ap-portfolio-grid" 
                                    x-data="{
                                        isOpen: false,
                                        currentIndex: 0,
                                        images: @js($artist->getMedia('portfolio')->map(fn($m) => $m->getUrl())->values()),
                                        touchStartX: 0,
                                        touchEndX: 0,
                                        openGallery(index) {
                                            this.currentIndex = index;
                                            this.isOpen = true;
                                            document.body.style.overflow = 'hidden';
                                        },
                                        closeGallery() {
                                            this.isOpen = false;
                                            document.body.style.overflow = '';
                                        },
                                        next() {
                                            if (this.isOpen && this.currentIndex < this.images.length - 1) this.currentIndex++;
                                        },
                                        prev() {
                                            if (this.isOpen && this.currentIndex > 0) this.currentIndex--;
                                        },
                                        handleSwipe() {
                                            if (!this.isOpen) return;
                                            if (this.touchEndX < this.touchStartX - 50) this.next();
                                            if (this.touchEndX > this.touchStartX + 50) this.prev();
                                        }
                                    }"
                                    @keydown.window.escape="closeGallery()"
                                    @keydown.window.right="next()"
                                    @keydown.window.left="prev()"
                                >
                                    {{-- 2. Render the thumbnails --}}
                                    @foreach($artist->getMedia('portfolio') as $media)
                                        <div class="ap-portfolio-item" 
                                            @click="openGallery({{ $loop->index }})"
                                            style="cursor: pointer;">
                                            <img src="{{ $media->getUrl() }}" alt="Portfolio image" loading="lazy">
                                            <div class="ap-portfolio-overlay">
                                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" />
                                                </svg>
                                                <span>View</span>
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- 3. The Fullscreen Lightbox Overlay --}}
                                    <template x-teleport="body">
                                        <div x-show="isOpen" 
                                            x-transition.opacity.duration.300ms
                                            style="position: fixed; inset: 0; z-index: 99999; background: rgba(0,0,0,0.95);"
                                            @touchstart="touchStartX = $event.changedTouches[0].screenX"
                                            @touchend="touchEndX = $event.changedTouches[0].screenX; handleSwipe()"
                                            style="display: none;">
                                            
                                            {{-- Perfect Centering Wrapper --}}
                                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; position: relative;">
                                                
                                                {{-- Close Button --}}
                                                <button @click="closeGallery()" style="position: absolute; top: 20px; right: 20px; color: white; background: rgba(255,255,255,0.1); border: none; border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10001; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                </button>

                                                {{-- Prev Button --}}
                                                <button x-show="currentIndex > 0" @click.stop="prev()" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: white; background: rgba(255,255,255,0.1); border: none; border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10001; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
                                                </button>

                                                {{-- The Image --}}
                                                <img :src="images[currentIndex]" 
                                                    @click.stop
                                                    style="max-width: 90vw; max-height: 85vh; width: auto; height: auto; object-fit: contain; border-radius: 4px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.5); display: block; margin: auto;">

                                                {{-- Next Button --}}
                                                <button x-show="currentIndex < images.length - 1" @click.stop="next()" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: white; background: rgba(255,255,255,0.1); border: none; border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10001; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                                </button>

                                                {{-- Counter --}}
                                                <div style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: white; font-size: 0.9rem; font-weight: 500; background: rgba(0,0,0,0.5); padding: 4px 12px; border-radius: 999px;">
                                                    <span x-text="currentIndex + 1"></span> / <span x-text="images.length"></span>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </template>
                                </div>
                            @else
                                <div class="ap-portfolio-grid" style="padding: 24px;">
                                    <div class="ap-portfolio-empty">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" style="margin: 0 auto; opacity: 0.25;">
                                            <rect x="3" y="3" width="18" height="18" rx="1" />
                                            <circle cx="8.5" cy="8.5" r="1.5" />
                                            <path d="M21 15l-5-5L5 21" />
                                        </svg>
                                        <div class="ap-portfolio-empty-title">No portfolio images yet</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- TAB: SKILLS / EXPERIENCE ── --}}
                <div class="ap-panel" :class="activeTab === 'skills' ? 'is-active' : ''">

                    @php
                        $groupedExp = $artist->experiences->groupBy('type');

                        // ✅ Fixed: matches actual saved type values from ArtistAccount.php
                        $expTypeLabels = [
                            'acting_screen'          => 'Acting & Screen',
                            'modeling_fashion'       => 'Modeling & Fashion',
                            'photography_media'      => 'Photography & Media',
                            'advertising_promotion'  => 'Advertising & Promotion',
                            'event_hosting'          => 'Events & Hosting',
                            'digital_content'        => 'Digital Content',
                            'competitions_pageants'  => 'Competitions & Pageants',
                            'awards_achievements'    => 'Awards & Achievements',
                            'workshop_training'      => 'Workshops & Training',
                            'other'                  => 'Other Credits',
                            'custom'                 => 'Other',
                        ];

                        // Types that use the award-style table (have award_category, award_result etc.)
                        $awardStyleTypes = ['awards_achievements', 'competitions_pageants'];
                    @endphp

                    @if($groupedExp->isEmpty())
                        <div class="ap-card">
                            <div class="ap-card-body">
                                <p style="color: var(--text-muted); font-size: 1.2rem;">No credits added yet.</p>
                            </div>
                        </div>
                    @else
                        @foreach($groupedExp as $type => $entries)
                            <div class="ap-card" style="margin-bottom: 20px;">
                                <div class="ap-card-head">
                                    <div class="ap-card-head-icon">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" />
                                        </svg>
                                    </div>
                                    {{-- ✅ Fixed: 'custom' shows the custom_type_label from first entry --}}
                                    <div class="ap-card-title">
                                        @if($type === 'custom')
                                            {{ $entries->first()->custom_type_label ?? 'Other' }}
                                        @else
                                            {{ $expTypeLabels[$type] ?? ucwords(str_replace('_', ' ', $type)) }}
                                        @endif
                                    </div>
                                </div>

                                <div class="ap-card-body" style="padding: 0;">

                                    {{-- ✅ Fixed: awards_achievements AND competitions_pageants use award-style table --}}
                                    @if(in_array($type, $awardStyleTypes))
                                        <div class="ap-table-wrapper">
                                            <table style="border-collapse: collapse; font-size: 0.88rem; width: 100%;">
                                                <thead>
                                                    <tr style="border-bottom: 1px solid var(--border); background: var(--bg-primary);">
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Year</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Title</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Category</th>
                                                        @if($type === 'awards_achievements')
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">For Work</th>
                                                        @endif
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Result</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Organizer</th>
                                                        @if($type === 'competitions_pageants')
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Location</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($entries as $exp)
                                                        <tr style="border-bottom: 1px solid var(--border);">
                                                            <td style="padding:12px 20px; color:var(--text-muted);">{{ $exp->year ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-primary); font-weight:500;">{{ $exp->title }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->award_category ?? '—' }}</td>
                                                            @if($type === 'awards_achievements')
                                                            <td style="padding:12px 20px; color:var(--text-secondary); font-style:italic;">{{ $exp->award_work ?? '—' }}</td>
                                                            @endif
                                                            <td style="padding:12px 20px;">
                                                                @if($exp->award_result)
                                                                    <span style="font-size:0.85rem; font-weight:700; padding:3px 10px; border-radius:999px;
                                                                        {{ $exp->award_result === 'Won' || $exp->award_result === 'Winner'
                                                                            ? 'background:rgba(22,163,74,0.1); color:#16a34a; border:1px solid rgba(22,163,74,0.3);'
                                                                            : 'background:rgba(234,179,8,0.1); color:#ca8a04; border:1px solid rgba(234,179,8,0.3);' }}">
                                                                        {{ $exp->award_result }}
                                                                    </span>
                                                                @else
                                                                    —
                                                                @endif
                                                            </td>
                                                            <td style="padding:12px 20px; color:var(--text-muted); font-size:1rem;">{{ $exp->award_organizer ?? '—' }}</td>
                                                            @if($type === 'competitions_pageants')
                                                            <td style="padding:12px 20px; color:var(--text-muted); font-size:1rem;">{{ $exp->jury_location ?? '—' }}</td>
                                                            @endif
                                                        </tr>
                                                        @if($exp->description)
                                                            <tr style="border-bottom:1px solid var(--border); background:rgba(0,0,0,0.02);">
                                                                <td colspan="{{ $type === 'awards_achievements' ? 6 : 6 }}"
                                                                    style="padding:8px 20px 16px; color:var(--text-secondary); font-size:1rem; line-height:1.6;">
                                                                    {{ $exp->description }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    {{-- Workshop/Training: simple pill list --}}
                                    @elseif($type === 'workshop_training')
                                        <div style="padding: 16px 20px;">
                                            @foreach($entries as $exp)
                                                <div style="padding:10px 0; border-bottom:1px solid var(--border); display:flex; gap:12px; align-items:flex-start;">
                                                    @if($exp->year)
                                                        <span style="font-size:1rem; color:var(--gold); font-weight:700; background:var(--gold-bg); padding:2px 8px; border-radius:2px; flex-shrink:0; margin-top:2px;">
                                                            {{ $exp->year }}
                                                        </span>
                                                    @endif
                                                    <div>
                                                        <span style="font-weight:600; color:var(--text-primary);">{{ $exp->title }}</span>
                                                        @if($exp->award_organizer)
                                                            <span style="color:var(--text-muted); font-size:1rem;"> · {{ $exp->award_organizer }}</span>
                                                        @endif
                                                        @if($exp->jury_location)
                                                            <span style="color:var(--text-muted); font-size:1rem;"> · {{ $exp->jury_location }}</span>
                                                        @endif
                                                        @if($exp->description)
                                                            <div style="font-size:1rem; color:var(--text-muted); margin-top:4px; font-style:italic;">
                                                                {{ $exp->description }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    {{-- ✅ Default: all other types (acting_screen, modeling_fashion, etc.) --}}
                                    @else
                                        <div class="ap-table-wrapper">
                                            <table style="border-collapse: collapse; font-size: 0.88rem; width: 100%;">
                                                <thead>
                                                    <tr style="border-bottom:1px solid var(--border); background:var(--bg-primary);">
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Year</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Title</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Role</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Director</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Production</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Language</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Platform</th>
                                                        <th style="text-align:left; padding:10px 20px; color:var(--text-muted); font-size:0.85rem; letter-spacing:0.15em; text-transform:uppercase;">Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($entries as $exp)
                                                        <tr style="border-bottom:1px solid var(--border);">
                                                            <td style="padding:12px 20px; color:var(--text-muted);">{{ $exp->year ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-primary); font-weight:500;">{{ $exp->title }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->role ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->director ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->production ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->language ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-secondary);">{{ $exp->platform ?? '—' }}</td>
                                                            <td style="padding:12px 20px; color:var(--text-muted); font-size:1rem; font-style:italic;">{{ $exp->notes ?? '' }}</td>
                                                        </tr>
                                                        @if($exp->description)
                                                            <tr style="border-bottom:1px solid var(--border); background:rgba(0,0,0,0.02);">
                                                                <td colspan="8" style="padding:8px 20px 16px; color:var(--text-secondary); font-size:1rem; line-height:1.6;">
                                                                    {{ $exp->description }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

            </div>

            {{-- ── Right: Sidebar ── --}}
            <div class="ap-sidebar">

                {{-- Hire / Contact Card ── --}}
                <div class="ap-sidebar-card">
                    <div class="ap-sidebar-label">Hire This Talent</div>

                    @if($artist->profile?->hourly_rate)
                        <div class="ap-rate-display">
                            <div class="ap-rate-num">৳{{ number_format($artist->profile->hourly_rate) }}</div>
                            <div class="ap-rate-unit">Starting Rate per Hour</div>
                        </div>
                    @else
                        <div class="ap-rate-display">
                            <div class="ap-rate-num" style="font-size: 1.6rem; color: var(--text-muted);">Negotiable</div>
                            <div class="ap-rate-unit">Rate upon request</div>
                        </div>
                    @endif

                    @if($showContact)
                        <div class="ap-contact-box">
                            <div class="ap-contact-box-label">Private Contact Info</div>
                            <div class="ap-contact-phone">{{ $artist->phone ?? 'Not provided' }}</div>
                            <div class="ap-contact-email">{{ $artist->email }}</div>
                            <div
                                style="font-size: 0.65rem; color: #dc2626; margin-top: 10px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.1em;">
                                Admin View Only
                            </div>
                        </div>
                    @else
                        <button wire:click="revealContact" class="btn-fill"
                            style="width: 100%; justify-content: center; font-size: 0.8rem; padding: 12px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="margin-right: 6px;">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                            </svg>
                            Contact Talent
                        </button>
                        @guest
                            <p
                                style="font-size: 0.78rem; color: var(--text-muted); text-align: center; margin-top: 10px; line-height: 1.5;">
                                Contact handled through the agency to protect talent privacy.
                            </p>
                        @endguest
                    @endif
                </div>

                {{-- Personal Details Card ── --}}
                @if($artist->profile?->gender || $artist->profile?->date_of_birth || $artist->profile?->height_cm || !empty($artist->profile?->languages))
                    <div class="ap-sidebar-card">
                        <div class="ap-sidebar-label">Personal Details</div>
                        <div>
                            @if($artist->profile?->gender)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Gender</span>
                                    <span class="ap-attr-val">{{ $artist->profile->gender }}</span>
                                </div>
                            @endif

                            @if($artist->profile?->date_of_birth)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Age</span>
                                    <span class="ap-attr-val">{{ \Carbon\Carbon::parse($artist->profile->date_of_birth)->age }}
                                        Years</span>
                                </div>
                            @endif

                            @if($artist->profile?->height_cm)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Height</span>
                                    <span class="ap-attr-val">{{ $artist->profile->height_cm }} ft</span>
                                </div>
                            @endif

                            @if($artist->profile?->weight_kg)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Weight</span>
                                    <span class="ap-attr-val">{{ $artist->profile->weight_kg }} kg</span>
                                </div>
                            @endif

                            @if($artist->profile?->chest_bust_inches)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Chest / Bust</span>
                                    <span class="ap-attr-val">{{ $artist->profile->chest_bust_inches }}"</span>
                                </div>
                            @endif

                            @if($artist->profile?->waist_inches)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Waist</span>
                                    <span class="ap-attr-val">{{ $artist->profile->waist_inches }}"</span>
                                </div>
                            @endif

                            @if($artist->profile?->hips_inches)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Hips</span>
                                    <span class="ap-attr-val">{{ $artist->profile->hips_inches }}"</span>
                                </div>
                            @endif

                            @if($artist->profile?->skin_tone)
                                @php
                                    $skinHex = match($artist->profile->skin_tone) {
                                        'Fair' => '#FCE3CD', 'Light' => '#EED3BB', 'Wheatish' => '#E2B88F', 'Dusky' => '#C29587', 'Deep' => '#7C4D31', default => null
                                    };
                                @endphp
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Skin Tone</span>
                                    <span class="ap-attr-val" style="display: inline-flex; align-items: center; gap: 6px;">
                                        @if($skinHex)
                                            <span style="width: 14px; height: 14px; border-radius: 4px; background-color: {{ $skinHex }}; border: 1px solid rgba(0,0,0,0.15);"></span>
                                        @endif
                                        {{ $artist->profile->skin_tone }}
                                    </span>
                                </div>
                            @endif

                            @if($artist->profile?->eye_color)
                                @php
                                    $eyeHex = match($artist->profile->eye_color) {
                                        'Brown' => '#5c3817', 'Blue' => '#4f7b98', 'Green' => '#607228', 'Greenish Blue' => '#588383', 'Yellowish Green' => '#728224', 'Amber' => '#8f7422', 'Hazel' => '#986121', 'Deep Blue' => '#274f68', 'Dark Green' => '#3c561b', 'Freckled Hazel' => '#704e22', 'Greyish Blue' => '#6e7e85', 'Forest Green' => '#465521', 'Dark Hazel' => '#593c15', 'Grey' => '#727a7c', 'Spring Green' => '#6d7d24', default => null
                                    };
                                @endphp
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Eye Color</span>
                                    <span class="ap-attr-val" style="display: inline-flex; align-items: center; gap: 6px;">
                                        @if($eyeHex)
                                            {{-- Eye colors use border-radius: 50% for a circle --}}
                                            <span style="width: 14px; height: 14px; border-radius: 50%; background-color: {{ $eyeHex }}; border: 1px solid rgba(0,0,0,0.15);"></span>
                                        @endif
                                        {{ $artist->profile->eye_color }}
                                    </span>
                                </div>
                            @endif

                            @if($artist->profile?->hair_color)
                                @php
                                    $hairHex = match($artist->profile->hair_color) {
                                        'Black' => '#111111', 'Brown Black' => '#221612', 'Darkest Brown' => '#342015', 'Dark Brown' => '#46291b', 'Medium Brown' => '#5e3a26', 'Light Brown' => '#805338', 'Dark Blonde' => '#b08868', 'Medium Blonde' => '#d1a77e', 'Light Blonde' => '#e4c7a7', default => null
                                    };
                                @endphp
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Hair</span>
                                    <span class="ap-attr-val" style="display: inline-flex; align-items: center; gap: 6px;">
                                        @if($hairHex)
                                            <span style="width: 14px; height: 14px; border-radius: 4px; background-color: {{ $hairHex }}; border: 1px solid rgba(0,0,0,0.15);"></span>
                                        @endif
                                        {{ $artist->profile->hair_color }}{{ $artist->profile->hair_length ? ' · ' . $artist->profile->hair_length : '' }}
                                    </span>
                                </div>
                            @endif

                            @if($artist->profile?->shoe_size)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Shoe Size</span>
                                    <span class="ap-attr-val">{{ $artist->profile->shoe_size }}</span>
                                </div>
                            @endif

                            @if($artist->profile?->dress_size)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Dress Size</span>
                                    <span class="ap-attr-val">{{ $artist->profile->dress_size }}</span>
                                </div>
                            @endif

                            @if($artist->profile?->availability)
                                <div class="ap-attr">
                                    <span class="ap-attr-key">Availability</span>
                                    <span class="ap-attr-val">{{ $artist->profile->availability }}</span>
                                </div>
                            @endif

                            <div class="ap-attr">
                                <span class="ap-attr-key">Travel</span>
                                <span class="ap-attr-val"
                                    style="color: {{ $artist->profile?->willing_to_travel ? '#16a34a' : 'var(--text-muted)' }}">
                                    {{ $artist->profile?->willing_to_travel ? 'Yes' : 'No' }}
                                </span>
                            </div>
                            @if(!empty($artist->profile?->languages))
                                <div class="ap-attr" style="align-items: flex-start;">
                                    <span class="ap-attr-key" style="padding-top: 3px;">Languages</span>
                                    <span class="ap-attr-val" style="text-align: right; line-height: 1.5; font-size: 0.95rem;">
                                        {{ implode(', ', (array) $artist->profile->languages) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Edit Profile Shortcut (own profile) ── --}}
                @auth
                    @if(auth()->id() === $artist->id)
                        <div class="ap-sidebar-card" style="text-align: center; border-style: dashed;">
                            <p style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 14px; line-height: 1.6;">
                                This is your public profile. Keep it updated to attract more clients.
                            </p>
                            <a href="{{ route('account.dashboard') }}" class="btn-outline"
                                style="font-size: 0.78rem; width: 100%; justify-content: center;">
                                Edit Your Profile
                            </a>
                        </div>
                    @endif
                @endauth

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
    AGENCY CONTACT MODAL
    ══════════════════════════════════════════ --}}
    @if($showAgencyModal)
        <template x-teleport="body">
            <div class="ap-modal-overlay">
                <div class="ap-modal">
                    <button class="ap-modal-close" wire:click="closeAgencyModal">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>

                    <div class="ap-modal-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.7">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                        </svg>
                    </div>

                    <h3 class="ap-modal-title">Book {{ $artist->name }}</h3>
                    <p class="ap-modal-desc"
                        style="font-family: 'SolaimanLipi', sans-serif; font-size: 1.4rem; color: var(--text-secondary); line-height: auto;">
                        গোপনীয়তা এবং পেশাদারিত্ব নিশ্চিত করতে সমস্ত বুকিং আমাদের এজেন্সির মাধ্যমে পরিচালিত হয়। শিডিউল এবং
                        পারিশ্রমিক সম্পর্কে আলোচনা করতে নিচে আমাদের সাথে যোগাযোগ করুন।
                    </p>

                    <div class="ap-modal-contact-box">
                        @if($settings?->contact_phone)
                            <div class="ap-modal-contact-row">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7" style="opacity:0.5; flex-shrink:0;">
                                    <path
                                        d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                                </svg>
                                <a href="tel:{{ $settings->contact_phone }}">{{ $settings->contact_phone }}</a>
                            </div>
                        @endif
                        @if($settings?->contact_email)
                            <div class="ap-modal-contact-row">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7" style="opacity:0.5; flex-shrink:0;">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg>
                                <a href="mailto:{{ $settings->contact_email }}">{{ $settings->contact_email }}</a>
                            </div>
                        @endif
                        @if(!$settings?->contact_phone && !$settings?->contact_email)
                            <div class="ap-modal-contact-row" style="color: var(--text-muted); font-size: 0.85rem;">
                                Please visit our <a href="/contact" style="color: var(--gold);">contact page</a> for details.
                            </div>
                        @endif
                    </div>

                    <button class="btn-outline" wire:click="closeAgencyModal"
                        style="width: 100%; justify-content: center; font-size: 0.8rem;">
                        Close
                    </button>
                </div>
            </div>
        </template>
    @endif

</div>