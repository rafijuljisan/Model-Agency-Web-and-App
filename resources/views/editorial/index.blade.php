<x-app-layout>
    <style>
        .editorial-header { text-align: center; padding: 80px 20px 60px; }
        .editorial-eyebrow {
            font-size: 0.65rem; font-weight: 600; letter-spacing: 0.3em; text-transform: uppercase; color: var(--gold); margin-bottom: 16px; display: flex; align-items: center; justify-content: center; gap: 12px;
        }
        .editorial-eyebrow::before, .editorial-eyebrow::after { content: ''; width: 30px; height: 1px; background: var(--gold); opacity: 0.6; }
        .editorial-title { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); line-height: 1.1; }
        .editorial-title strong { font-weight: 600; font-style: italic; color: var(--gold); }

        .editorial-grid { max-width: 1440px; margin: 0 auto 100px; padding: 0 40px; display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; }
        
        .editorial-card { display: flex; flex-direction: column; group: true; cursor: pointer; }
        .editorial-card-img-wrap { width: 100%; aspect-ratio: 4/5; overflow: hidden; background: var(--bg-secondary); margin-bottom: 20px; position: relative; }
        .editorial-card-img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease; }
        .editorial-card:hover .editorial-card-img { transform: scale(1.05); }
        
        .play-indicator { position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.2); opacity: 0; transition: opacity 0.3s; }
        .editorial-card:hover .play-indicator { opacity: 1; }
        .play-indicator svg { width: 48px; height: 48px; color: white; fill: white; }

        .editorial-meta { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.15em; text-transform: uppercase; color: var(--gold); margin-bottom: 12px; }
        .editorial-card-title { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; color: var(--text-primary); line-height: 1.2; margin-bottom: 12px; transition: color 0.3s; }
        .editorial-card:hover .editorial-card-title { color: var(--gold); }
        .editorial-excerpt { font-size: 1.2rem; color: var(--text-secondary); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

        /* Make the first item feature-sized */
        .editorial-card.featured { grid-column: span 2; flex-direction: row; gap: 40px; align-items: center; }
        .editorial-card.featured .editorial-card-img-wrap { aspect-ratio: 16/9; width: 60%; margin-bottom: 0; }
        .editorial-card.featured .editorial-card-content { width: 40%; }
        .editorial-card.featured .editorial-card-title { font-size: 2.8rem; }

        @media (max-width: 1024px) {
            .editorial-grid { grid-template-columns: repeat(2, 1fr); }
            .editorial-card.featured { grid-column: span 2; flex-direction: column; align-items: flex-start; }
            .editorial-card.featured .editorial-card-img-wrap, .editorial-card.featured .editorial-card-content { width: 100%; }
        }
        @media (max-width: 640px) {
            .editorial-grid { grid-template-columns: 1fr; padding: 0 20px; }
            .editorial-card.featured { grid-column: span 1; }
        }
    </style>

    <div class="editorial-header anim-fade-up">
        <div class="editorial-eyebrow">Latest Updates</div>
        <h1 class="editorial-title">Agency <strong>Editorial</strong></h1>
    </div>

    <div class="editorial-grid anim-fade-up anim-d1">
        @foreach($editorials as $index => $post)
            <a href="{{ route('editorial.show', $post) }}" class="editorial-card {{ $index === 0 ? 'featured' : '' }}">
                <div class="editorial-card-img-wrap">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="editorial-card-img">
                    @else
                        <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:var(--text-muted);">No Image</div>
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
        @endforeach
    </div>

    {{-- Pagination --}}
    <div style="max-width:1440px; margin: 0 auto 100px; padding: 0 40px;">
        {{ $editorials->links() }}
    </div>
</x-app-layout>