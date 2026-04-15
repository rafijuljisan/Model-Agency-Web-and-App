@if($ad)
    @php
        // Handle both external URLs and local storage uploads
        $imgSrc = str_starts_with($ad->image_path, 'http') 
            ? $ad->image_path 
            : Storage::url($ad->image_path);
    @endphp

    {{-- Wrapper: Forces 100% width and perfectly centers the image with a standard margin --}}
    <div class="ad-wrapper ad-{{ $position }}" style="width: 100%; display: flex; justify-content: center; margin: 24px 0;">
        
        @if($ad->target_url)
            <a href="{{ $ad->target_url }}" target="_blank" rel="noopener noreferrer" style="display: block; max-width: 100%;">
                <img src="{{ $imgSrc }}" alt="{{ $ad->title }}" style="max-width: 100%; height: auto; display: block; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            </a>
        @else
            <div style="display: block; max-width: 100%;">
                <img src="{{ $imgSrc }}" alt="{{ $ad->title }}" style="max-width: 100%; height: auto; display: block; border-radius: 4px;">
            </div>
        @endif
        
    </div>
@endif