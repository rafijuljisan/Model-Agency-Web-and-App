<div x-data="{
    activeTab: 'about',
    lightboxOpen: false,
    activeImg: '',
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

/* ── Hero Section ── */
.ap-hero {
    position: relative;
    height: 280px; /* ← Change this from 380px to 280px */
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
    background: linear-gradient(
        135deg,
        rgba(197, 0, 0, 0.08) 0%,
        transparent 50%,
        rgba(197, 0, 0, 0.04) 100%
    );
}
.ap-hero-bottom-fade {
    position: absolute;
    bottom: 0; left: 0; right: 0;
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
    box-shadow: 0 8px 32px rgba(0,0,0,0.15), 0 0 0 1px var(--border-strong);
    transition: box-shadow 0.3s;
}
.ap-avatar img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.ap-avatar:hover img { transform: scale(1.05); }
.ap-avatar-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted);
    background: var(--bg-secondary);
}
.ap-verified-ring {
    position: absolute;
    bottom: 8px; right: 8px;
    width: 36px; height: 36px;
    background: #16a34a;
    border: 3px solid var(--bg-primary);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(22,163,74,0.4);
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
    background: rgba(22,163,74,0.08);
    border: 1px solid rgba(22,163,74,0.3);
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
.ap-meta-item svg { opacity: 0.6; flex-shrink: 0; }
.ap-meta-dot {
    width: 3px; height: 3px;
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
    grid-template-columns: repeat(4, 1fr); /* <-- Changed to 4 columns */
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
.ap-stat:last-child { border-right: none; }
.ap-stat:hover { background: var(--gold-bg); }
.ap-stat-num {
    font-family: 'Jost', sans-serif;
    font-size: 2rem;
    font-weight: 500;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: 4px;
}
.ap-stat-num span { color: var(--gold); }
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
.ap-tabs::-webkit-scrollbar { display: none; }
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
.ap-tab:hover { color: var(--text-primary); }
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
.ap-panel { display: none; }
.ap-panel.is-active { display: block; }

/* ── Content Cards ── */
.ap-card {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 20px;
    transition: background 0.4s, border-color 0.4s;
}
.ap-card:last-child { margin-bottom: 0; }
.ap-card-head {
    padding: 20px 28px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
}
.ap-card-head-icon {
    width: 28px; height: 28px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    display: flex; align-items: center; justify-content: center;
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
.ap-card-body { padding: 28px; }

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
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);
}
.ap-portfolio-item:hover img { transform: scale(1.08); }
.ap-portfolio-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10,8,4,0.55);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s;
}
.ap-portfolio-item:hover .ap-portfolio-overlay { opacity: 1; }
.ap-portfolio-overlay svg { color: #fff; }
.ap-portfolio-overlay span {
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
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
.ap-sidebar-card:not(:first-child) { position: static; }
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
.ap-attr:last-child { border-bottom: none; padding-bottom: 0; }
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
.ap-lightbox.is-open { opacity: 1; visibility: visible; }
.ap-lightbox-img {
    max-width: 88vw;
    max-height: 88vh;
    object-fit: contain;
    box-shadow: 0 32px 80px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.08);
    transform: scale(0.96);
    transition: transform 0.35s cubic-bezier(0.25,0.46,0.45,0.94);
}
.ap-lightbox.is-open .ap-lightbox-img { transform: scale(1); }
.ap-lightbox-close {
    position: absolute;
    top: 28px; right: 32px;
    width: 48px; height: 48px;
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.15);
    border-radius: 50%;
    color: #fff;
    display: flex; align-items: center; justify-content: center;
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
    background: rgba(4,3,2,0.88);
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
    box-shadow: 0 24px 64px rgba(0,0,0,0.4);
    animation: ap-modal-in 0.35s cubic-bezier(0.25,0.46,0.45,0.94);
}
@keyframes ap-modal-in {
    from { opacity: 0; transform: translateY(16px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
.ap-modal-close {
    position: absolute;
    top: 16px; right: 16px;
    width: 36px; height: 36px;
    background: none; border: none;
    color: var(--text-muted);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    transition: background 0.2s, color 0.2s;
}
.ap-modal-close:hover { background: var(--bg-secondary); color: var(--gold); }
.ap-modal-icon {
    width: 52px; height: 52px;
    margin: 0 auto 20px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
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
.ap-modal-contact-row:last-child { border-bottom: none; padding-bottom: 0; }
.ap-modal-contact-row a { color: inherit; text-decoration: none; transition: color 0.2s; }
.ap-modal-contact-row a:hover { color: var(--gold); }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .ap-body { grid-template-columns: 1fr; }
    .ap-sidebar-card { position: static !important; }
    .ap-shell { padding: 0 24px 60px; }
}
@media (max-width: 768px) {
    .ap-hero { height: 180px; }
    .ap-header {
        grid-template-columns: 1fr;
        text-align: center;
        margin-top: -90px;
    }
    .ap-avatar-ring { margin: 0 auto; }
    .ap-avatar { width: 150px; height: 150px; }
    .ap-identity { text-align: center; }
    .ap-name { font-size: 2.2rem; }
    .ap-tags { justify-content: center; }
    .ap-meta { justify-content: center; }
    .ap-actions { align-items: center; flex-direction: row; flex-wrap: wrap; justify-content: center; }
    .ap-stats { grid-template-columns: repeat(2, 1fr); }
    .ap-stats .ap-stat:nth-child(even) { border-right: none; } /* Removes border for the 2nd and 4th items */
    .ap-stats .ap-stat:nth-child(3),
    .ap-stats .ap-stat:nth-child(4) { border-top: 1px solid var(--border); } /* Adds top border to the bottom row */
    .ap-portfolio-grid { grid-template-columns: repeat(2, 1fr); }
    .ap-tab { padding: 12px 16px; }
    .ap-shell { padding: 0 16px 60px; }
    .ap-id-wrapper {
        justify-content: center; /* Centers the ID tag exclusively on mobile */
    }
}
@media (max-width: 480px) {
    .ap-portfolio-grid { grid-template-columns: repeat(2, 1fr); }
}

/* Animations */
@keyframes ap-fade-up {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
.ap-fade-1 { animation: ap-fade-up 0.5s ease both; }
.ap-fade-2 { animation: ap-fade-up 0.5s 0.1s ease both; }
.ap-fade-3 { animation: ap-fade-up 0.5s 0.2s ease both; }
.ap-fade-4 { animation: ap-fade-up 0.5s 0.3s ease both; }
.ap-id-wrapper {
    display: flex;
    margin-bottom: 12px; /* Adds space between the ID and the Category tags */
}
/* Bio Truncation */
.ap-bio-clamped {
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limit to 3 lines */
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
    font-size: 0.75rem;
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
</style>


<div class="ap-hero">
    <div class="ap-hero-pattern"></div>
    <div class="ap-hero-gradient"></div>
    <div class="ap-hero-bottom-fade"></div>
</div>

<div class="ap-shell">

    
    <div class="ap-header ap-fade-1">

        
        <div class="ap-avatar-ring">
            <div class="ap-avatar">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->hasMedia('avatar')): ?>
                    <img src="<?php echo e($artist->getFirstMediaUrl('avatar')); ?>" alt="<?php echo e($artist->name); ?>">
                <?php elseif($artist->hasMedia('portfolio')): ?>
                    <img src="<?php echo e($artist->getFirstMediaUrl('portfolio')); ?>" alt="<?php echo e($artist->name); ?>">
                <?php else: ?>
                    <div class="ap-avatar-placeholder">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8">
                            <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                        </svg>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="ap-verified-ring" title="Identity Verified">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="white">
                    <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                </svg>
            </div>
        </div>

        
        <div class="ap-identity">
            <h1 class="ap-name"><?php echo e($artist->name); ?></h1>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->member_id): ?>
                <div class="ap-id-wrapper">
                    <span class="ap-tag" style="color: var(--text-primary); background: var(--bg-secondary); border-color: var(--border-strong);">
                        ID: <?php echo e($artist->member_id); ?>

                    </span>
                    <span class="ap-tag-verified">
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                        </svg>
                        Verified
                    </span>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="ap-tags">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->categories)): ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_slice($artist->profile->categories, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <span class="ap-tag"><?php echo e($cat); ?></span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($artist->profile->categories) > 3): ?>
                        <span class="ap-tag" style="opacity: 0.6;">+<?php echo e(count($artist->profile->categories) - 3); ?> more</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="ap-meta">
                <?php
                    $location = implode(', ', array_filter([
                        $artist->profile?->upazila,
                        $artist->profile?->district,
                        $artist->profile?->country
                    ]));
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($location): ?>
                    <div class="ap-meta-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                        <?php echo e($location); ?>

                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                    <div class="ap-meta-dot"></div>
                    <div class="ap-meta-item">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><path d="M9 8h6M9 12h6M9 16h4"/>
                        </svg>
                        From ৳<?php echo e(number_format($artist->profile->hourly_rate)); ?>/hr
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </div>

        
        <div class="ap-actions">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->id() === $artist->id): ?>
                    <a href="<?php echo e(route('account.dashboard')); ?>" class="btn-outline" style="font-size: 0.78rem;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit Profile
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->check() || auth()->id() !== $artist->id): ?>
                <button wire:click="revealContact"
                    class="btn-fill mobile-only"
                    style="font-size: 0.78rem; min-width: 160px; justify-content: center;">
                    
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                    </svg>

                    Contact Talent
                </button>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="ap-stats ap-fade-2">
        <div class="ap-stat">
            <div class="ap-stat-num">
                <?php echo e($artist->getMedia('portfolio')->count()); ?><span>+</span>
            </div>
            <div class="ap-stat-label">Portfolio Photos</div>
        </div>
        <div class="ap-stat">
            <div class="ap-stat-num">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                    ৳<?php echo e(number_format($artist->profile->hourly_rate)); ?>

                <?php else: ?>
                    <span style="font-size: 1.4rem; color: var(--gold);">Negotiable</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="ap-stat-label">Starting Rate / hr</div>
        </div>
        <div class="ap-stat">
            <div class="ap-stat-num">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->date_of_birth): ?>
                    <?php echo e(\Carbon\Carbon::parse($artist->profile->date_of_birth)->age); ?><span>yr</span>
                <?php else: ?>
                    <span style="font-size: 1.2rem; color: var(--text-muted);">—</span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="ap-stat-label">Age</div>
        </div>
        <div class="ap-stat">
            <div class="ap-stat-num">
                <?php echo e($artist->profile?->experience_level ?? '—'); ?>

            </div>
            <div class="ap-stat-label">Experience</div>
        </div>
    </div>

    
    <div class="ap-tabs ap-fade-3">
        <button class="ap-tab" :class="activeTab === 'about' ? 'is-active' : ''" @click="activeTab = 'about'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
            </svg>
            About
        </button>

        <button class="ap-tab" :class="activeTab === 'portfolio' ? 'is-active' : ''" @click="activeTab = 'portfolio'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="1"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/>
            </svg>
            Portfolio
            <span class="ap-tab-count"><?php echo e($artist->getMedia('portfolio')->count()); ?></span>
        </button>

        <button class="ap-tab" :class="activeTab === 'skills' ? 'is-active' : ''" @click="activeTab = 'skills'">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
            </svg>
            Experience
            <span class="ap-tab-count"><?php echo e($artist->experiences->count()); ?></span>
        </button>
    </div>

    
    <div class="ap-body ap-fade-4">

        
        <div class="ap-content">

            
            <div class="ap-panel" :class="activeTab === 'about' ? 'is-active' : ''">

                <div class="ap-card" 
                    x-data="{ expanded: false, isOverflowing: false }" 
                    x-init="$nextTick(() => { isOverflowing = $refs.bio.scrollHeight > $refs.bio.clientHeight })">
                    
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
                                <polyline points="14 2 14 8 20 8"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Professional Bio</div>
                    </div>
                    
                    <div class="ap-card-body">
                        
                        <div class="ap-bio" x-ref="bio" :class="expanded ? '' : 'ap-bio-clamped'">
                            <?php echo nl2br(e($artist->profile?->bio ?? 'This talent has not added a professional bio yet.')); ?>

                        </div>
                        
                        
                        <button 
                            type="button"
                            class="ap-bio-btn" 
                            x-show="isOverflowing" 
                            @click="expanded = !expanded" 
                            style="display: none;" 
                            :style="isOverflowing ? 'display: inline-flex;' : 'display: none;'"
                        >
                            <span x-text="expanded ? 'Show Less' : 'Read More'"></span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" 
                                :style="expanded ? 'transform: rotate(180deg);' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->showreel_url): ?>
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Showreel / Intro Video</div>
                    </div>
                    <div class="ap-card-body">
                        <a href="<?php echo e($artist->profile->showreel_url); ?>" target="_blank" class="btn-outline" style="font-size:0.8rem;">
                            ▶ Watch on YouTube / Vimeo
                        </a>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Skills & Expertise</div>
                    </div>
                    <div class="ap-card-body">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->categories)): ?>
                            <div class="ap-skills">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $artist->profile->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <span class="ap-skill"><?php echo e($category); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php else: ?>
                            <p style="color: var(--text-muted); font-size: 0.9rem;">No skills listed yet.</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->special_skills)): ?>
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Special Skills</div>
                    </div>
                    <div class="ap-card-body">
                        <div class="ap-skills">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $artist->profile->special_skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <span class="ap-skill"><?php echo e($skill); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                                <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Social Media & Links</div>
                    </div>
                    
                    <div class="ap-card-body">
                        <div class="ap-socials">

                            
                            <?php
                                $canAccessLinks = auth()->check() && (auth()->id() === $artist->id || auth()->user()->hasRole('Super-Admin'));
                                
                                // Dynamic attributes based on access
                                $linkAttributes = $canAccessLinks 
                                    ? 'target="_blank" rel="noopener noreferrer"' 
                                    : 'wire:click.prevent="revealContact" title="Private link. Contact agency to book." style="cursor: pointer;"';
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->facebook_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->facebook_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                                    Facebook
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile->facebook_followers): ?>
                                        <span style="font-size:0.7rem; opacity:0.7;">· <?php echo e(number_format($artist->profile->facebook_followers)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->instagram_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->instagram_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                                    Instagram
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile->instagram_followers): ?>
                                        <span style="font-size:0.7rem; opacity:0.7;">· <?php echo e(number_format($artist->profile->instagram_followers)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->youtube_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->youtube_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white"/></svg>
                                    YouTube
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile->youtube_followers): ?>
                                        <span style="font-size:0.7rem; opacity:0.7;">· <?php echo e(number_format($artist->profile->youtube_followers)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->tiktok_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->tiktok_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.34 6.34 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.17 8.17 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z"/></svg>
                                    TikTok
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile->tiktok_followers): ?>
                                        <span style="font-size:0.7rem; opacity:0.7;">· <?php echo e(number_format($artist->profile->tiktok_followers)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->linkedin_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->linkedin_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
                                    LinkedIn
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile->linkedin_followers): ?>
                                        <span style="font-size:0.7rem; opacity:0.7;">· <?php echo e(number_format($artist->profile->linkedin_followers)); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->portfolio_url): ?>
                                <a <?php echo $canAccessLinks ? 'href="'.$artist->profile->portfolio_url.'"' : ''; ?> <?php echo $linkAttributes; ?> class="ap-social-btn is-portfolio">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/></svg>
                                    View Portfolio
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$canAccessLinks): ?> <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="opacity:0.5; margin-left:4px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>
                    </div>
                </div>

            </div>

            
            <div class="ap-panel" :class="activeTab === 'portfolio' ? 'is-active' : ''">

                <div class="ap-card">
                    <div class="ap-card-head">
                        <div class="ap-card-head-icon">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="1"/>
                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                <path d="M21 15l-5-5L5 21"/>
                            </svg>
                        </div>
                        <div class="ap-card-title">Portfolio Gallery</div>
                    </div>
                    <div class="ap-card-body" style="padding: 3px;">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->hasMedia('portfolio')): ?>
                            <div class="ap-portfolio-grid">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $artist->getMedia('portfolio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div class="ap-portfolio-item"
                                        @click="lightboxOpen = true; activeImg = '<?php echo e($media->getUrl()); ?>'">
                                        <img src="<?php echo e($media->getUrl()); ?>" alt="Portfolio image" loading="lazy">
                                        <div class="ap-portfolio-overlay">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                                            </svg>
                                            <span>View</span>
                                        </div>
                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php else: ?>
                            <div class="ap-portfolio-grid" style="padding: 24px;">
                                <div class="ap-portfolio-empty">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="0.8" style="margin: 0 auto; opacity: 0.25;">
                                        <rect x="3" y="3" width="18" height="18" rx="1"/>
                                        <circle cx="8.5" cy="8.5" r="1.5"/>
                                        <path d="M21 15l-5-5L5 21"/>
                                    </svg>
                                    <div class="ap-portfolio-empty-title">No portfolio images yet</div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

            </div>

            
            
            <div class="ap-panel" :class="activeTab === 'skills' ? 'is-active' : ''">

                <?php
                    $groupedExp = $artist->experiences->groupBy('type');
                    $expTypeLabels = [
                        'film' => 'Films', 'tv_drama' => 'TV / Drama',
                        'commercial' => 'Commercials', 'theater' => 'Theater',
                        'music_video' => 'Music Videos', 'award' => 'Awards',
                        'jury' => 'Jury Activity', 'other' => 'Other',
                    ];
                ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($groupedExp->isEmpty()): ?>
                    <div class="ap-card">
                        <div class="ap-card-body">
                            <p style="color: var(--text-muted); font-size: 0.9rem;">No credits added yet.</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $groupedExp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $entries): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="ap-card" style="margin-bottom: 20px;">
                            <div class="ap-card-head">
                                <div class="ap-card-head-icon">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                                    </svg>
                                </div>
                                <div class="ap-card-title"><?php echo e($expTypeLabels[$type] ?? ucfirst($type)); ?></div>
                            </div>
                            <div class="ap-card-body" style="padding: 0; overflow-x: auto;">

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type === 'award'): ?>
                                    <table style="width: 100%; border-collapse: collapse; font-size: 0.88rem;">
                                        <thead>
                                            <tr style="border-bottom: 1px solid var(--border); background: var(--bg-primary);">
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Year</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Award</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Category</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">For</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <tr style="border-bottom: 1px solid var(--border);">
                                                    <td style="padding: 12px 20px; color: var(--text-muted);"><?php echo e($exp->year ?? '—'); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-primary); font-weight: 500;"><?php echo e($exp->title); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-secondary);"><?php echo e($exp->award_category ?? '—'); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-secondary); font-style: italic;"><?php echo e($exp->award_work ?? '—'); ?></td>
                                                    <td style="padding: 12px 20px;">
                                                        <span style="font-size: 0.68rem; font-weight: 700; padding: 3px 10px; border-radius: 999px; <?php echo e($exp->award_result === 'Won' ? 'background: rgba(22,163,74,0.1); color: #16a34a; border: 1px solid rgba(22,163,74,0.3);' : 'background: rgba(234,179,8,0.1); color: #ca8a04; border: 1px solid rgba(234,179,8,0.3);'); ?>">
                                                            <?php echo e($exp->award_result ?? '—'); ?>

                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </tbody>
                                    </table>

                                <?php elseif($type === 'jury'): ?>
                                    <div style="padding: 16px 20px;">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <div style="padding: 10px 0; border-bottom: 1px solid var(--border); display: flex; gap: 12px; align-items: flex-start;">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($exp->year): ?>
                                                    <span style="font-size: 0.75rem; color: var(--gold); font-weight: 700; background: var(--gold-bg); padding: 2px 8px; border-radius: 2px; flex-shrink: 0; margin-top: 2px;"><?php echo e($exp->year); ?></span>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                <div>
                                                    <span style="font-weight: 600; color: var(--text-primary);"><?php echo e($exp->title); ?></span>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($exp->jury_category): ?>
                                                        <span style="color: var(--text-muted); font-size: 0.85rem;">, <?php echo e($exp->jury_category); ?></span>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($exp->jury_festival): ?>
                                                        <div style="font-size: 0.82rem; color: var(--text-muted); margin-top: 2px;"><?php echo e($exp->jury_festival); ?><?php echo e($exp->jury_location ? ', ' . $exp->jury_location : ''); ?></div>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </div>

                                <?php else: ?>
                                    <table style="width: 100%; border-collapse: collapse; font-size: 0.88rem;">
                                        <thead>
                                            <tr style="border-bottom: 1px solid var(--border); background: var(--bg-primary);">
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Year</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Title</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Role</th>
                                                <th style="text-align: left; padding: 10px 20px; color: var(--text-muted); font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase;">Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <tr style="border-bottom: 1px solid var(--border);">
                                                    <td style="padding: 12px 20px; color: var(--text-muted);"><?php echo e($exp->year ?? '—'); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-primary); font-weight: 500;"><?php echo e($exp->title); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-secondary);"><?php echo e($exp->role ?? '—'); ?></td>
                                                    <td style="padding: 12px 20px; color: var(--text-muted); font-size: 0.8rem; font-style: italic;"><?php echo e($exp->notes ?? ''); ?></td>
                                                </tr>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </tbody>
                                    </table>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>

        </div>

        
        <div class="ap-sidebar">

            
            <div class="ap-sidebar-card">
                <div class="ap-sidebar-label">Hire This Talent</div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hourly_rate): ?>
                    <div class="ap-rate-display">
                        <div class="ap-rate-num">৳<?php echo e(number_format($artist->profile->hourly_rate)); ?></div>
                        <div class="ap-rate-unit">Starting Rate per Hour</div>
                    </div>
                <?php else: ?>
                    <div class="ap-rate-display">
                        <div class="ap-rate-num" style="font-size: 1.6rem; color: var(--text-muted);">Negotiable</div>
                        <div class="ap-rate-unit">Rate upon request</div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showContact): ?>
                    <div class="ap-contact-box">
                        <div class="ap-contact-box-label">Private Contact Info</div>
                        <div class="ap-contact-phone"><?php echo e($artist->phone ?? 'Not provided'); ?></div>
                        <div class="ap-contact-email"><?php echo e($artist->email); ?></div>
                        <div style="font-size: 0.65rem; color: #dc2626; margin-top: 10px; text-transform: uppercase; font-weight: 700; letter-spacing: 0.1em;">
                            Admin View Only
                        </div>
                    </div>
                <?php else: ?>
                    <button wire:click="revealContact" class="btn-fill"
                        style="width: 100%; justify-content: center; font-size: 0.8rem; padding: 12px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 6px;">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                        </svg>
                        Contact Talent
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                        <p style="font-size: 0.78rem; color: var(--text-muted); text-align: center; margin-top: 10px; line-height: 1.5;">
                            Contact handled through the agency to protect talent privacy.
                        </p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->gender || $artist->profile?->date_of_birth || $artist->profile?->height_cm || !empty($artist->profile?->languages)): ?>
                <div class="ap-sidebar-card">
                    <div class="ap-sidebar-label">Personal Details</div>
                    <div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->gender): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Gender</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->gender); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->date_of_birth): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Age</span>
                                <span class="ap-attr-val"><?php echo e(\Carbon\Carbon::parse($artist->profile->date_of_birth)->age); ?> Years</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->height_cm): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Height</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->height_cm); ?> ft</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->weight_kg): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Weight</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->weight_kg); ?> kg</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->chest_bust_inches): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Chest / Bust</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->chest_bust_inches); ?>"</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->waist_inches): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Waist</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->waist_inches); ?>"</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hips_inches): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Hips</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->hips_inches); ?>"</span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->skin_tone): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Skin Tone</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->skin_tone); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->eye_color): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Eye Color</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->eye_color); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->hair_color): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Hair</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->hair_color); ?><?php echo e($artist->profile->hair_length ? ' · ' . $artist->profile->hair_length : ''); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->shoe_size): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Shoe Size</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->shoe_size); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->dress_size): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Dress Size</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->dress_size); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($artist->profile?->availability): ?>
                            <div class="ap-attr">
                                <span class="ap-attr-key">Availability</span>
                                <span class="ap-attr-val"><?php echo e($artist->profile->availability); ?></span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="ap-attr">
                            <span class="ap-attr-key">Travel</span>
                            <span class="ap-attr-val" style="color: <?php echo e($artist->profile?->willing_to_travel ? '#16a34a' : 'var(--text-muted)'); ?>">
                                <?php echo e($artist->profile?->willing_to_travel ? 'Yes' : 'No'); ?>

                            </span>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($artist->profile?->languages)): ?>
                            <div class="ap-attr" style="align-items: flex-start;">
                                <span class="ap-attr-key" style="padding-top: 3px;">Languages</span>
                                <span class="ap-attr-val" style="text-align: right; line-height: 1.5; font-size: 0.95rem;">
                                    <?php echo e(implode(', ', (array) $artist->profile->languages)); ?>

                                </span>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->id() === $artist->id): ?>
                    <div class="ap-sidebar-card" style="text-align: center; border-style: dashed;">
                        <p style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 14px; line-height: 1.6;">
                            This is your public profile. Keep it updated to attract more clients.
                        </p>
                        <a href="<?php echo e(route('account.dashboard')); ?>" class="btn-outline" style="font-size: 0.78rem; width: 100%; justify-content: center;">
                            Edit Your Profile
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </div>
</div>


<template x-teleport="body">
    <div class="ap-lightbox" :class="lightboxOpen ? 'is-open' : ''"
        x-show="lightboxOpen"
        @keydown.escape.window="lightboxOpen = false"
        style="display: none;">
        <button class="ap-lightbox-close" @click="lightboxOpen = false" aria-label="Close">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <img :src="activeImg" class="ap-lightbox-img" @click.outside="lightboxOpen = false" alt="Full screen view">
    </div>
</template>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showAgencyModal): ?>
<template x-teleport="body">
    <div class="ap-modal-overlay">
        <div class="ap-modal">
            <button class="ap-modal-close" wire:click="closeAgencyModal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>

            <div class="ap-modal-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                </svg>
            </div>

            <h3 class="ap-modal-title">Book <?php echo e($artist->name); ?></h3>
            <p class="ap-modal-desc" style="font-family: 'SolaimanLipi', sans-serif; font-size: 1.4rem; color: var(--text-secondary); line-height: auto;">
                গোপনীয়তা এবং পেশাদারিত্ব নিশ্চিত করতে সমস্ত বুকিং আমাদের এজেন্সির মাধ্যমে পরিচালিত হয়। শিডিউল এবং পারিশ্রমিক সম্পর্কে আলোচনা করতে নিচে আমাদের সাথে যোগাযোগ করুন।
            </p>

            <div class="ap-modal-contact-box">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings?->contact_phone): ?>
                    <div class="ap-modal-contact-row">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" style="opacity:0.5; flex-shrink:0;">
                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                        </svg>
                        <a href="tel:<?php echo e($settings->contact_phone); ?>"><?php echo e($settings->contact_phone); ?></a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings?->contact_email): ?>
                    <div class="ap-modal-contact-row">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" style="opacity:0.5; flex-shrink:0;">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <a href="mailto:<?php echo e($settings->contact_email); ?>"><?php echo e($settings->contact_email); ?></a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$settings?->contact_phone && !$settings?->contact_email): ?>
                    <div class="ap-modal-contact-row" style="color: var(--text-muted); font-size: 0.85rem;">
                        Please visit our <a href="/contact" style="color: var(--gold);">contact page</a> for details.
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <button class="btn-outline" wire:click="closeAgencyModal" style="width: 100%; justify-content: center; font-size: 0.8rem;">
                Close
            </button>
        </div>
    </div>
</template>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div><?php /**PATH H:\agency-app\resources\views/livewire/artist-profile.blade.php ENDPATH**/ ?>