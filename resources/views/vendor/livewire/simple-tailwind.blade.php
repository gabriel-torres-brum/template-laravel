<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 bg-white border rounded-md cursor-default select-none text-slate-500 border-slate-300">
                        {!! __('pagination.previous') !!}
                    </span>
                @else
                    @if(method_exists($paginator,'getCursorName'))
                        <button dusk="previousPage" wire:click="setPage('{{$paginator->previousCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                                {!! __('pagination.previous') !!}
                        </button>
                    @else
                        <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                                {!! __('pagination.previous') !!}
                        </button>
                    @endif
                @endif
            </span>

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    @if(method_exists($paginator,'getCursorName'))
                        <button dusk="nextPage" wire:click="setPage('{{$paginator->nextCursor()->encode()}}','{{ $paginator->getCursorName() }}')" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                                {!! __('pagination.next') !!}
                        </button>
                    @else
                        <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 transition duration-150 ease-in-out bg-white border rounded-md text-slate-700 border-slate-300 hover:text-slate-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-slate-100 active:text-slate-700">
                                {!! __('pagination.next') !!}
                        </button>
                    @endif
                @else
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 bg-white border rounded-md cursor-default select-none text-slate-500 border-slate-300">
                        {!! __('pagination.next') !!}
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>