<x-app-layout>
    <style>
        /* ── Typography & Header ── */
        .editorial-header {
            text-align: center;
            padding: 60px 20px 40px;
        }
        .editorial-eyebrow {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .editorial-eyebrow::before, .editorial-eyebrow::after {
            content: ''; width: 24px; height: 1px; background: var(--gold); opacity: 0.5;
        }
        .editorial-title {
            font-family: 'Jost', sans-serif;
            font-size: clamp(2.2rem, 4vw, 3rem);
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.2;
        }
        .editorial-title strong {
            font-weight: 600;
            font-style: italic;
            color: var(--gold);
        }

        /* ── Layout & Grid ── */
        .editorial-grid {
            max-width: 1440px;
            margin: 0 auto 60px;
            padding: 0 40px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px 32px;
            align-items: stretch; /* Ensures equal height */
        }

        /* ── Clean Card Styling ── */
        .editorial-card {
            display: flex;
            flex-direction: column;
            text-decoration: none;
            height: 100%; /* Fills the grid track */
            transition: transform 0.3s ease;
        }
        .editorial-card:hover {
            transform: translateY(-4px); /* Subtle float */
        }

        /* Image Wrapper */
        .editorial-card-img-wrap {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            background: var(--bg-secondary);
            margin-bottom: 20px;
            position: relative;
            border-radius: 6px;
        }
        .editorial-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .editorial-card:hover .editorial-card-img {
            transform: scale(1.04);
        }

        /* Play Button Overlay */
        .play-indicator {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0,0,0,0.15);
            opacity: 0;
            transition: opacity 0.3s, background 0.3s;
        }
        .editorial-card:hover .play-indicator {
            opacity: 1;
            background: rgba(0,0,0,0.3);
        }
        .play-indicator svg {
            width: 44px;
            height: 44px;
            color: white;
            fill: white;
            filter: drop-shadow(0 2px 8px rgba(0,0,0,0.3));
        }

        /* Text Content */
        .editorial-card-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1; /* Pushes bottom content down to equal out heights */
        }
        .editorial-meta {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 10px;
        }
        .editorial-card-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1.3;
            margin-bottom: 12px;
            transition: color 0.2s;
        }
        .editorial-card:hover .editorial-card-title {
            color: var(--gold);
        }
        .editorial-excerpt {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0;
        }

        /* ── Ads ── */
        .ad-container {
            max-width: 1440px;
            margin: 0 auto 40px;
            padding: 0 40px;
        }
        .ad-in-feed {
            grid-column: 1 / -1;
            width: 100%;
            padding: 10px 0;
            display: flex;
            justify-content: center;
        }

        /* ── Mobile & Tablet Responsiveness ── */
        @media (max-width: 1024px) {
            .editorial-grid { grid-template-columns: repeat(2, 1fr); gap: 32px 24px; }
        }

        @media (max-width: 640px) {
            .editorial-header { padding: 40px 20px 30px; }
            .editorial-grid { grid-template-columns: 1fr; padding: 0 20px; gap: 40px; }
            .ad-container { padding: 0 20px; }
            .editorial-card-img-wrap { aspect-ratio: 16/9; } /* Wider aspect ratio on mobile looks better */
        }
    </style>

    <div class="editorial-header anim-fade-up">
        <div class="editorial-eyebrow">Latest Updates</div>
        <h1 class="editorial-title">Agency <strong>Editorial</strong></h1>
    </div>

    {{-- AD SLOT 1: Editorial Index Top --}}
    <div class="ad-container">
        <x-ad-banner position="editorial_index_top" />
    </div>

    <div class="editorial-grid anim-fade-up anim-d1">
        @foreach($editorials as $post)
            <a href="{{ route('editorial.show', $post) }}" class="editorial-card">
                <div class="editorial-card-img-wrap">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="editorial-card-img">
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--text-muted); background:var(--bg-secondary);">No Image</div>
                    @endif

                    {{-- Show a play icon if it has an embed code --}}
                    @if($post->embed_code)
                        <div class="play-indicator">
                            <svg viewBox="0 0 24 24"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                        </div>
                    @endif
                </div>

                <div class="editorial-card-content">
                    <div class="editorial-meta">{{ $post->published_at->format('F d, Y') }}</div>
                    <h2 class="editorial-card-title">{{ $post->title }}</h2>
                    <p class="editorial-excerpt">{{ $post->excerpt }}</p>
                </div>
            </a>

            {{-- AD SLOT 2: In-Feed (Shows after the 3rd row to break perfectly on desktop) --}}
            @if($loop->iteration == 3)
                <div class="ad-in-feed">
                    <x-ad-banner position="editorial_index_in_feed" />
                </div>
            @endif
        @endforeach
    </div>

    {{-- AD SLOT 3: Editorial Index Bottom --}}
    <div class="ad-container">
        <x-ad-banner position="editorial_index_bottom" />
    </div>

    {{-- Pagination --}}
    <div style="max-width:1440px; margin: 0 auto 80px; padding: 0 40px;">
        {{ $editorials->links() }}
    </div>
</x-app-layout>
