<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasPages()): ?>
    <nav style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->onFirstPage()): ?>
            <span style="padding: 8px 20px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; opacity: 0.4; cursor: not-allowed;">
                ← Prev
            </span>
        <?php else: ?>
            <button wire:click="previousPage" wire:loading.attr="disabled" style="padding: 8px 20px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; cursor: pointer;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                ← Prev
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <span style="font-size: 0.78rem; color: var(--text-muted); letter-spacing: 0.1em; text-transform: uppercase;">
            Page <?php echo e($paginator->currentPage()); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($total)): ?>
                &nbsp;·&nbsp; <?php echo e(number_format($total)); ?> total
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </span>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paginator->hasMorePages()): ?>
            <button wire:click="nextPage" wire:loading.attr="disabled" style="padding: 8px 20px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; cursor: pointer;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                Next →
            </button>
        <?php else: ?>
            <span style="padding: 8px 20px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; opacity: 0.4; cursor: not-allowed;">
                Next →
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    </nav>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?><?php /**PATH H:\agency-app\resources\views/vendor/pagination/simple-custom.blade.php ENDPATH**/ ?>