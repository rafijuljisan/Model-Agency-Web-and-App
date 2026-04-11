@if ($paginator->hasPages())
    <nav style="display: flex; align-items: center; justify-content: center; gap: 6px; flex-wrap: wrap;">
        
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 8px 16px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.8rem; opacity: 0.4; cursor: not-allowed;">
                ←
            </span>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" style="padding: 8px 16px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                ←
            </button>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span style="padding: 8px 16px; color: var(--text-muted); font-size: 0.8rem;">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 8px 16px; background: var(--gold); border: 1px solid var(--gold); color: #fff; font-family: 'Jost', sans-serif; font-size: 0.8rem; font-weight: 600; cursor: default;">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" style="padding: 8px 16px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" style="padding: 8px 16px; border: 1px solid var(--border-strong); color: var(--text-primary); background: var(--bg-surface); font-family: 'Jost', sans-serif; font-size: 0.8rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'" onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-primary)'">
                →
            </button>
        @else
            <span style="padding: 8px 16px; border: 1px solid var(--border); color: var(--text-muted); font-family: 'Jost', sans-serif; font-size: 0.8rem; opacity: 0.4; cursor: not-allowed;">
                →
            </span>
        @endif

    </nav>
@endif