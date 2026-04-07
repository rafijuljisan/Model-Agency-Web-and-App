<x-app-layout title="Privacy Policy | {{ $settings->site_name ?? 'Dhaka Model Agency' }}">

    <style>
        .legal-shell { max-width: 860px; margin: 0 auto; padding: 100px 40px; }
        .legal-header { text-align: center; margin-bottom: 60px; padding-bottom: 40px; border-bottom: 1px solid var(--border); }
        .legal-eyebrow { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 16px; }
        .legal-title { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); line-height: 1.1; }
        .legal-content { font-family: 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem; }
        .legal-content h2 { font-family: 'Cormorant Garamond', serif; font-size: 2rem; font-weight: 500; color: var(--text-primary); margin: 48px 0 20px; }
        .legal-content h3 { font-size: 1.2rem; font-weight: 600; color: var(--text-primary); margin: 32px 0 16px; }
        .legal-content p { margin-bottom: 20px; }
        .legal-content ul { margin-bottom: 24px; padding-left: 24px; list-style: square; }
        .legal-content li { margin-bottom: 10px; padding-left: 8px; }
        .legal-content strong { color: var(--text-primary); font-weight: 500; }
        .legal-contact-box { background: var(--bg-secondary); border: 1px solid var(--border); padding: 32px; margin-top: 48px; border-radius: 4px; }
        .legal-contact-box a { color: var(--gold); text-decoration: none; }
        .legal-contact-box a:hover { text-decoration: underline; }
    </style>

    <div class="legal-shell anim-fade-up">
        <div class="legal-header">
            <div class="legal-eyebrow">Legal Information</div>
            <h1 class="legal-title">Privacy Policy</h1>
            <p style="margin-top: 16px; color: var(--text-muted);">Effective Date: December 12, 2012</p>
        </div>

        <div class="legal-content">
            <p><strong>{{ $settings->site_name ?? 'Dhaka Model Agency' }}</strong> respects your privacy and is committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data when you use our website and services.</p>

            <h2>Information We Collect</h2>
            <p>We may collect the following types of information:</p>
            <ul>
                <li><strong>Personal Information:</strong> Name, email address, phone number, date of birth, photographs, and portfolio details provided during registration.</li>
                <li><strong>Payment Information:</strong> Transaction details for registration and service fees (processed securely through authorized payment gateways).</li>
                <li><strong>Usage Data:</strong> Information about how you interact with our website, including IP address, browser type, and device information.</li>
            </ul>

            <h2>How We Use Your Information</h2>
            <p>Your data may be used for the following purposes:</p>
            <ul>
                <li>To process model registrations and verify authenticity.</li>
                <li>To communicate with you regarding updates, approvals, and services.</li>
                <li>To maintain and improve our website and services.</li>
                <li>To prevent fraudulent activities and ensure security.</li>
                <li>To showcase approved models’ portfolios (with consent).</li>
            </ul>

            <h2>Data Protection & Security</h2>
            <ul>
                <li>We use industry-standard security measures to protect your data.</li>
                <li>Your personal details and photographs will not be shared with third parties without your permission, except when required by law.</li>
                <li>Payment details are processed through secure and trusted channels.</li>
            </ul>

            <h2>Sharing of Information</h2>
            <p>We may share your information only in the following cases:</p>
            <ul>
                <li>With your consent (for modeling opportunities, collaborations, or promotions).</li>
                <li>With service providers who assist us in operating our website and services.</li>
                <li>If required by law, court order, or government regulation.</li>
            </ul>

            <h2>Your Rights</h2>
            <p>As a user, you have the right to:</p>
            <ul>
                <li>Access, update, or request deletion of your personal data.</li>
                <li>Withdraw consent at any time for promotional use of your information.</li>
                <li>Contact us regarding any privacy-related concerns.</li>
            </ul>

            <div class="legal-contact-box">
                <h3 style="margin-top: 0;">Contact Us</h3>
                <p>If you have any questions about this Privacy Policy or your personal data, please contact:</p>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li><strong>Email:</strong> <a href="mailto:{{ $settings->contact_email ?? 'dhakamodelagency.bd@gmail.com' }}">{{ $settings->contact_email ?? 'dhakamodelagency.bd@gmail.com' }}</a></li>
                    <li><strong>Phone:</strong> <a href="tel:{{ $settings->contact_phone ?? '01926960164' }}">{{ $settings->contact_phone ?? '01926960164' }}</a></li>
                    <li><strong>Website:</strong> <a href="/">{{ request()->getHost() }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>