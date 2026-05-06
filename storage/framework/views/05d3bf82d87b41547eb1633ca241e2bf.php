<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

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
            width: 24px;
            height: 1px;
            background: var(--gold);
            opacity: 0.5;
        }

        .auth-title {
            font-family: 'Jost', sans-serif;
            font-size: 3rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
            margin-bottom: 12px;
        }

        .auth-title strong {
            font-weight: 600;
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

        /* Form Fields (Reused & adapted from your design system) */
        .form-field {
            margin-bottom: 22px;
        }

        .form-field-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--text-secondary);
            margin-bottom: 8px;
        }

        .form-input-wrap {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px 12px 42px;
            /* Extra left padding for icons */
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            color: var(--text-primary);
            font-family: 'Jost', sans-serif;
            font-size: 1.2rem;
            font-weight: 300;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
            border-radius: 0;
        }

        .form-input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-bg);
        }

        .form-input::placeholder {
            color: var(--text-muted);
            opacity: 0.6;
        }

        .form-input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
        }

        .form-error {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #d32f2f;
            font-size: 0.875rem;
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

        .auth-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.875rem;
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

        @media (max-width: 640px) {
            .auth-card {
                padding: 30px 20px;
            }

            .auth-title {
                font-size: 2.2rem;
            }
        }

        /* ═══════════════════════════════════════════
           CUSTOM BANGLA FONT
        ═══════════════════════════════════════════ */
        @font-face {
            font-family: 'SolaimanLipi';
            src: url('<?php echo e(asset('fonts/SolaimanLipi.ttf')); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }

        /* ═══════════════════════════════════════════
           INSTRUCTION MODAL (POPUP)
        ═══════════════════════════════════════════ */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.is-active {
            opacity: 1;
            visibility: visible;
        }

        .instruction-modal {
            background: var(--bg-surface);
            border: 1px solid var(--gold);
            border-radius: 8px;
            max-width: 580px;
            /* Made slightly wider to fit dynamic cards nicely */
            width: 100%;
            padding: 32px 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
            transform: translateY(20px);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            max-height: 90vh;
            overflow-y: auto;
            /* Apply Bangla font to the whole modal */
            font-family: 'SolaimanLipi', 'Jost', sans-serif;
        }

        .modal-overlay.is-active .instruction-modal {
            transform: translateY(0);
        }

        .modal-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gold-bg);
            color: var(--gold);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .modal-title {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--text-primary);
            text-align: center;
            margin-bottom: 8px;
        }

        .modal-text {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 20px;
            text-align: center;
        }

        .modal-steps {
            margin-bottom: 24px;
        }

        .step-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }

        .step-number {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--gold);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 600;
            flex-shrink: 0;
            margin-top: 4px;
        }

        .step-content strong {
            display: block;
            color: var(--text-primary);
            font-size: 1.1rem;
            margin-bottom: 2px;
        }

        .step-content p {
            font-size: 0.95rem;
            color: var(--text-secondary);
            line-height: 1.4;
            margin: 0;
        }

        /* Dynamic Package Cards Styling */
        .modal-packages-title {
            font-size: 1.1rem;
            color: var(--gold);
            text-align: center;
            margin-bottom: 12px;
            font-weight: 600;
        }

        .modal-packages {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            margin-bottom: 28px;
        }

        .package-card {
            background: var(--bg-primary);
            border: 1px solid var(--border-strong);
            border-radius: 6px;
            padding: 20px;
            text-align: center;
            transition: border-color 0.3s;
            display: flex;
            flex-direction: column;
        }

        .package-card:hover {
            border-color: var(--gold);
        }

        .package-duration {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 4px;
        }

        .package-name {
            font-size: 1.2rem;
            color: var(--text-primary);
            font-weight: 600;
            margin-bottom: 8px;
        }

        .package-price {
            font-family: 'Jost', sans-serif;
            /* Keep numbers in Jost if preferred */
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--gold);
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .package-benefits {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.5;
            text-align: left;
            margin-top: auto;
        }

        .package-benefits ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .package-benefits li {
            position: relative;
            padding-left: 20px;
            margin-bottom: 6px;
        }

        .package-benefits li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--gold);
            font-weight: bold;
        }

        @media (max-width: 480px) {
            .modal-packages {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="auth-container anim-fade-up">

        <div class="auth-header">
            <div class="auth-eyebrow">Application</div>
            <h1 class="auth-title">Become a <strong>Talent</strong></h1>
            <p class="auth-sub">Create your verified profile to get discovered by brands, casting directors, and
                production houses.</p>
        </div>

        <div class="auth-card">
            <form method="POST" action="<?php echo e(route('register')); ?>" novalidate>
                <?php echo csrf_field(); ?>

                
                <div class="form-field">
                    <label class="form-field-label" for="name">Full Name</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <input id="name" type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-input"
                            placeholder="e.g. Tanvir Ahmed" required autofocus autocomplete="name">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="form-field">
                    <label class="form-field-label" for="phone">Phone Number</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7">
                            <path
                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                        </svg>
                        <input id="phone" type="text" name="phone" value="<?php echo e(old('phone')); ?>" class="form-input"
                            placeholder="e.g. 017XXXXXXXX" autocomplete="tel">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <div class="form-field">
                    <label class="form-field-label" for="email">Email Address</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-input"
                            placeholder="you@example.com" required autocomplete="username" autocapitalize="off"
                            autocorrect="off">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="form-field">
                    <label class="form-field-label" for="password">Password</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input id="password" type="password" name="password" class="form-input"
                            placeholder="Min. 8 characters" required autocomplete="new-password">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="form-field">
                    <label class="form-field-label" for="password_confirmation">Confirm Password</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path
                                d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4">
                            </path>
                        </svg>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="form-input" placeholder="Repeat your password" required autocomplete="new-password">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <button type="submit" class="btn-fill auth-submit">
                    Create Account
                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" style="margin-left:8px;"
                        aria-hidden="true">
                        <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </form>

            <div class="auth-footer">
                Already have an account? <a href="<?php echo e(route('login')); ?>">Sign in here</a>
            </div>
        </div>

    </div>
    
    <?php
        $packages = \App\Models\Package::where('is_active', true)->orderBy('price', 'asc')->get();
    ?>

    <div id="registerInstructionModal" class="modal-overlay">
        <div class="instruction-modal">

            
            <div class="modal-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    <path d="M9 12l2 2 4-4" />
                </svg>
            </div>

            
            <h3 class="modal-title">অ্যাকাউন্ট খোলার নিয়মাবলী</h3>

            
            <p class="modal-text">
                আপনি কি মডেলিং, ব্রান্ড প্রমোশন, অভিনয়, নাচ-গান বা ফটোগ্রাফিতে স্বপ্ন দেখছেন?
                তাহলে আজই <strong>Dhaka Model Agency</strong>-তে রেজিস্ট্রেশন করুন, আর শুরু করুন আপনার নতুন যাত্রা! 🎉
            </p>

            
            <div
                style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 10px; margin: 16px 0;">
                <iframe src="https://www.youtube.com/embed/57Q9hgvXpHQ?si=GNNF5ayZd9C6lD9V&controls=0"
                    title="Dhaka Model Agency" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 10px;">
                </iframe>
            </div>

            
            <div
                style="background: #faf7ff; border-radius: 12px; padding: 18px; margin-bottom: 16px; font-family: 'SolaimanLipi', sans-serif; font-size: 0.95rem; line-height: 1.9; color: #2d2d2d; text-align: left;">

                
                <div style="text-align: center; margin-bottom: 14px;">
                    <span style="font-size: 1.1rem; font-weight: 700; color: #5b21b6;">🎬 Dhaka Model Agency</span><br>
                    <span style="font-size: 0.85rem; color: #6b7280;">আপনার স্বপ্নের সঠিক প্ল্যাটফর্ম</span>
                </div>

                <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 12px 0;">

                
                <div style="margin-bottom: 14px;">
                    <div style="font-weight: 700; color: #4c1d95; margin-bottom: 8px;">✨ আপনি যা পাবেন</div>
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <div>🎭 &nbsp;নিয়মিত <strong>Casting Opportunities</strong></div>
                        <div>📸 &nbsp;<strong>Model Profile Showcase</strong> — প্রফেশনাল ছবি ও তথ্যসহ</div>
                        <div>💎 &nbsp;<strong>Exclusive Features</strong> — শুধুমাত্র মেম্বারদের জন্য</div>
                        <div>🔍 &nbsp;বিভিন্ন এজেন্সি সহজেই আপনাকে <strong>খুঁজে পাবে</strong></div>
                        <div>🎬 &nbsp;সহজেই পাবেন <strong>Casting Call</strong></div>
                    </div>
                </div>

            </div>

            
            <div class="modal-steps">
                <div class="step-item">
                    <div class="step-number">১</div>
                    <div class="step-content">
                        <strong>রেজিস্ট্রেশন করুন</strong>
                        <p>সঠিক তথ্য দিয়ে আপনার প্রাথমিক প্রোফাইল তৈরি করুন।</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">২</div>
                    <div class="step-content">
                        <strong>ডকুমেন্ট আপলোড</strong>
                        <p>অ্যাকাউন্ট ভেরিফিকেশনের জন্য আপনার ন্যাশনাল আইডি/পাসপোর্ট/জন্মসনদ আপলোড করুন।</p>
                    </div>
                </div>

                <div class="step-item">
                    <div class="step-number">৩</div>
                    <div class="step-content">
                        <strong>প্যাকেজ নির্বাচন</strong>
                        <p>প্রোফাইলটি লাইভ করতে এবং কাস্টিং কল পেতে একটি প্ল্যান সাবস্ক্রাইব করুন।</p>
                    </div>
                </div>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($packages->isNotEmpty()): ?>
                <div class="modal-packages-title">আমাদের সাবস্ক্রিপশন প্যাকেজসমূহ</div>
                <div class="modal-packages">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="package-card">
                            <div class="package-duration"><?php echo e($package->duration_months); ?> মাসের প্ল্যান</div>
                            <div class="package-name"><?php echo e($package->name); ?></div>
                            <div class="package-price">৳<?php echo e(number_format($package->price)); ?></div>
                            <div class="package-benefits">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(is_array($package->features) && count($package->features) > 0): ?>
                                    <ul>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $package->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <li><?php echo e($feature); ?></li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Premium features included.</p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <button type="button" id="closeInstructionBtn" class="btn-fill"
                style="width: 100%; justify-content: center; padding: 14px; font-family: 'SolaimanLipi', sans-serif; font-size: 1.1rem; margin-top: 8px;">
                আমি বুঝতে পেরেছি — এগিয়ে যান
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    style="margin-left: 8px;">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </button>

        </div>
    </div>

    
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById('registerInstructionModal');
            const closeBtn = document.getElementById('closeInstructionBtn');

            setTimeout(() => {
                modal.classList.add('is-active');
            }, 300);

            closeBtn.addEventListener('click', function () {
                modal.classList.remove('is-active');
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/dhakamodel/dhakamodel/resources/views/auth/register.blade.php ENDPATH**/ ?>