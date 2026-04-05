<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http; // Need this for the web scraper

class Video extends Model
{
    protected $guarded = [];

    /**
     * Intercept the saving process to automatically scrape Facebook thumbnails!
     */
    protected static function booted()
    {
        static::saving(function ($video) {
            // Only scrape if it's a Facebook link AND the admin didn't manually upload a thumbnail
            if (!$video->thumbnail && (str_contains($video->url, 'facebook.com') || str_contains($video->url, 'fb.watch'))) {
                
                try {
                    // Pretend to be a real web browser so Facebook doesn't block us
                    $response = Http::withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
                    ])->get($video->url);

                    $html = $response->body();

                    // Use Regex to find the hidden <meta property="og:image" content="..."> tag
                    if (preg_match('/<meta property="og:image" content="([^"]+)"/', $html, $matches)) {
                        // Decode the messy Facebook URL and save it directly to the thumbnail column!
                        $video->thumbnail = html_entity_decode($matches[1]);
                    }
                } catch (\Exception $e) {
                    // If Facebook blocks the request, fail silently and rely on the fallback
                }
            }
        });
    }

    public function getEmbedUrlAttribute()
    {
        $url = $this->url;

        if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $url, $match);
            $youtube_id = $match[1] ?? null;
            if ($youtube_id) {
                return "https://www.youtube.com/embed/{$youtube_id}?autoplay=1";
            }
        }

        if (str_contains($url, 'facebook.com') || str_contains($url, 'fb.watch')) {
            return "https://www.facebook.com/plugins/video.php?href=" . urlencode($url) . "&show_text=false&autoplay=1";
        }

        return null;
    }

    public function getSmartThumbnailAttribute()
    {
        // 1. Check if we have a thumbnail in the database (either Uploaded OR Scraped)
        if ($this->thumbnail) {
            // If the thumbnail starts with 'http', it means our scraper caught a Facebook image!
            if (str_starts_with($this->thumbnail, 'http')) {
                return $this->thumbnail;
            }
            // Otherwise, it's a locally uploaded file from Filament
            return asset('storage/' . $this->thumbnail);
        }

        // 2. YouTube Auto-fetch
        if (str_contains($this->url, 'youtube.com') || str_contains($this->url, 'youtu.be')) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $this->url, $match);
            $youtube_id = $match[1] ?? null;
            if ($youtube_id) {
                return "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
            }
        }

        // 3. Fallback (If Facebook blocks the scraper and you didn't upload an image)
        return 'https://ui-avatars.com/api/?name=Video+Play&background=1a1414&color=c50000&size=512&font-size=0.15';
    }
    // Add this to the bottom of app/Models/Video.php
    public function getIsFacebookAttribute()
    {
        return str_contains($this->url, 'facebook.com') || str_contains($this->url, 'fb.watch');
    }
}