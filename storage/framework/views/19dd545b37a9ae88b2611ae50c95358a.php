<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Terms of Service | '.e($settings->site_name ?? 'Dhaka Model Agency').'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div style="max-width: 860px; margin: 0 auto; padding: 100px 40px; font-family: 'Jost', sans-serif; color: var(--text-secondary); line-height: 1.8;">
        <div style="text-align: center; margin-bottom: 60px; padding-bottom: 40px; border-bottom: 1px solid var(--border);">
            <div style="font-size: 0.75rem; font-weight: 600; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 16px;">Legal Information</div>
            <h1 style="font-family: 'Jost', sans-serif; font-size: 3.5rem; font-weight: 300; color: var(--text-primary); line-height: 1.1;">Terms of Service</h1>
        </div>
        <p>Welcome to <strong><?php echo e($settings->site_name ?? 'Dhaka Model Agency'); ?></strong>. By accessing our website and using our services, you agree to comply with our terms and conditions.</p>
        <p><em>(You can update this content later from your admin panel or by editing this view file directly.)</em></p>
        
        <p style="margin-top: 40px;">For inquiries, please contact us at <a href="mailto:<?php echo e($settings->contact_email); ?>" style="color: var(--gold);"><?php echo e($settings->contact_email); ?></a>.</p>
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
<?php endif; ?><?php /**PATH /home/dhakamodel/dhakamodel/resources/views/pages/terms.blade.php ENDPATH**/ ?>