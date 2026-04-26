<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\PhotocardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotocardController extends Controller
{
    public function __construct(private PhotocardService $service) {}

    /**
     * Generate & download a single photocard.
     * Allowed: the owner themselves, or any Super-Admin.
     */
    public function download(Request $request, User $artist)
    {
        $user = $request->user();

        $isOwner = $user && $user->id === $artist->id;
        $isAdmin = $user && $user->hasRole('Super-Admin');

        if (!$isOwner && !$isAdmin) {
            abort(403);
        }

        $path = $this->service->generate($artist);

        return Storage::disk('public')->download(
            $path,
            \Illuminate\Support\Str::slug($artist->name) . '-photocard.jpg'
        );
    }

    /**
     * Admin: bulk-generate all verified artists with active subscriptions.
     */
    public function bulkGenerate(Request $request)
    {
        abort_unless($request->user()?->hasRole('Super-Admin'), 403);

        $artists = User::role('Verified-Artist')
            ->whereHas('subscriptions', fn($q) => $q->where('status', 'active'))
            ->get();

        foreach ($artists as $artist) {
            // Queue this in production — for now run synchronously
            $this->service->generate($artist);
        }

        return back()->with('success', 'Bulk generation complete for ' . $artists->count() . ' artists.');
    }

    /**
     * Force-regenerate (ignore cache). Admin only.
     */
    public function regenerate(Request $request, User $artist)
    {
        abort_unless($request->user()?->hasRole('Super-Admin'), 403);

        // Clear cached path so service skips cache check
        $artist->update(['photocard_path' => null, 'photocard_generated_at' => null]);

        $path = $this->service->generate($artist);

        return Storage::disk('public')->download(
            $path,
            \Illuminate\Support\Str::slug($artist->name) . '-photocard.jpg'
        );
    }
}