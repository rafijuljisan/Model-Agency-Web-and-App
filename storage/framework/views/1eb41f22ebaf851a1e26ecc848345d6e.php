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
            font-family: 'Jost', sans-serif;
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

        .auth-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.75rem;
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
            <div class="auth-eyebrow">Recovery</div>
            <h1 class="auth-title">Forgot <strong>Password?</strong></h1>
            <p class="auth-sub">
                <?php echo e(__('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.')); ?>

            </p>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
            <div class="form-flash">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                </svg>
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="auth-card">
            <form method="POST" action="<?php echo e(route('password.email')); ?>" novalidate>
                <?php echo csrf_field(); ?>

                
                <div class="form-field">
                    <label class="form-field-label" for="email">Email Address</label>
                    <div class="form-input-wrap">
                        <svg class="form-input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" class="form-input" placeholder="you@example.com" required autofocus autocomplete="username">
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="form-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <?php echo e($message); ?>

                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <button type="submit" class="btn-fill auth-submit">
                    Email Password Reset Link
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:8px;" aria-hidden="true">
                        <line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>

            <div class="auth-footer">
                Remember your password? <a href="<?php echo e(route('login')); ?>">Back to Sign In</a>
            </div>
        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/dhakamodel/dhakamodel/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>