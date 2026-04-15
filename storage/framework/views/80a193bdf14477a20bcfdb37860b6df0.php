<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad): ?>
    <?php
        // Handle both external URLs and local storage uploads
        $imgSrc = str_starts_with($ad->image_path, 'http') 
            ? $ad->image_path 
            : Storage::url($ad->image_path);
    ?>

    <style>
        .ad-popup-overlay {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .ad-popup-box {
            position: relative;
            max-width: 600px;
            width: 100%;
            background: var(--bg-surface, #fff);
            border-radius: 8px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .ad-popup-close {
            position: absolute;
            top: 12px;
            right: 12px;
            width: 32px;
            height: 32px;
            background: rgba(0,0,0,0.5);
            color: #fff;
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            transition: background 0.2s;
        }
        .ad-popup-close:hover {
            background: var(--gold, #c9a96e);
        }
        .ad-popup-img {
            width: 100%;
            height: auto;
            display: block;
        }
    </style>

    
    <div x-data="{
            showPopup: false,
            adId: 'popup_ad_<?php echo e($ad->id); ?>',
            
            init() {
                // If this specific ad ID hasn't been seen, show it after 1.5 seconds
                if (!localStorage.getItem(this.adId)) {
                    setTimeout(() => {
                        this.showPopup = true;
                    }, 1500);
                }
            },
            closePopup() {
                this.showPopup = false;
                // Mark this specific ad as seen so it doesn't show again
                localStorage.setItem(this.adId, 'true');
            }
        }"
        x-show="showPopup"
        style="display: none;"
        class="ad-popup-overlay"
        x-transition.opacity.duration.500ms
    >
        
        
        <div class="ad-popup-box" 
             @click.outside="closePopup()" 
             x-show="showPopup" 
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            
            <button @click="closePopup()" class="ad-popup-close" aria-label="Close Advertisement">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad->target_url): ?>
                <a href="<?php echo e($ad->target_url); ?>" target="_blank" @click="closePopup()">
                    <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($ad->title); ?>" class="ad-popup-img">
                </a>
            <?php else: ?>
                <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($ad->title); ?>" class="ad-popup-img">
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
        </div>
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH H:\agency-app\resources\views/components/ad-popup.blade.php ENDPATH**/ ?>