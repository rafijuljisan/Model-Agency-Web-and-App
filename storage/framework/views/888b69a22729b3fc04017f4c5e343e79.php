<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad): ?>
    <?php
        // Handle both external URLs and local storage uploads
        $imgSrc = str_starts_with($ad->image_path, 'http') 
            ? $ad->image_path 
            : Storage::url($ad->image_path);
    ?>

    
    <div class="ad-wrapper ad-<?php echo e($position); ?>" style="width: 100%; display: flex; justify-content: center; margin: 24px 0;">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($ad->target_url): ?>
            <a href="<?php echo e($ad->target_url); ?>" target="_blank" rel="noopener noreferrer" style="display: block; max-width: 100%;">
                <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($ad->title); ?>" style="max-width: 100%; height: auto; display: block; border-radius: 4px; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            </a>
        <?php else: ?>
            <div style="display: block; max-width: 100%;">
                <img src="<?php echo e($imgSrc); ?>" alt="<?php echo e($ad->title); ?>" style="max-width: 100%; height: auto; display: block; border-radius: 4px;">
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        
    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH H:\agency-app\resources\views/components/ad-banner.blade.php ENDPATH**/ ?>