<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Video;

class SyncYoutubeVideos extends Command
{
    protected $signature = 'youtube:sync';
    protected $description = 'Sync all videos from YouTube channel';

    public function handle()
    {
        $apiKey = config('services.youtube.key');
        $channelId = config('services.youtube.channel_id');

        $this->info('Starting YouTube sync...');

        // 1. Get Uploads Playlist ID
        $channelResponse = Http::get("https://www.googleapis.com/youtube/v3/channels", [
            'part' => 'contentDetails',
            'id' => $channelId,
            'key' => $apiKey,
        ]);

        if (!$channelResponse->successful() || empty($channelResponse['items'])) {
            $this->error('Failed to retrieve channel details.');
            return;
        }

        $uploadsPlaylistId = $channelResponse['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
        $nextPageToken = null;
        $totalSynced = 0;

        // 2. Fetch videos using pagination
        do {
            $queryParams = [
                'part' => 'snippet,contentDetails',
                'playlistId' => $uploadsPlaylistId,
                'maxResults' => 50,
                'key' => $apiKey,
            ];

            if ($nextPageToken) {
                $queryParams['pageToken'] = $nextPageToken;
            }

            $playlistResponse = Http::get("https://www.googleapis.com/youtube/v3/playlistItems", $queryParams);

            if (!$playlistResponse->successful()) {
                $this->error('Failed to fetch playlist items on token: ' . $nextPageToken);
                break;
            }

            $data = $playlistResponse->json();

            foreach ($data['items'] as $item) {
                $videoId = $item['contentDetails']['videoId'];
                $snippet = $item['snippet'];

                // Capture the exact time the video was published on YouTube
                $publishedAt = \Carbon\Carbon::parse($item['contentDetails']['videoPublishedAt'])
                    ->setTimezone(config('app.timezone'))
                    ->format('Y-m-d H:i:s');

                Video::updateOrCreate(
                    ['url' => "https://www.youtube.com/watch?v={$videoId}"],
                    [
                        'title' => $snippet['title'],
                        'description' => $snippet['description'],
                        'thumbnail' => $snippet['thumbnails']['high']['url'] ?? $snippet['thumbnails']['default']['url'] ?? null,
                        'is_active' => true,
                        'created_at' => $publishedAt, // Force Laravel to use the YouTube date
                    ]
                );

                $totalSynced++;
            }

            // Update the token for the next iteration. It will be null if there are no more pages.
            $nextPageToken = $data['nextPageToken'] ?? null;

        } while ($nextPageToken);

        $this->info("YouTube videos synced successfully! Total synced: {$totalSynced}");
    }
}