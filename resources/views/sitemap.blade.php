{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- ===================== --}}
    {{-- STATIC PAGES          --}}
    {{-- ===================== --}}

    {{-- Priority: Critical --}}
    @foreach([
        ['url' => '/',            'freq' => 'daily',   'priority' => '1.0'],
        ['url' => '/artists',     'freq' => 'daily',   'priority' => '0.9'],
        ['url' => '/grooming-lab','freq' => 'daily',   'priority' => '0.9'],
        ['url' => '/casting',     'freq' => 'weekly',  'priority' => '0.8'],
        ['url' => '/editorial',   'freq' => 'daily',   'priority' => '0.8'],
        ['url' => '/gallery',     'freq' => 'weekly',  'priority' => '0.7'],
        ['url' => '/videos',      'freq' => 'weekly',  'priority' => '0.7'],
        ['url' => '/pricing',     'freq' => 'weekly',  'priority' => '0.7'],
        ['url' => '/about',       'freq' => 'monthly', 'priority' => '0.6'],
        ['url' => '/contact',     'freq' => 'monthly', 'priority' => '0.6'],
        ['url' => '/help',        'freq' => 'monthly', 'priority' => '0.5'],
        ['url' => '/privacy',     'freq' => 'yearly',  'priority' => '0.3'],
        ['url' => '/terms',       'freq' => 'yearly',  'priority' => '0.3'],
        ['url' => '/legal',       'freq' => 'yearly',  'priority' => '0.3'],
    ] as $page)
    <url>
        <loc>{{ url($page['url']) }}</loc>
        <changefreq>{{ $page['freq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
    @endforeach

    {{-- ===================== --}}
    {{-- ARTIST PROFILES       --}}
    {{-- ===================== --}}
    @foreach($artists as $artist)
    <url>
        <loc>{{ url('/artist/' . $artist->id) }}</loc>
        <lastmod>{{ $artist->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- ===================== --}}
    {{-- EDITORIAL POSTS       --}}
    {{-- ===================== --}}
    @foreach($editorials as $editorial)
    <url>
        <loc>{{ url('/editorial/' . $editorial->slug) }}</loc>
        <lastmod>{{ $editorial->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- ===================== --}}
    {{-- GROOMING BATCH PAGES  --}}
    {{-- ===================== --}}
    @foreach($groomingBatches as $batch)
    <url>
        <loc>{{ url('/grooming-lab/' . $batch->id) }}</loc>
        <lastmod>{{ $batch->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>