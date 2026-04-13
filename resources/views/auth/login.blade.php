<x-app-layout>
    <style>
        /* ═══════════════════════════════════════════
           AUTHENTICATION PAGES
        ═══════════════════════════════════════════ */
        .auth-container {
            max-width: 440px; /* Slightly narrower than register for login */
            margin: 60px auto 120px;
            padding: 0 20px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .auth-eyebrow {
            font-size: 0.85rem;
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
            font-family: 'Jost', sans-serif;
            font-size: 2.6rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 12px;
        }
        .auth-title strong { font-weight: 600; }

        /* Password Toggle Button */
        .password-toggle {
            position: absolute;
            right: 14px; 
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: color 0.2s;
        }
        .password-toggle:hover {
            color: var(--gold);
        }
        .auth-sub {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.6;
            padding: 0 20px;
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
            font-size: 0.85rem;
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
            font-size: 1.25rem;
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
            font-size: 0.85rem;
            font-weight: 500;
            margin-top: 6px;
            letter-spacing: 0.04em;
        }

        /* Login Specific: Checkbox & Links */
        .auth-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 16px;
            margin-bottom: 24px;
        }
        .custom-checkbox {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
            gap: 8px;
        }
        .custom-checkbox input {
            appearance: none;
            -webkit-appearance: none;
            width: 16px; height: 16px;
            border: 1px solid var(--border-strong);
            background: var(--bg-primary);
            border-radius: 2px;
            cursor: pointer;
            position: relative;
            transition: background 0.2s, border-color 0.2s;
            margin: 0;
        }
        .custom-checkbox input:checked {
            background: var(--gold);
            border-color: var(--gold);
        }
        .custom-checkbox input:checked::after {
            content: '';
            position: absolute;
            left: 4px; top: 1px;
            width: 4px; height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }
        .checkbox-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }
        
        .forgot-link {
            font-size: 0.85rem;
            color: var(--text-muted);
            transition: color 0.2s;
            text-decoration: none;
        }
        .forgot-link:hover { color: var(--gold); }

        .auth-submit {
            width: 100%;
            justify-content: center;
            padding: 14px 22px;
        }

        .auth-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            letter-spacing: 0.04em;
        }
        .auth-footer a {
            color: var(--text-primary);
            font-weight: 500;
            transition: color 0.2s;
            text-decoration: none;
            border-bottom: 1px solid transparent;
        }
        .auth-footer a:hover {
            color: var(--gold);
            border-color: var(--gold);
        }

        /* Session Flash (reused from profile layout) */
        .form-flash {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 20px;
            background: var(--badge-ok-bg);
            border: 1px solid var(--badge-ok-color);
            color: var(--badge-ok-color);
            font-size: 1rem;
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
            <div class="auth-eyebrow">Welcome Back</div>
            <h1 class="auth-title">Sign In to <strong>AgencyMarket</strong></h1>
            <p class="auth-sub">Access your verified talent dashboard or agency account.</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="form-flash">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                </svg>
                {{ session('status') }}
            </div>
        @endif

        <div class="auth-card">
            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                {{-- Email Address --}}
                <div class="form-field">
                    <label class="form-field-label" for="email">Email Address</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="you@example.com" required autofocus autocomplete="username">
                    </div>
                    @error('email')
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                {{-- Password --}}
                <div class="form-field" style="margin-bottom: 0;">
                    <label class="form-field-label" for="password">Password</label>
                    <div class="form-input-wrap" x-data="{ show: false }">
                        
                        {{-- Lock Icon (Left) --}}
                        <svg class="form-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        
                        {{-- Dynamic Input --}}
                        <input id="password" :type="show ? 'text' : 'password'" name="password" class="form-input" style="padding-right: 42px;" placeholder="Enter your password" required autocomplete="current-password">
                        
                        {{-- Toggle Button (Right) --}}
                        <button type="button" class="password-toggle" @click="show = !show" aria-label="Toggle password visibility">
                            {{-- Eye Icon (Shows when password is hidden) --}}
                            <svg x-show="!show" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            {{-- Eye Off Icon (Shows when password is visible) --}}
                            <svg x-show="show" style="display: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>

                    </div>
                    @error('password')
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Options Row --}}
                <div class="auth-options">
                    <label class="custom-checkbox" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span class="checkbox-label">Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            Forgot password?
                        </a>
                    @endif
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-fill auth-submit">
                    Sign In
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:8px;" aria-hidden="true">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4M10 17l5-5-5-5M15 12H3"/>
                    </svg>
                </button>
            </form>

            <div class="auth-footer">
                Don't have an account yet? <a href="{{ route('register') }}">Join as Talent</a>
            </div>
        </div>

    </div>
</x-app-layout>