<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TikTokCapiService
{
    private const API_URL = 'https://business-api.tiktok.com/open_api/v1.3/event/track/';

    /**
     * Send a CompleteRegistration event to TikTok Events API
     */
    public function sendRegistrationEvent(array $userDataInfo, $batchFee, $sourceUrl, $eventId = null)
    {
        try {
            $settings = Setting::first();

            $pixelId      = $settings->tiktok_pixel_id ?? null;
            $accessToken  = $settings->tiktok_access_token ?? null;
            $testCode     = $settings->tiktok_test_event_code ?? null;

            // Abort silently if credentials aren't configured yet
            if (!$pixelId || !$accessToken) {
                return false;
            }

            // 1. Prepare hashed user data (TikTok requires SHA256, same as Facebook)
            $userData = [
                'ip'         => request()->ip(),
                'user_agent' => request()->userAgent(),
            ];

            if (!empty($userDataInfo['email'])) {
                $userData['email'] = hash('sha256', strtolower(trim($userDataInfo['email'])));
            }

            if (!empty($userDataInfo['phone'])) {
                $cleanPhone = preg_replace('/[^0-9]/', '', $userDataInfo['phone']);
                $userData['phone_number'] = hash('sha256', $cleanPhone);
            }

            // 2. Build the event payload
            $event = [
                'event'            => 'CompleteRegistration',
                'event_time'       => time(),
                'event_id'         => $eventId ?? (string) Str::uuid(),
                'event_source_url' => $sourceUrl,
                'user'             => $userData,
                'properties'       => [
                    'currency' => 'BDT',
                    'value'    => (float) $batchFee,
                ],
            ];

            // 3. Build the full request body
            $payload = [
                'pixel_code' => $pixelId,
                'event_source' => 'web',
                'data'       => [$event],
            ];

            // Add test event code if configured
            if (!empty($testCode)) {
                $payload['test_event_code'] = $testCode;
            }

            // 4. Send the request
            $response = Http::withHeaders([
                'Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ])->post(self::API_URL, $payload);

            // 5. Check the response
            if ($response->failed()) {
                Log::error('TikTok CAPI HTTP Error: ' . $response->status() . ' — ' . $response->body());
                return false;
            }

            $body = $response->json();

            if (($body['code'] ?? -1) !== 0) {
                Log::error('TikTok CAPI API Error: ' . ($body['message'] ?? 'Unknown error'), $body);
                return false;
            }

            return true;

        } catch (\Exception $e) {
            // Log but never crash the user's flow
            Log::error('TikTok CAPI Exception: ' . $e->getMessage());
            return false;
        }
    }
}
