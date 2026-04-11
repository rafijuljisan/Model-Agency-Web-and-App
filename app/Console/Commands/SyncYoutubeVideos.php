<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Video;

class SyncYoutubeVideos extends Command
{
    protected $signature = 'youtube:sync';
    protected $description = 'Sync videos from YouTube channel';

    public function handle()
    {
        $apiKey = config('services.youtube.key');
        $channelId = config('services.youtube.channel_id');


        // Get Uploads Playlist ID
        $channelResponse = Http::get("https://www.googleapis.com/youtube/v3/channels", [
            'part' => 'contentDetails',
            'id' => $channelId,
            'key' => $apiKey,
        ]);

        $uploadsPlaylistId = $channelResponse['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

        // Fetch videos from playlist
        $playlistResponse = Http::get("https://www.googleapis.com/youtube/v3/playlistItems", [
            'part' => 'snippet,contentDetails',
            'playlistId' => $uploadsPlaylistId,
            'maxResults' => 50,
            'key' => $apiKey,
        ]);

        foreach ($playlistResponse['items'] as $item) {
            $videoId = $item['contentDetails']['videoId'];
            $snippet = $item['snippet'];

            Video::updateOrCreate(
                ['url' => "https://www.youtube.com/watch?v={$videoId}"],
                [
                    'title' => $snippet['title'],
                    'description' => $snippet['description'],
                    'thumbnail' => $snippet['thumbnails']['high']['url'],
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->info('YouTube videos synced successfully!');
    }
}
