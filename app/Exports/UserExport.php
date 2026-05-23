<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserExport
{
    public function __construct(private Collection $users) {}

    public function download(): StreamedResponse
    {
        $headers = [
            'Member ID',
            'Name',
            'Email',
            'Phone',
            'Gender',
            'Date of Birth',
            'Country',
            'District',
            'Upazila',
        ];

        $callback = function () use ($headers) {
            $handle = fopen('php://output', 'w');

            // Write header row
            fputcsv($handle, $headers);

            // Write data rows
            foreach ($this->users as $user) {
                $profile = $user->profile;

                fputcsv($handle, [
                    $user->member_id ?? '—',
                    $user->name,
                    $user->email,
                    $user->phone ?? '—',
                    $profile?->gender ?? '—',
                    $profile?->date_of_birth
                        ? Carbon::parse($profile->date_of_birth)->format('d M Y')
                        : '—',
                    $profile?->country ?? '—',
                    $profile?->district ?? '—',
                    $profile?->upazila ?? '—',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_' . now()->format('Y-m-d_His') . '.csv"',
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0',
        ]);
    }
}
