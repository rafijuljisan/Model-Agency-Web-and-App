<x-app-layout>
    <style>
        /* ═══════════════════════════════════════════
           AUTHENTICATION PAGES
        ═══════════════════════════════════════════ */
        .auth-container {
            max-width: 440px;
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

        /* Form Fields */
        .form-field { margin-bottom: 22px; }
        .form-field-label {
            display: block;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }
        .form-input-wrap { position: relative; }
        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px; 
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 0.9rem;
            font-weight: 300;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
            border-radius: 0;
        }
        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-bg);
        }
        .form-input::placeholder { color: var(--text-muted); opacity: 0.6; }
        .form-input-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .form-error {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #d32f2f;
            font-size: 0.68rem;
            font-weight: 500;
            margin-top: 6px;
            letter-spacing: 0.04em;
        }

        .auth-submit {
            width: 100%;
            justify-content: center;
            padding: 14px 22px;
            margin-top: 12px;
        }

        @media (max-width: 640px) {
            .auth-card { padding: 30px 20px; }
            .auth-title { font-size: 2.2rem; }
        }
    </style>

    <div class="auth-container anim-fade-up">
        
        <div class="auth-header">
            <div class="auth-eyebrow">Restricted Access</div>
            <h1 class="auth-title">Confirm <strong>Password</strong></h1>
            <p class="auth-sub">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>
        </div>

        <div class="auth-card">
            <form method="POST" action="{{ route('password.confirm') }}" novalidate>
                @csrf

                {{-- Password --}}
                <div class="form-field" style="margin-bottom: 16px;">
                    <label class="form-field-label" for="password">Password</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input id="password" type="password" name="password" class="form-input" placeholder="Enter your password" required autocomplete="current-password">
                    </div>
                    @error('password')
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-fill auth-submit">
                    Confirm Access
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-left:8px;" aria-hidden="true">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </form>
        </div>

    </div>
</x-app-layout>