<?php

namespace App\Services;

use App\Models\Setting;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use FacebookAds\Object\ServerSide\CustomData;
use Illuminate\Support\Facades\Log;

class FacebookCapiService
{
    /**
     * Send a CompleteRegistration event to Facebook CAPI
     */
    public function sendRegistrationEvent(array $userDataInfo, $batchFee, $sourceUrl, $eventId = null)
    {
        try {
            $settings = Setting::first();

            $accessToken = $settings->facebook_capi_token ?? null;
            $pixelId = $settings->facebook_pixel_id ?? null;
            $testCode = $settings->facebook_test_event_code ?? null;

            // Abort silently if credentials aren't set in the admin panel yet
            if (!$accessToken || !$pixelId) {
                return false;
            }

            // 1. Initialize Facebook API
            $api = Api::init(null, null, $accessToken);
            $api->setLogger(new CurlLogger());

            // 2. Prepare User Data (Facebook requires SHA256 hashing for personal data)
            $userData = (new UserData())
                ->setClientIpAddress(request()->ip())
                ->setClientUserAgent(request()->userAgent());

            if (!empty($userDataInfo['email'])) {
                $userData->setEmails([hash('sha256', strtolower(trim($userDataInfo['email'])))]);
            }
            if (!empty($userDataInfo['phone'])) {
                // Strip out non-numeric characters for better matching before hashing
                $cleanPhone = preg_replace('/[^0-9]/', '', $userDataInfo['phone']);
                $userData->setPhones([hash('sha256', $cleanPhone)]);
            }

            // 3. Prepare Custom Data (Tracking the batch fee value)
            $customData = (new CustomData())
                ->setCurrency('BDT')
                ->setValue((float) $batchFee);

            // 4. Prepare the Event
            $event = (new Event())
                ->setEventName('CompleteRegistration')
                ->setEventTime(time())
                ->setEventSourceUrl($sourceUrl)
                ->setUserData($userData)
                ->setCustomData($customData)
                ->setActionSource(ActionSource::WEBSITE);

            // Add Deduplication ID here!
            if ($eventId) {
                $event->setEventId($eventId); 
            }

            // 5. Prepare the Request payload
            $request = (new EventRequest($pixelId))
                ->setEvents([$event]);

            // Add the Test Event Code if you configured one in the admin panel
            if (!empty($testCode)) {
                $request->setTestEventCode($testCode);
            }

            // 6. Send the Request
            $response = $request->execute();
            
            return true;

        } catch (\Exception $e) {
            // Log the error so you can debug later, but DO NOT crash the user's application process
            Log::error('Facebook CAPI Error: ' . $e->getMessage());
            return false;
        }
    }
}