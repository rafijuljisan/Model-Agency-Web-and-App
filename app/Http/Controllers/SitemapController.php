<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Editorial;
use App\Models\Setting;

class SitemapController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        if (!$settings?->sitemap_enabled) {
            abort(404);
        }

        $artists = User::role('Verified-Artist')
            ->where('verification_status', 'verified')
            ->where('academic_verification_status', 'verified')
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'))
            ->select('id', 'updated_at')
            ->get();

        $editorials = Editorial::where('is_published', true)
            ->select('id', 'slug', 'updated_at')
            ->get();

        return response()->view('sitemap', compact('artists', 'editorials'))
            ->header('Content-Type', 'application/xml');
    }
}