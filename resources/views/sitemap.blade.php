<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Static pages --}}
    <url><loc>{{ url('/') }}</loc><changefreq>daily</changefreq><priority>1.0</priority></url>
    <url><loc>{{ url('/artists') }}</loc><changefreq>daily</changefreq><priority>0.9</priority></url>
    <url><loc>{{ url('/casting') }}</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>
    <url><loc>{{ url('/about') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ url('/contact') }}</loc><changefreq>monthly</changefreq><priority>0.6</priority></url>
    <url><loc>{{ url('/editorial') }}</loc><changefreq>weekly</changefreq><priority>0.7</priority></url>

    {{-- Artist profiles --}}
    @foreach($artists as $artist)
    <url>
        <loc>{{ url('/artist/' . $artist->id) }}</loc>
        <lastmod>{{ $artist->updated_at->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Editorial posts --}}
    @foreach($editorials as $editorial)
    <url>
        <loc>{{ url('/editorial/' . $editorial->slug) }}</loc>
        <lastmod>{{ $editorial->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

</urlset>