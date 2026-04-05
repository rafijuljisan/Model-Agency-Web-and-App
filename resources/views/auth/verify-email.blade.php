<x-app-layout>
    <style>
        /* ═══════════════════════════════════════════
           AUTHENTICATION PAGES
        ═══════════════════════════════════════════ */
        .auth-container {
            max-width: 480px;
            margin: 60px auto 120px;
            padding: 0 20px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .auth-eyebrow {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .auth-eyebrow::before,
        .auth-eyebrow::after {
            content: '';
            width: 24px; height: 1px;
            background: var(--gold);
            opacity: 0.5;
        }

        .auth-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.6rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 16px;
        }
        .auth-title strong { font-weight: 600; }

        .auth-sub {
            font-size: 0.85rem;
            color: var(--text-muted);
            line-height: 1.6;
            padding: 0 10px;
        }

        .auth-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 40px;
            box-shadow: var(--shadow-sm);
        }

        .auth-submit {
            width: 100%;
            justify-content: center;
            padding: 14px 22px;
        }

        .auth-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.75rem;
            color: var(--text-muted);
            letter-spacing: 0.04em;
        }
        
        /* Logout button styling to look like a link */
        .auth-logout-btn {
            background: none;
            border: none;
            border-bottom: 1px solid transparent;
            padding: 0;
            font-family: inherit;
            font-size: inherit;
            color: var(--text-primary);
            font-weight: 500;
            cursor: pointer;
            transition: color 0.2s, border-color 0.2s;
        }
        .auth-logout-btn:hover {
            color: var(--gold);
            border-color: var(--gold);
        }

        /* Session Flash */
        .form-flash {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 20px;
            background: var(--badge-ok-bg);
            border: 1px solid var(--badge-ok-color);
            color: var(--badge-ok-color);
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            margin-bottom: 24px;
        }

        @media (max-width: 640px) {
            .auth-card { padding: 30px 20px; }
            .auth-title { font-size: 2.2rem; }
        }
    </style>

    <div class="auth-container anim-fade-up">
        
        <div class="auth-header">
            <div class="auth-eyebrow">Almost There</div>
            <h1 class="auth-title">Verify <strong>Email</strong></h1>
            <p class="auth-sub">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>

        {{-- Verification Link Sent Flash Message --}}
        @if (session('status') == 'verification-link-sent')
            <div class="form-flash">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="auth-card">
            {{-- Resend Verification Form --}}
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-fill auth-submit">
                    Resend Verification Email
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:8px;" aria-hidden="true">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </button>
            </form>

            {{-- Logout Form --}}
            <div class="auth-footer">
                Wrong account? 
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="auth-logout-btn">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>