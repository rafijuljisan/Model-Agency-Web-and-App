<x-app-layout>
    {{-- 1. Set the Page Title --}}
    <x-slot name="title">
        {{ $editorial->title }} | {{ config('app.name') }}
    </x-slot>

    {{-- 2. Inject Dynamic SEO & Social Share (Open Graph) Tags --}}
    <x-slot name="meta">
        <meta name="description" content="{{ Str::limit(strip_tags($editorial->content), 155) }}">
        <meta name="author" content="AgencyMarket">

        <meta property="og:type" content="article">
        <meta property="og:title" content="{{ $editorial->title }}">
        <meta property="og:description" content="{{ Str::limit(strip_tags($editorial->content), 155) }}">
        <meta property="og:url" content="{{ Request::fullUrl() }}">
        @if($editorial->featured_image)
            <meta property="og:image" content="{{ asset('storage/' . $editorial->featured_image) }}">
        @endif
        <meta property="article:published_time" content="{{ $editorial->published_at->toIso8601String() }}">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $editorial->title }}">
        <meta name="twitter:description" content="{{ Str::limit(strip_tags($editorial->content), 155) }}">
        @if($editorial->featured_image)
            <meta name="twitter:image" content="{{ asset('storage/' . $editorial->featured_image) }}">
        @endif
    </x-slot>

    <style>
        /* ── Page Container & Header ── */
        .article-layout {
            max-width: 768px; /* Optimal reading width */
            margin: 40px auto 100px;
            padding: 0 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 32px;
            transition: color 0.2s;
            text-decoration: none;
        }
        .back-link:hover { color: var(--gold); }

        .article-header { margin-bottom: 32px; }
        .article-meta {
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
            display: block;
        }
        .article-title {
            font-family: 'Jost', sans-serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 400;
            color: var(--text-primary);
            line-height: 1.15;
            margin-bottom: 24px;
        }

        /* ── Media Elements ── */
        .article-media {
            width: 100%;
            margin-bottom: 40px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06);
        }
        .article-media img {
            width: 100%;
            height: auto;
            display: block;
            image-rendering: high-quality;
            object-fit: cover;
        }
        .video-wrapper {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            background: #000;
        }
        .video-wrapper iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: 0;
        }

        /* ── Article Prose (Content) ── */
        .prose {
            color: var(--text-secondary);
            font-size: 1.125rem;
            line-height: 1.8;
            font-weight: 300;
            margin-bottom: 48px;
        }
        .prose p { margin-bottom: 1.5em; }
        .prose h2, .prose h3 {
            font-family: 'Jost', sans-serif;
            color: var(--text-primary);
            margin-top: 2em;
            margin-bottom: 0.75em;
            font-weight: 500;
        }
        .prose h2 { font-size: 2rem; }
        .prose h3 { font-size: 1.5rem; }
        .prose ul, .prose ol { margin-bottom: 1.5em; padding-left: 24px; }
        .prose li { margin-bottom: 0.5em; }
        .prose blockquote {
            border-left: 4px solid var(--gold);
            padding-left: 20px;
            font-style: italic;
            color: var(--text-primary);
            font-size: 1.25rem;
            margin: 2em 0;
        }
        .prose img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            margin: 1.5em 0;
        }

        /* ── Social Share ── */
        .article-share {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            margin-bottom: 48px;
        }
        .share-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-primary);
            margin-right: 8px;
        }
        .share-btn {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: var(--text-secondary);
            background: var(--bg-secondary);
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .share-btn:hover {
            background: var(--gold);
            color: #fff;
            transform: translateY(-2px);
        }
        .share-btn svg { width: 16px; height: 16px; fill: currentColor; }

        /* ── HD Gallery ── */
        .gallery-section { margin-top: 20px; }
        .gallery-title {
            font-family: 'Jost', sans-serif;
            font-size: 1.8rem;
            color: var(--text-primary);
            margin-bottom: 24px;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .gallery-item {
            position: relative;
            aspect-ratio: 4/5;
            overflow: hidden;
            background: var(--bg-secondary);
            border-radius: 4px;
            cursor: pointer;
        }
        .gallery-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .gallery-item:hover img { transform: scale(1.06); }

        /* ── Lightbox Modal ── */
        /* ── Lightbox Modal ── */
        .ed-lightbox {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.95);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden; /* Prevents the dark overlay from scrolling */
            touch-action: none; /* Prevents mobile swipe-to-scroll on the background */
        }
        .ed-lightbox img {
            max-width: 100%;
            max-height: 90vh; /* Fallback for older browsers */
            max-height: 90dvh; /* Uses exact mobile screen height, ignoring address bars */
            object-fit: contain;
            border-radius: 4px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.5);
        }
        .ed-lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255,255,255,0.1);
            color: #fff;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
            z-index: 10001; /* Ensures button stays above the image */
        }
        .ed-lightbox-close:hover {
            background: var(--gold);
        }

        /* Responsive Details */
        @media (max-width: 768px) {
            .article-layout { margin-top: 20px; }
            .gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
            .article-share { flex-wrap: wrap; justify-content: center; text-align: center; }
            .share-label { width: 100%; margin-right: 0; margin-bottom: 8px; }
        }
    </style>

    {{-- Alpine X-Data Wrapper for Lightbox Functionality --}}
    {{-- 1. NEW WRAPPER: Holds the Alpine state but has NO CSS transforms --}}
    <div x-data="{ lightboxOpen: false, currentImage: '' }">

        {{-- 2. ARTICLE CONTENT --}}
        <div class="article-layout anim-fade-up">

            <a href="{{ route('editorial.index') }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to Editorial
            </a>

            <header class="article-header">
                <span class="article-meta">{{ $editorial->published_at->format('F d, Y') }}</span>
                <h1 class="article-title">{{ $editorial->title }}</h1>
            </header>

            <div style="margin-bottom: 32px;">
                <x-ad-banner position="editorial_show_top" />
            </div>

            @if($editorial->embed_code)
                <div class="article-media video-wrapper">
                    {!! $editorial->embed_code !!}
                </div>
            @elseif($editorial->featured_image)
                <div class="article-media">
                    <img src="{{ asset('storage/' . $editorial->featured_image) }}" alt="{{ $editorial->title }}">
                </div>
            @endif

            <article class="prose">
                {!! $editorial->content !!}
            </article>

            <div style="margin-bottom: 40px;">
                <x-ad-banner position="editorial_show_bottom" />
            </div>
            @if($editorial->gallery && count($editorial->gallery) > 0)
                <div class="gallery-section">
                    <h3 class="gallery-title">Gallery</h3>
                    <div class="gallery-grid">
                        @foreach($editorial->gallery as $image)
                            <div class="gallery-item" @click="currentImage = '{{ asset('storage/' . $image) }}'; lightboxOpen = true">
                                <img src="{{ asset('storage/' . $image) }}" alt="Editorial Image" loading="lazy">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="article-share">
                <span class="share-label">Share this article</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank" class="share-btn" aria-label="Share on Facebook">
                    <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode($editorial->title) }}" target="_blank" class="share-btn" aria-label="Share on X">
                    <svg viewBox="0 0 24 24"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </a>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(Request::fullUrl()) }}" target="_blank" class="share-btn" aria-label="Share on LinkedIn">
                    <svg viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
                </a>
                <a href="https://api.whatsapp.com/send?text={{ urlencode($editorial->title . ' - ' . Request::fullUrl()) }}" target="_blank" class="share-btn" aria-label="Share on WhatsApp">
                    <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
                </a>
            </div>


            <div style="margin-top: 60px;">
                <x-ad-banner position="editorial_show_footer" />
            </div>

        </div> {{-- End of .article-layout --}}

        {{-- 3. MODAL OUTSIDE OF THE TRANSFORMED DIV --}}
        <div class="ed-lightbox"
             x-show="lightboxOpen"
             x-transition.opacity.duration.300ms
             @click.self="lightboxOpen = false"
             @keydown.escape.window="lightboxOpen = false"
             style="display: none;">

            <button class="ed-lightbox-close" @click="lightboxOpen = false">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <img :src="currentImage" alt="Expanded View" @click.stop>
        </div>

    </div> {{-- End of Alpine wrapper --}}
</x-app-layout>
