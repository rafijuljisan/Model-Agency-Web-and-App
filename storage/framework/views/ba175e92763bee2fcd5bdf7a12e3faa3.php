<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Help Center | '.e($settings->site_name ?? 'Dhaka Model Agency').'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    <style>
        .help-shell { max-width: 900px; margin: 0 auto; padding: 100px 40px; }
        .help-header { text-align: center; margin-bottom: 60px; }
        .help-title { font-family: 'Cormorant Garamond', serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); margin-bottom: 16px; }
        
        .faq-item { border-bottom: 1px solid var(--border); padding: 24px 0; }
        .faq-q { font-size: 1.1rem; font-weight: 500; color: var(--gold); margin-bottom: 12px; font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; }
        .faq-a { color: var(--text-secondary); line-height: 1.7; font-size: 1rem; }

        .guideline-box { margin-top: 60px; display: grid; grid-template-columns: 1fr 1fr; gap: 32px; }
        .g-card { background: var(--bg-secondary); border: 1px solid var(--border); padding: 40px; }
        .g-card h3 { font-family: 'Cormorant Garamond', serif; font-size: 1.8rem; color: var(--text-primary); border-bottom: 1px solid var(--border-strong); padding-bottom: 16px; margin-bottom: 24px; }
        .g-card ul { padding-left: 20px; color: var(--text-secondary); line-height: 1.8; }
        .g-card li { margin-bottom: 12px; }
        .g-card-highlight { background: rgba(201,169,110,0.1); padding: 16px; border-left: 3px solid var(--gold); margin-top: 24px; font-size: 0.9rem; }

        .support-strip { margin-top: 60px; padding: 40px; background: var(--gold-bg); border: 1px solid var(--border-strong); text-align: center; }
        .support-title { font-family: 'Cormorant Garamond', serif; font-size: 2rem; color: var(--text-primary); margin-bottom: 20px; }
        .support-links { display: flex; justify-content: center; gap: 32px; flex-wrap: wrap; }
        .support-link { display: flex; align-items: center; gap: 8px; color: var(--text-primary); font-weight: 500; text-decoration: none; }
        .support-link:hover { color: var(--gold); }
        .support-link svg { color: var(--gold); }

        @media(max-width: 768px) {
            .guideline-box { grid-template-columns: 1fr; }
            .help-shell { padding: 60px 20px; }
        }
    </style>

    <div class="help-shell anim-fade-up">
        <div class="help-header">
            <h1 class="help-title">Help Center</h1>
            <p style="color: var(--text-muted); font-size: 1.1rem;">We are here to support you with any questions, issues, or guidance you may need.</p>
        </div>

        <div>
            <div class="faq-item">
                <div class="faq-q">1. How do I register as a model?</div>
                <div class="faq-a">Go to the Registration Page, fill out the form, and submit the required details. After payment and verification, your registration will be approved.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">2. How long does it take for registration approval?</div>
                <div class="faq-a">Registration is usually approved within 24–48 hours after we receive your payment confirmation.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">3. How can I contact the agency?</div>
                <div class="faq-a">You can contact us via WhatsApp, phone, or email. Our support team is available to assist you during working hours.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">4. Can I update my profile later?</div>
                <div class="faq-a">Yes, you can request updates or corrections by contacting our support team, or edit them directly from your Account Dashboard.</div>
            </div>
            <div class="faq-item">
                <div class="faq-q">5. Is my personal information safe?</div>
                <div class="faq-a">Absolutely. We follow strict privacy policies and NID verification protocols to keep your data secure.</div>
            </div>
        </div>

        
        <div class="guideline-box">
            <div class="g-card">
                <h3>Submission Guidelines</h3>
                <ul>
                    <li>Please make sure your payment is completed.</li>
                    <li>After completing the payment, send the screenshot on WhatsApp.</li>
                    <li>After our team approves your submission, you will receive access to your Profile Dashboard including the Photo & Video Gallery.</li>
                    <li>Please fill up your profile completely.</li>
                    <li>Very soon your profile will be activated.</li>
                    <li>According to the bundle you purchased, the agency will support you for a certain period to build your career in media.</li>
                    <li>You will not be harassed by any fake fraudsters here; the agency handles all communication safely.</li>
                </ul>
                <div class="g-card-highlight">
                    <strong>Caution:</strong> If you are contacted outside our official site and get scammed, the responsibility will not be ours.
                </div>
            </div>

            <div class="g-card" style="font-family: 'Kalpurush', sans-serif;">
                <h3>নির্দেশনাবলী</h3>
                <ul>
                    <li>আপনার পেমেন্টটা কমপ্লিট করেছেন কি না নিশ্চিত হন।</li>
                    <li>পেমেন্ট করার পরে স্ক্রিনশট পাঠান WhatsApp এ।</li>
                    <li>আপনার সাবমিশন আমাদের টিম অ্যাপ্রুভ করার পরে, ড্যাশবোর্ডে ফটো ও ভিডিও গ্যালারি অ্যাক্সেস পাবেন।</li>
                    <li>আপনার প্রোফাইলটি পূর্ণাঙ্গভাবে পূরণ করবেন।</li>
                    <li>খুব তাড়াতাড়ি আপনার প্রোফাইলটি অ্যাক্টিভ হয়ে যাবে।</li>
                    <li>আপনার কেনা বান্ডেল অনুযায়ী নির্দিষ্ট সময় পর্যন্ত এজেন্সি আপনাকে মিডিয়াতে ক্যারিয়ার গড়ার জন্য সহযোগিতা করবে।</li>
                    <li>এখানে কোনো ভুয়া প্রতারকের মাধ্যমে নাজেহাল হবেন না, এজেন্সি এই বিষয়ে সম্পূর্ণ নিরাপত্তা দেয়।</li>
                </ul>
                <div class="g-card-highlight">
                    <strong>সতর্কতা:</strong> আমাদের অফিসিয়াল সাইট ছাড়া অন্য কোথাও যোগাযোগ করে প্রতারিত হলে, তার দায়ভার আমাদের নয়।
                </div>
            </div>
        </div>

        
        <div class="support-strip">
            <h2 class="support-title">Contact Support</h2>
            <div class="support-links">
                <a href="tel:<?php echo e($settings->contact_phone); ?>" class="support-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                    <?php echo e($settings->contact_phone ?? '01926960164'); ?>

                </a>
                <a href="mailto:<?php echo e($settings->contact_email); ?>" class="support-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <?php echo e($settings->contact_email ?? 'Support Email'); ?>

                </a>
                <a href="https://wa.me/88<?php echo e(str_replace(' ', '', $settings->contact_phone ?? '01926960164')); ?>" target="_blank" class="support-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                    WhatsApp (24/7)
                </a>
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
<?php endif; ?><?php /**PATH H:\agency-app\resources\views/pages/help.blade.php ENDPATH**/ ?>