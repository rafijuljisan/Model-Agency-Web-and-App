<div>
<style>
/* Font Face for SolaimanLipi (Assuming it's not globally loaded, this ensures it works if the user has it, otherwise falls back gracefully) */
@font-face {
    font-family: 'SolaimanLipi';
    src: local('SolaimanLipi'),
         url('/fonts/SolaimanLipi.woff2') format('woff2'),
         url('/fonts/SolaimanLipi.ttf') format('truetype');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
}

/* Inherits your core form-page structure */
.form-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 48px 40px 80px;
    font-family: 'SolaimanLipi', 'Jost', sans-serif; /* Applied globally to this page */
}

.form-page-header {
    margin-bottom: 40px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--border);
}
.form-page-eyebrow {
    font-size: 1rem; /* Increased */
    font-weight: 600;
    color: var(--gold);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-page-eyebrow::before {
    content: '';
    width: 24px; height: 1px;
    background: var(--gold);
}
.form-page-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 3.2rem; /* Increased from 2.8rem */
    font-weight: 400;
    color: var(--text-primary);
    line-height: 1.2;
}
.form-page-title strong { font-weight: 700; }
.form-page-sub {
    font-size: 1.15rem; /* Increased from 0.95rem */
    color: var(--text-muted);
    margin-top: 14px;
    line-height: 1.6;
    max-width: 700px;
}

/* Casting Card Specifics */
.form-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 32px;
    transition: background 0.4s, border-color 0.4s;
    border-radius: 8px;
    overflow: hidden;
}
.form-section-header {
    padding: 24px 32px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    background: var(--bg-primary); 
}
.casting-title {
    font-family: 'SolaimanLipi', 'Jost', sans-serif;
    font-size: 2.5rem; /* Increased from 1.7rem */
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
    line-height: 1.3;
}
.casting-type {
    font-size: 1rem; /* Increased */
    font-weight: 600;
    letter-spacing: 0.1em;
    color: var(--gold);
}
.badge-urgent {
    background: rgba(197, 0, 0, 0.1);
    color: var(--gold);
    border: 1px solid rgba(197, 0, 0, 0.2);
    padding: 6px 14px;
    font-size: 1rem; /* Increased */
    font-weight: 700;
    border-radius: 4px;
    white-space: nowrap;
}
.form-section-body {
    padding: 32px;
}

/* Details Grid */
.casting-details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
}
.detail-block {
    display: flex;
    gap: 12px;
}
.detail-icon {
    width: 24px; height: 24px;
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 4px;
}
.detail-label {
    font-size: 1rem;/* Increased */
    font-weight: 600;
    color: var(--text-muted);
    margin-bottom: 4px;
}
.detail-value {
    font-size: 1.35rem; /* Increased */
    color: var(--text-primary);
    font-weight: 600;
}

/* Description & Application */
.casting-desc {
    font-size: 1.5rem; /* Increased from 1.05rem */
    line-height: 1.8;
    color: var(--text-secondary);
    margin-bottom: 32px;
    padding-bottom: 32px;
    border-bottom: 1px dashed var(--border-strong);
}
.apply-box {
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    padding: 24px;
    border-radius: 6px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}
.apply-title {
    font-size: 1.4rem; /* Increased */
    font-weight: 600;
    color: var(--text-primary);
}
.apply-steps {
    list-style: none;
    counter-reset: my-awesome-counter;
    display: flex;
    flex-direction: column;
    gap: 14px;
}
.apply-steps li {
    counter-increment: my-awesome-counter;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 1.35rem; /* Increased */
    line-height: 1.5;
    color: var(--text-secondary);
}
.apply-steps li::before {
    content: counter(my-awesome-counter) "।"; /* Bengali Dari for list numbers */
    color: var(--gold);
    font-weight: 700;
    font-size: 1rem;
    margin-top: 2px;
}
.btn-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    background: #25D366; 
    color: #fff;
    padding: 14px 28px;
    font-size: 1.2rem;
    font-weight: 600;
    border-radius: 4px;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    width: 100%;
    box-sizing: border-box;
    text-align: center;
    margin-top: 8px;
}
.btn-whatsapp:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

/* Animations */
@keyframes fade-up {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim-fade-up { animation: fade-up 0.65s ease both; }

@media (max-width: 768px) {
    .form-page {
        padding: 24px 16px 80px;
    }
    .form-page-title {
        font-size: 2rem;
    }
    .form-page-sub {
        font-size: 1rem;
    }
    .casting-details-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .form-section-header {
        flex-direction: column;
        padding: 20px 16px;
        gap: 10px;
    }
    .form-section-body {
        padding: 20px 16px;
    }
    .casting-title {
        font-size: 1.4rem;
    }
    .casting-type {
        font-size: 0.85rem;
    }
    .casting-desc {
        font-size: 1rem;
    }
    .detail-value {
        font-size: 1.05rem;
    }
    .detail-label {
        font-size: 0.85rem;
    }
    .apply-title {
        font-size: 1.1rem;
    }
    .apply-steps li {
        font-size: 1rem;
    }
    .apply-box {
        padding: 16px;
    }
    .btn-whatsapp {
        width: 100%;
        font-size: 1rem;
        padding: 13px 16px;
        justify-content: center;
        box-sizing: border-box;
    }
    .badge-urgent {
        font-size: 0.8rem;
        align-self: flex-start;
    }
}
</style>

<div class="form-page">

    
    <div class="form-page-header anim-fade-up">
        <div class="form-page-eyebrow">সুযোগসমূহ</div>
        <h1 class="form-page-title">উন্মুক্ত <strong>কাস্টিং কল</strong></h1>
        <p class="form-page-sub">টিভিসি, ফটোশুট এবং শর্ট ফিল্মের সর্বশেষ অডিশনগুলো সম্পর্কে জানুন। আমাদের আসন্ন প্রজেক্টগুলোতে যুক্ত হতে আজই আপনার পোর্টফোলিও জমা দিন।</p>
    </div>

    
    <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_top'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $attributes = $__attributesOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__attributesOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $component = $__componentOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__componentOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
    
    <div class="casting-list">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $castings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $casting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="form-section anim-fade-up" style="animation-delay: <?php echo e($index * 0.15); ?>s">
                
                
                <div class="form-section-header">
                    <div>
                        <div class="casting-type"><?php echo e($casting->type); ?></div>
                        <h2 class="casting-title"><?php echo e($casting->title); ?></h2>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($casting->status === 'Urgent' || $casting->status === 'জরুরী'): ?>
                        <div class="badge-urgent">জরুরী প্রয়োজন</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="form-section-body">
                    
                    
                    <div class="casting-details-grid">
                        <div class="detail-block">
                            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <div>
                                <div class="detail-label">বয়সের প্রয়োজনীয়তা</div>
                                <div class="detail-value"><?php echo e($casting->age_range); ?></div>
                            </div>
                        </div>

                        <div class="detail-block">
                            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            <div>
                                <div class="detail-label">লিঙ্গ</div>
                                <div class="detail-value"><?php echo e($casting->gender); ?></div>
                            </div>
                        </div>

                        <div class="detail-block">
                            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            <div>
                                <div class="detail-label">অভিজ্ঞতা</div>
                                <div class="detail-value"><?php echo e($casting->experience); ?></div>
                            </div>
                        </div>

                        <div class="detail-block">
                            <svg class="detail-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <div>
                                <div class="detail-label">শেষ সময়</div>
                                <div class="detail-value text-red-600 font-bold"><?php echo e($casting->deadline); ?></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="casting-desc">
                        <?php echo e($casting->description); ?>

                    </div>

                    
                    <div class="apply-box">
                        <div class="apply-title">কীভাবে আবেদন করবেন</div>
                        <ul class="apply-steps">
                            <li>নিশ্চিত করুন আপনার এজেন্সি প্রোফাইলটি সাম্প্রতিক ছবিসহ ১০০% সম্পন্ন।</li>
                            <li>আপনার নাম, বয়স এবং আপনি কোন চরিত্রের জন্য আবেদন করছেন তা উল্লেখ করে আমাদের একটি মেসেজ পাঠান।</li>
                            <li>২-৩টি সাম্প্রতিক, আনএডিটেড প্রাকৃতিক ছবি সংযুক্ত করুন (কোনো ভারী মেকআপ বা ফিল্টার ছাড়া)।</li>
                        </ul>
                        
                        <?php
                            // Clean the phone number for the WhatsApp API link
                            $waNumber = $settings->contact_phone ? preg_replace('/[^0-9]/', '', $settings->contact_phone) : '';
                        ?>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($waNumber): ?>
                            
                            <a href="https://wa.me/<?php echo e($waNumber); ?>?text=হ্যালো!%20আমি%20'<?php echo e(urlencode($casting->title)); ?>'%20কাস্টিংয়ের%20জন্য%20আবেদন%20করতে%20চাই।" target="_blank" rel="noopener noreferrer" class="btn-whatsapp">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                Contact on WhatsApp
                            </a>
                        <?php else: ?>
                            <div class="text-sm text-red-500 font-medium mt-2">
                                হোয়াটসঅ্যাপ আবেদন চালু করতে অনুগ্রহ করে অ্যাডমিন সেটিংসে একটি কন্টাক্ট নম্বর কনফিগার করুন।
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    </div>

                </div>
            </div>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($loop->iteration == 1): ?>
                <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_in_feed'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $attributes = $__attributesOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__attributesOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $component = $__componentOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__componentOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="text-center text-gray-500 py-16 bg-white rounded-xl border border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <p class="text-2xl font-bold text-gray-600 mb-2">No Casting Calls</p>
                <p class="text-lg mt-1">Upcoming Casting Calls will appear here, please check back later!</p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    
    <?php if (isset($component)) { $__componentOriginaled4987d3f6007db3445a6067a328a16c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaled4987d3f6007db3445a6067a328a16c = $attributes; } ?>
<?php $component = App\View\Components\AdBanner::resolve(['position' => 'casting_bottom'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ad-banner'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AdBanner::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $attributes = $__attributesOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__attributesOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaled4987d3f6007db3445a6067a328a16c)): ?>
<?php $component = $__componentOriginaled4987d3f6007db3445a6067a328a16c; ?>
<?php unset($__componentOriginaled4987d3f6007db3445a6067a328a16c); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.warning-notice','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('warning-notice'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658)): ?>
<?php $attributes = $__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658; ?>
<?php unset($__attributesOriginal5a0a0bb575ff44e4bf5d32e08d529658); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658)): ?>
<?php $component = $__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658; ?>
<?php unset($__componentOriginal5a0a0bb575ff44e4bf5d32e08d529658); ?>
<?php endif; ?>

</div>
</div><?php /**PATH H:\agency-app\resources\views/livewire/casting-page.blade.php ENDPATH**/ ?>