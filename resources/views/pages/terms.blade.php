<x-app-layout title="Terms of Service | {{ $settings->site_name ?? 'Dhaka Model Agency' }}">
    <div style="max-width: 860px; margin: 0 auto; padding: 100px 40px; font-family: 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.8;">
        <div style="text-align: center; margin-bottom: 60px; padding-bottom: 40px; border-bottom: 1px solid var(--border);">
            <div style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 16px;">Legal Information</div>
            <h1 style="font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); line-height: 1.1;">Terms of Service</h1>
        </div>
        <p>Welcome to <strong>{{ $settings->site_name ?? 'Dhaka Model Agency' }}</strong>. By accessing our website and using our services, you agree to comply with our terms and conditions.</p>
        <p><em>(You can update this content later from your admin panel or by editing this view file directly.)</em></p>
        
        <p style="margin-top: 40px;">For inquiries, please contact us at <a href="mailto:{{ $settings->contact_email }}" style="color: var(--gold);">{{ $settings->contact_email }}</a>.</p>
    </div>
</x-app-layout>