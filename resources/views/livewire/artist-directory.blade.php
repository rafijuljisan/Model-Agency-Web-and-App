<div>
    <style>
        /* ═══════════════════════════════════════════
   ARTIST DIRECTORY PAGE
═══════════════════════════════════════════ */

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
            font-size: 0.58rem;
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
            font-family: 'Cormorant Garamond', serif;
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
            padding: 28px;
            transition: background 0.4s, border-color 0.4s;
        }

        .filter-panel-title {
            font-size: 0.6rem;
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
            font-size: 0.58rem;
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
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .filter-group:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .filter-label {
            font-size: 0.62rem;
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
            padding: 10px 14px;
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 0.82rem;
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
            padding: 5px 12px;
            border: 1px solid var(--border-strong);
            background: transparent;
            color: var(--text-secondary);
            font-family: 'Jost', sans-serif;
            font-size: 0.65rem;
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
            font-size: 0.72rem;
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
            gap: 2px;
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
            transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
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
            font-size: 0.58rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            opacity: 0.5;
        }

        /* Verified badge */
        .artist-card-verified {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(255, 255, 255, 0.92);
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
            z-index: 2;
        }

        [data-theme="dark"] .artist-card-verified {
            background: rgba(26, 23, 20, 0.88);
            color: var(--bone, #f0ebe2);
        }

        /* Info bottom overlay */
        .artist-card-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 32px 16px 16px;
            background: linear-gradient(to top, rgba(10, 8, 4, 0.92) 0%, rgba(10, 8, 4, 0.5) 55%, transparent 100%);
            transform: translateY(3px);
            transition: transform 0.3s ease;
        }

        .artist-card:hover .artist-card-info {
            transform: translateY(0);
        }

        .artist-card-cat {
            font-size: 0.56rem;
            font-weight: 500;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(201, 169, 110, 0.9);
            margin-bottom: 3px;
        }

        .artist-card-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 400;
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
            font-size: 0.62rem;
            color: rgba(255, 255, 255, 0.55);
        }

        .artist-card-rate {
            font-size: 0.62rem;
            font-weight: 600;
            color: rgba(201, 169, 110, 0.85);
            letter-spacing: 0.06em;
        }

        .artist-card-cta {
            font-size: 0.58rem;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.65);
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
            font-family: 'Cormorant Garamond', serif;
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
                display: flex; /* Show the 'Filters' button on mobile */
            }
            .mobile-filter-close {
                display: block; /* Show close 'X' icon in panel */
            }

            /* Convert sidebar to a fixed hidden drawer */
            .filter-sidebar {
                position: fixed !important; /* Override standard positioning */
                top: 0 !important;
                left: 0;
                width: 100%;
                height: 100vh;
                z-index: 9999;
                pointer-events: none; /* Let clicks pass through when closed */
                display: flex;
                justify-content: flex-end; /* Slide in from the right */
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
                transform: translateX(100%); /* Hidden off-screen to the right */
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: -4px 0 24px rgba(0,0,0,0.1);
                border-left: 1px solid var(--border);
                margin-top: 0; /* Remove top spacing on mobile */
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
                transform: translateX(0); /* Slide into view */
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
    </style>

    {{-- ══════════════════════════════════
    PAGE HERO
    ══════════════════════════════════ --}}
    <div class="directory-hero">
        <div class="directory-hero-inner">
            <div class="directory-hero-eyebrow">Verified Talent Directory</div>
            <h1 class="directory-hero-title">
                Find Your <strong>Perfect Talent.</strong>
            </h1>
            <p class="directory-hero-sub">
                Browse {{ $artists->total() ?? '' }} verified professionals — models, actors, photographers &amp; more.
            </p>
        </div>
    </div>

    {{-- ══════════════════════════════════
    DIRECTORY BODY
    ══════════════════════════════════ --}}
    <div class="directory-page">

        {{-- ── Filter Sidebar ── --}}
        <aside class="filter-sidebar {{ $showMobileFilters ? 'is-open' : '' }}" aria-label="Filter talent">
            
            {{-- NEW: Mobile Overlay Background --}}
            <div class="mobile-filter-overlay" wire:click="$set('showMobileFilters', false)"></div>

            <div class="filter-panel">
                <div class="filter-panel-title">
                    Filter
                    
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <button class="filter-clear-btn"
                            wire:click="$set('search', ''); $set('category', '');$set('group', ''); $set('gender', ''); $set('minAge', null); $set('maxAge', null); $set('minHeight', null); $set('maxHeight', null); $set('district', ''); $set('upazila', '')"
                            Clear all
                        </button>

                        {{-- NEW: Mobile Close Button --}}
                        <button class="mobile-filter-close" wire:click="$set('showMobileFilters', false)">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Search --}}
                <div class="filter-group">
                    <label class="filter-label" for="filter-search">Search Name</label>
                    <input id="filter-search" class="filter-input" type="text" placeholder="e.g. Artist name…"
                        wire:model.live.debounce.300ms="search" autocomplete="off">
                </div>

                {{-- Category --}}
                <div class="filter-group">
                    <label class="filter-label" for="filter-category">Category</label>
                    <div class="filter-select-wrap">
                        <select id="filter-category" class="filter-select" wire:model.live="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $groupName => $cats)
                                <optgroup label="{{ $groupName }}" style="color: var(--gold); font-weight: 600; text-transform: uppercase;">
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat->name }}" style="color: var(--text-primary); font-weight: 300; text-transform: none;">
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Gender --}}
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

                {{-- Age Range --}}
                <div class="filter-group">
                    <span class="filter-label">Age Range (Years)</span>
                    <div style="display: flex; gap: 8px;">
                        <input class="filter-input" type="number" placeholder="Min age"
                            wire:model.live.debounce.500ms="minAge" min="13">
                        <input class="filter-input" type="number" placeholder="Max age"
                            wire:model.live.debounce.500ms="maxAge">
                    </div>
                </div>

                {{-- Height Range --}}
                <div class="filter-group">
                    <span class="filter-label">Height Range (CM)</span>
                    <div style="display: flex; gap: 8px;">
                        <input class="filter-input" type="number" placeholder="Min cm"
                            wire:model.live.debounce.500ms="minHeight">
                        <input class="filter-input" type="number" placeholder="Max cm"
                            wire:model.live.debounce.500ms="maxHeight">
                    </div>
                </div>

                {{-- District Location --}}
                <div class="filter-group">
                    <label class="filter-label" for="filter-district">District</label>
                    <div class="filter-select-wrap">
                        <select id="filter-district" class="filter-select" wire:model.live="district">
                            <option value="">All of Bangladesh</option>
                            {{-- Note: Make sure your Livewire component passes $locations or $districts here! --}}
                            @foreach($locations as $loc)
                                <option value="{{ $loc }}">{{ ucfirst($loc) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- Thana / Upazila Location (Only shows if District is selected) --}}
                @if($district)
                    <div class="filter-group anim-fade-up">
                        <label class="filter-label" for="filter-upazila">Thana / Upazila</label>
                        <div class="filter-select-wrap">
                            <select id="filter-upazila" class="filter-select" wire:model.live="upazila">
                                <option value="">All of {{ ucfirst($district) }}</option>
                                @foreach($upazilas as $upa)
                                    <option value="{{ $upa }}">{{ ucfirst($upa) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

            </div>
        </aside>

        {{-- ── Main results ── --}}
        <div class="directory-main">

            {{-- Toolbar --}}
            <div class="directory-toolbar">
                <div class="directory-count">
                    Showing <strong>{{ $artists->count() }}</strong> of <strong>{{ $artists->total() }}</strong> talents
                </div>

                {{-- NEW: Mobile Filter Toggle Button --}}
                <button class="mobile-filter-toggle" wire:click="$toggle('showMobileFilters')">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="4" y1="21" x2="4" y2="14"></line>
                        <line x1="4" y1="10" x2="4" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12" y2="3"></line>
                        <line x1="20" y1="21" x2="20" y2="16"></line>
                        <line x1="20" y1="12" x2="20" y2="3"></line>
                        <line x1="1" y1="14" x2="7" y2="14"></line>
                        <line x1="9" y1="8" x2="15" y2="8"></line>
                        <line x1="17" y1="16" x2="23" y2="16"></line>
                    </svg>
                    Filters
                </button>
            </div>

            {{-- Loading --}}
            <div wire:loading class="loading-bar">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <circle cx="12" cy="12" r="10" opacity="0.25" />
                    <path d="M12 2a10 10 0 0110 10" stroke-linecap="round" />
                </svg>
                Searching…
            </div>

            {{-- Grid --}}
            <div class="artist-grid" wire:loading.class="is-loading">
                @forelse($artists as $artist)
                    <a href="/artist/{{ $artist->id }}" class="artist-card" aria-label="View {{ $artist->name }}'s profile">

                        <div class="artist-card-verified" aria-label="Verified">
                            <svg width="8" height="8" viewBox="0 0 24 24" fill="#2a7d4f" aria-hidden="true">
                                <path
                                    d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                            </svg>
                            Verified
                        </div>

                        <div class="artist-card-media">
                            @if($artist->hasMedia('avatar'))
                                <img src="{{ $artist->getFirstMediaUrl('avatar') }}" alt="{{ $artist->name }}" loading="lazy">
                            @elseif($artist->hasMedia('portfolio'))
                                <img src="{{ $artist->getFirstMediaUrl('portfolio') }}" alt="{{ $artist->name }}" loading="lazy">
                            @else
                                <div class="artist-card-placeholder">
                                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1" aria-hidden="true">
                                        <circle cx="12" cy="8" r="4" />
                                        <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
                                    </svg>
                                    <span>No Photo</span>
                                </div>
                            @endif
                        </div>

                        <div class="artist-card-info">
                            <div class="artist-card-cat">{{ $artist->profile?->categories[0] ?? 'Professional' }}</div>
                            <div class="artist-card-name">{{ $artist->name }}</div>
                            <div class="artist-card-meta">
                                <div class="artist-card-location">
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.5" aria-hidden="true">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                        <circle cx="12" cy="9" r="2.5" />
                                    </svg>
                                    {{ implode(', ', array_filter([$artist->profile?->upazila, $artist->profile?->district, $artist->profile?->country])) ?: 'Location not specified' }}
                                </div>
                                @if($artist->profile->hourly_rate)
                                    <div class="artist-card-rate">{{ $artist->profile->hourly_rate }} BDT/hr</div>
                                @endif
                            </div>
                            <div class="artist-card-cta">
                                View Profile
                                <svg width="9" height="9" viewBox="0 0 10 10" fill="none">
                                    <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="artist-empty">
                        <svg class="artist-empty-icon" width="52" height="52" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1" aria-hidden="true">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        <div class="artist-empty-title">No Talent Found</div>
                        <div class="artist-empty-sub">Try adjusting your search filters.</div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="pagination-wrap">
                {{ $artists->links(data: ['scrollTo' => false]) }}
            </div>

        </div>
    </div>

</div>