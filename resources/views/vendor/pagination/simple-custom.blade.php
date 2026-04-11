@if ($paginator->hasPages())
    <nav style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
        
        @if ($paginator->onFirstPage())
            <span style="padding: 8px 20px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; opacity: 0.4; cursor: not-allowed;">
                ← Prev
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" style="padding: 8px 20px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; cursor: pointer;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                ← Prev
            </button>
        @endif

        {{-- Page + total info --}}
        <span style="font-size: 0.78rem; color: var(--text-muted); letter-spacing: 0.1em; text-transform: uppercase;">
            Page {{ $paginator->currentPage() }}
            @isset($total)
                &nbsp;·&nbsp; {{ number_format($total) }} total
            @endisset
        </span>

        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" style="padding: 8px 20px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; cursor: pointer;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                Next →
            </button>
        @else
            <span style="padding: 8px 20px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.78rem; letter-spacing: 0.14em; text-transform: uppercase; opacity: 0.4; cursor: not-allowed;">
                Next →
            </span>
        @endif

    </nav>
@endif