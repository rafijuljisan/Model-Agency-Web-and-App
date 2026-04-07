<x-app-layout>
    <style>
        /* ═══════════════════════════════════════════
           ABOUT US PAGE
        ═══════════════════════════════════════════ */
        .about-hero {
            text-align: center;
            padding: 80px 20px 60px;
            max-width: 800px;
            margin: 0 auto;
        }
        .about-eyebrow {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .about-eyebrow::before,
        .about-eyebrow::after {
            content: '';
            width: 30px; height: 1px;
            background: var(--gold);
            opacity: 0.6;
        }
        .about-title {
            font-family: 'Jost', sans-serif;
            font-size: 3.5rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 24px;
        }
        .about-title strong { font-weight: 600; font-style: italic; color: var(--gold); }

        /* Main Content Grid */
        .about-container {
            max-width: 1200px;
            margin: 0 auto 100px;
            padding: 0 40px;
        }
        
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
            margin-bottom: 80px;
        }
        .about-image {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            border-radius: 2px;
            box-shadow: var(--shadow-lg);
        }
        
        /* Typography for Rich Text (Prose) */
        .prose {
            color: var(--text-secondary);
            font-size: 1.2rem;
            line-height: 1.8;
            font-weight: 300;
        }
        .prose p { margin-bottom: 16px; }
        .prose strong { color: var(--text-primary); font-weight: 500; }
        .prose ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 24px;
        }
        .prose ul li {
            position: relative;
            padding-left: 24px;
            margin-bottom: 12px;
        }
        .prose ul li::before {
            content: '✦';
            position: absolute;
            left: 0;
            top: 0;
            color: var(--gold);
            font-size: 0.8rem;
        }

        /* Mission / Vision Cards */
        .mv-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 80px;
        }
        .mv-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 40px;
            text-align: center;
            transition: border-color 0.3s, transform 0.3s;
        }
        .mv-card:hover {
            border-color: var(--gold);
            transform: translateY(-4px);
        }
        .mv-icon {
            color: var(--gold);
            margin-bottom: 20px;
        }
        .mv-title {
            font-family: 'Jost', sans-serif;
            font-size: 2rem;
            color: var(--text-primary);
            margin-bottom: 16px;
        }
        .mv-text {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.7;
            font-style: italic;
        }

        /* Content Sections */
        .content-section {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 60px;
            margin-bottom: 40px;
        }
        .section-header {
            font-family: 'Jost', sans-serif;
            font-size: 2.2rem;
            color: var(--text-primary);
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        @media (max-width: 900px) {
            .about-grid, .mv-grid { grid-template-columns: 1fr; gap: 40px; }
            .about-title { font-size: 2.8rem; }
            .content-section { padding: 40px 24px; }
        }
        @media (max-width: 640px) {
            .about-container { padding: 0 20px; }
        }
    </style>

    {{-- Hero Section --}}
    <div class="about-hero anim-fade-up">
        <div class="about-eyebrow">Discover Our Story</div>
        <h1 class="about-title">Redefining <strong>Beauty & Talent</strong> in Bangladesh</h1>
    </div>

    <div class="about-container">
        
        {{-- Intro & Image Grid --}}
        <div class="about-grid anim-fade-up anim-d1">
            <div class="prose">
                <h2 class="section-header" style="border:none; padding:0; margin-bottom: 20px;">Who We Are</h2>
                
                @if($settings->about_text)
                    {!! $settings->about_text !!}
                @else
                    <p>Dhaka Model Agency is a modern and professional model management platform in Bangladesh. We believe every individual carries unique beauty and talent, and with the right opportunity, anyone can shine.</p>
                @endif
            </div>

            {{-- Update this part in about.blade.php --}}
            <div>
                @if($settings->about_image)
                    @if(filter_var($settings->about_image, FILTER_VALIDATE_URL))
                        {{-- Use external URL if the field contains a full link --}}
                        <img src="{{ $settings->about_image }}" alt="Dhaka Model Agency" class="about-image">
                    @else
                        {{-- Use local storage if it's just a filename --}}
                        <img src="{{ asset('storage/' . $settings->about_image) }}" alt="Dhaka Model Agency" class="about-image">
                    @endif
                @else
                    {{-- Fallback --}}
                    <div class="about-image" style="background: var(--bg-secondary);">...</div>
                @endif
            </div>
        </div>

        {{-- Mission & Vision Cards --}}
        <div class="mv-grid anim-fade-up anim-d2">
            <div class="mv-card">
                <div class="mv-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
                    </svg>
                </div>
                <h3 class="mv-title">Our Mission</h3>
                <p class="mv-text">
                    {{ $settings->mission_text ?? 'Discover and promote fresh new faces, connect models with global brands, and create new opportunities in the fashion and media industries.' }}
                </p>
            </div>

            <div class="mv-card">
                <div class="mv-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                </div>
                <h3 class="mv-title">Our Vision</h3>
                <p class="mv-text">
                    "{{ $settings->vision_text ?? 'To become Bangladesh’s leading creative platform where fashion, talent, and innovation come together with professionalism and authenticity.' }}"
                </p>
            </div>
        </div>

        {{-- What We Offer Section --}}
        @if($settings->what_we_offer)
        <div class="content-section anim-fade-up anim-d3">
            <h2 class="section-header">What We Offer</h2>
            <div class="prose">
                {!! $settings->what_we_offer !!}
            </div>
        </div>
        @endif

        {{-- Our Experience Section --}}
        @if($settings->our_experience)
        <div class="content-section anim-fade-up anim-d3">
            <h2 class="section-header">Our Experience</h2>
            <div class="prose">
                {!! $settings->our_experience !!}
            </div>
        </div>
        @endif

        {{-- Models Advice Section --}}
        @if($settings->models_advice)
        <div class="content-section anim-fade-up anim-d3" style="border-color: var(--gold-light); background: var(--gold-bg);">
            <h2 class="section-header" style="color: var(--gold); border-color: rgba(197, 0, 0, 0.2);">Models' Advice</h2>
            <div class="prose">
                {!! $settings->models_advice !!}
            </div>
        </div>
        @endif

    </div>
</x-app-layout>