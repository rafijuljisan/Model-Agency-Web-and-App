<x-app-layout title="Legal & Copyright | {{ $settings->site_name ?? 'Dhaka Model Agency' }}">
    <div style="max-width: 860px; margin: 0 auto; padding: 100px 40px; font-family: 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.8;">
        <div style="text-align: center; margin-bottom: 60px; padding-bottom: 40px; border-bottom: 1px solid var(--border);">
            <div style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 16px;">Legal Information</div>
            <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); line-height: 1.1;">Legal & Copyright</h1>
        </div>
        <p>All content, images, portfolios, and branding on this website are the exclusive property of <strong>{{ $settings->site_name ?? 'Dhaka Model Agency' }}</strong> and its respective verified talents.</p>
        <p>Unauthorized use, reproduction, or distribution of any materials without written permission is strictly prohibited and subject to legal action under the laws of Bangladesh.</p>
        
        <p style="margin-top: 40px;">Company License: <strong>{{ $settings->license_number ?? 'Pending' }}</strong></p>
    </div>
</x-app-layout>