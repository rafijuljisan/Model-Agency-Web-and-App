<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Editorial;
use App\Models\Setting;
use App\Models\GroomingBatch;

class SitemapController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        if (!$settings?->sitemap_enabled) {
            abort(404);
        }

        // Artist profiles — verified + active subscription
        $artists = User::role('Verified-Artist')
            ->where('verification_status', 'verified')
            ->where('nid_back_verification_status', 'verified')
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'))
            ->select('id', 'updated_at')
            ->get();

        // Editorial posts
        $editorials = Editorial::where('is_published', true)
            ->select('id', 'slug', 'updated_at', 'published_at')
            ->get();

        // Grooming batch detail pages — active batches only
        $groomingBatches = GroomingBatch::where('is_active', true)
            ->select('id', 'updated_at')
            ->get();

        return response()->view('sitemap', compact('artists', 'editorials', 'groomingBatches'))
            ->header('Content-Type', 'application/xml');
    }
}