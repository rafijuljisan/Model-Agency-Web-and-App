<div>
<style>
/* ═══════════════════════════════════════════
   ARTIST PROFILE PAGE
═══════════════════════════════════════════ */

/* Cover banner */
.profile-cover {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: var(--bg-secondary);
}
.profile-cover-pattern {
    position: absolute;
    inset: 0;
    background-image:
        repeating-linear-gradient(
            45deg,
            transparent,
            transparent 28px,
            var(--border) 28px,
            var(--border) 29px
        );
    opacity: 0.5;
}
.profile-cover-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(184,146,74,0.18) 0%,
        transparent 60%,
        rgba(184,146,74,0.06) 100%
    );
}
[data-theme="dark"] .profile-cover-overlay {
    background: linear-gradient(
        135deg,
        rgba(201,169,110,0.12) 0%,
        transparent 60%,
        rgba(201,169,110,0.04) 100%
    );
}

/* Gold corner ornament */
.profile-cover::before {
    content: '';
    position: absolute;
    top: 0; left: 0;
    width: 200px; height: 200px;
    background: radial-gradient(ellipse at top left, var(--gold-bg), transparent 70%);
}
.profile-cover::after {
    content: '';
    position: absolute;
    bottom: 0; right: 0;
    width: 300px; height: 180px;
    background: radial-gradient(ellipse at bottom right, var(--gold-bg), transparent 70%);
}

/* Cover text */
.profile-cover-inner {
    position: absolute;
    inset: 0;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 0 48px 32px;
    max-width: 1440px;
    margin: 0 auto;
    left: 0; right: 0;
}
.profile-cover-eyebrow {
    font-size: 0.55rem;
    font-weight: 600;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 6px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.profile-cover-eyebrow::before {
    content: '';
    width: 24px; height: 1px;
    background: var(--gold);
}
.profile-cover-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.1rem;
    font-weight: 300;
    color: var(--text-muted);
    letter-spacing: 0.08em;
}

/* Main layout */
.profile-page {
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 40px 80px;
}

/* Profile header card */
.profile-header {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    border-top: none;
    margin-bottom: 32px;
    transition: background 0.4s;
}
.profile-header-inner {
    padding: 0 40px 36px;
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

/* Avatar */
.profile-avatar-wrap {
    position: relative;
    margin-top: -56px;
    flex-shrink: 0;
}
.profile-avatar {
    width: 112px; height: 112px;
    border: 3px solid var(--bg-surface);
    overflow: hidden;
    background: var(--bg-secondary);
    box-shadow: var(--shadow-md);
    transition: border-color 0.4s;
}
.profile-avatar img {
    width: 100%; height: 100%;
    object-fit: cover;
}
.profile-avatar-placeholder {
    width: 100%; height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
}
.profile-verified-badge {
    position: absolute;
    bottom: -4px; right: -4px;
    width: 28px; height: 28px;
    background: var(--bg-surface);
    border: 2px solid var(--bg-surface);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: var(--shadow-sm);
}

/* Name & meta */
.profile-identity {
    flex: 1;
    min-width: 0;
}
.profile-name-row {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 4px;
}
.profile-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.2rem;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: 0.01em;
    line-height: 1.1;
}
.profile-category {
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--gold);
    border: 1px solid var(--border-strong);
    padding: 3px 10px;
    background: var(--gold-bg);
}
.profile-location {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    color: var(--text-muted);
    margin-top: 6px;
}

/* Profile actions */
.profile-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-shrink: 0;
}

/* Body layout */
.profile-body {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 28px;
    align-items: start;
}

/* Sections */
.profile-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 36px;
    margin-bottom: 24px;
    transition: background 0.4s, border-color 0.4s;
}
.profile-section:last-child { margin-bottom: 0; }
.profile-section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.3rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 10px;
    letter-spacing: 0.02em;
}
.profile-section-title::before {
    content: '';
    width: 3px; height: 18px;
    background: var(--gold);
    flex-shrink: 0;
}

/* Bio text */
.profile-bio {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.9;
}

/* Portfolio grid */
.portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 3px;
}
.portfolio-item {
    aspect-ratio: 1;
    overflow: hidden;
    background: var(--bg-secondary);
    cursor: pointer;
    position: relative;
}
.portfolio-item img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.25,0.46,0.45,0.94);
}
.portfolio-item:hover img { transform: scale(1.07); }
.portfolio-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10,8,4,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.portfolio-item:hover .portfolio-item-overlay { opacity: 1; }
.portfolio-item-overlay svg { color: #fff; }

.portfolio-empty {
    grid-column: 1 / -1;
    padding: 56px 20px;
    text-align: center;
    border: 1px dashed var(--border-strong);
    color: var(--text-muted);
}
.portfolio-empty-icon { margin: 0 auto 14px; opacity: 0.3; }
.portfolio-empty-label {
    font-size: 0.78rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* ── Sticky sidebar ── */
.profile-sidebar {}
.sidebar-card {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    padding: 28px;
    margin-bottom: 20px;
    transition: background 0.4s, border-color 0.4s;
    position: sticky;
    top: calc(var(--nav-h) + 30px + 20px);
}
.sidebar-card:last-child { margin-bottom: 0; position: static; }

.sidebar-card-title {
    font-size: 0.6rem;
    font-weight: 600;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1px solid var(--border);
}

/* Rate row */
.rate-row {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--border);
}
.rate-label {
    font-size: 0.72rem;
    color: var(--text-muted);
    letter-spacing: 0.08em;
}
.rate-value {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.9rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1;
}
.rate-value sup {
    font-size: 0.9rem;
    font-weight: 400;
    color: var(--text-muted);
    margin-left: 3px;
}

/* Contact reveal */
.contact-reveal {
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    padding: 20px;
    text-align: center;
}
.contact-reveal-label {
    font-size: 0.58rem;
    font-weight: 600;
    letter-spacing: 0.28em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 8px;
}
.contact-reveal-phone {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.7rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.2;
}
.contact-reveal-email {
    font-size: 0.78rem;
    color: var(--text-muted);
    margin-top: 6px;
}
.contact-guest-note {
    font-size: 0.7rem;
    color: var(--text-muted);
    text-align: center;
    margin-top: 12px;
    line-height: 1.6;
}
.contact-guest-note a {
    color: var(--gold);
    text-decoration: underline;
    text-underline-offset: 2px;
}

/* Attributes */
.attr-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0;
    border-bottom: 1px solid var(--border);
}
.attr-row:last-child { border-bottom: none; padding-bottom: 0; }
.attr-key {
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
}
.attr-val {
    font-size: 0.88rem;
    font-weight: 500;
    color: var(--text-primary);
    font-family: 'Cormorant Garamond', serif;
    font-size: 1rem;
}

/* ── Responsive ── */
@media (max-width: 1024px) {
    .profile-body { grid-template-columns: 1fr; }
    .sidebar-card { position: static; }
    .profile-page { padding: 0 20px 60px; }
    .profile-header-inner { padding: 0 20px 28px; }
    .profile-cover-inner { padding: 0 20px 24px; }
}
@media (max-width: 640px) {
    .profile-name { font-size: 1.7rem; }
    .portfolio-grid { grid-template-columns: repeat(2, 1fr); }
    .profile-section { padding: 24px 20px; }
    .sidebar-card { padding: 20px; }
}
</style>

{{-- ══════════════════════════════════════
     COVER BANNER
══════════════════════════════════════ --}}
<div class="profile-cover">
    <div class="profile-cover-pattern"></div>
    <div class="profile-cover-overlay"></div>
    <div class="profile-cover-inner">
        <div class="profile-cover-eyebrow">Talent Profile</div>
        <div class="profile-cover-title">
            {{ ucfirst($artist->profile->category ?? 'Professional') }} &nbsp;·&nbsp; Verified Member
        </div>
    </div>
</div>

<div class="profile-page">

    {{-- ══════════════════════════════════════
         PROFILE HEADER
    ══════════════════════════════════════ --}}
    <div class="profile-header anim-fade-up">
        <div class="profile-header-inner">

            {{-- Avatar --}}
            <div class="profile-avatar-wrap">
                <div class="profile-avatar">
                    @if($artist->hasMedia('portfolio'))
                        <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}">
                    @else
                        <div class="profile-avatar-placeholder">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="profile-verified-badge" title="NID Verified">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#2a7d4f" aria-label="Verified">
                        <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                    </svg>
                </div>
            </div>

            {{-- Identity --}}
            <div class="profile-identity">
                <div class="profile-name-row">
                    <h1 class="profile-name">{{ $artist->name }}</h1>
                    <span class="profile-category">{{ ucfirst($artist->profile->category ?? 'Professional') }}</span>
                    <span class="badge-verified">
                        <svg width="8" height="8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                        </svg>
                        NID Verified
                    </span>
                </div>
                <div class="profile-location">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                        <circle cx="12" cy="9" r="2.5"/>
                    </svg>
                    {{ ucfirst($artist->profile->location ?? 'Location not specified') }}
                </div>
            </div>

            {{-- Actions (desktop) --}}
            <div class="profile-actions">

                {{-- Edit button — only visible to the profile owner --}}
                @auth
                    @if(auth()->id() === $artist->id)
                        <a href="{{ route('account.dashboard') }}" class="btn-outline">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                            Edit Profile
                        </a>
                    @endif
                @endauth

                {{-- Contact button — visible to everyone else --}}
                @if(!auth()->check() || auth()->id() !== $artist->id)
                    <button wire:click="revealContact" class="btn-fill">
                        Contact
                    </button>
                @endif

            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════
         BODY: MAIN + SIDEBAR
    ══════════════════════════════════════ --}}
    <div class="profile-body">

        {{-- ── Left column ── --}}
        <div>

            {{-- About --}}
            <div class="profile-section anim-fade-up anim-d1">
                <h2 class="profile-section-title">About</h2>
                <div class="profile-bio">
                    {!! nl2br(e($artist->profile->bio ?? 'This professional has not added a bio yet.')) !!}
                </div>
            </div>

            {{-- Portfolio --}}
            <div class="profile-section anim-fade-up anim-d2">
                <h2 class="profile-section-title">Portfolio</h2>

                @if($artist->hasMedia('portfolio'))
                    <div class="portfolio-grid">
                        @foreach($artist->getMedia('portfolio') as $media)
                            <div class="portfolio-item">
                                <img src="{{ $media->getUrl() }}" alt="Portfolio image" loading="lazy">
                                <div class="portfolio-item-overlay">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="portfolio-grid">
                        <div class="portfolio-empty">
                            <svg class="portfolio-empty-icon" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="1"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/>
                            </svg>
                            <div class="portfolio-empty-label">No portfolio images uploaded yet</div>
                        </div>
                    </div>
                @endif
            </div>

        </div>

        {{-- ── Sidebar ── --}}
        <div class="profile-sidebar">

            {{-- Hire Details --}}
            <div class="sidebar-card anim-fade-up anim-d1">
                <div class="sidebar-card-title">Hire Details</div>

                <div class="rate-row">
                    <span class="rate-label">Starting Rate</span>
                    <div class="rate-value">
                        {{ $artist->profile->hourly_rate ?? 'Negotiable' }}
                        @if($artist->profile->hourly_rate)
                            <sup>BDT/hr</sup>
                        @endif
                    </div>
                </div>

                @if($showContact)
                    <div class="contact-reveal">
                        <div class="contact-reveal-label">Contact Information</div>
                        <div class="contact-reveal-phone">{{ $artist->phone ?? 'Not provided' }}</div>
                        <div class="contact-reveal-email">{{ $artist->email }}</div>
                    </div>
                @else
                    <button
                        wire:click="revealContact"
                        class="btn-fill"
                        style="width:100%; justify-content:center;"
                        aria-label="Unlock contact details"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="1"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                        Reveal Contact Info
                    </button>
                    @guest
                        <p class="contact-guest-note">
                            You must be <a href="/login">signed in</a> as a client to view contact details.
                        </p>
                    @endguest
                @endif
            </div>

            {{-- Physical Attributes --}}
            @if($artist->profile->height || $artist->profile->weight || $artist->profile->eye_color ?? null || $artist->profile->hair_color ?? null)
                <div class="sidebar-card anim-fade-up anim-d2" style="position:static;">
                    <div class="sidebar-card-title">Physical Attributes</div>
                    <div>
                        @if($artist->profile->height)
                            <div class="attr-row">
                                <span class="attr-key">Height</span>
                                <span class="attr-val">{{ $artist->profile->height }}</span>
                            </div>
                        @endif
                        @if($artist->profile->weight)
                            <div class="attr-row">
                                <span class="attr-key">Weight</span>
                                <span class="attr-val">{{ $artist->profile->weight }}</span>
                            </div>
                        @endif
                        @if($artist->profile->eye_color ?? null)
                            <div class="attr-row">
                                <span class="attr-key">Eyes</span>
                                <span class="attr-val">{{ ucfirst($artist->profile->eye_color) }}</span>
                            </div>
                        @endif
                        @if($artist->profile->hair_color ?? null)
                            <div class="attr-row">
                                <span class="attr-key">Hair</span>
                                <span class="attr-val">{{ ucfirst($artist->profile->hair_color) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

</div>