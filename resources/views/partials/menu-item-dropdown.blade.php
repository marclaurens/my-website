@php
    $hasChildren = $item->children && $item->children->isNotEmpty();
    $isLink      = !empty($item->url) || !empty($item->page_id);
    $href        = $item->target_url;
@endphp

@if($hasChildren)
    <div
        class="relative"
        x-data="{ open: false }"
        @mouseenter="open = true"
        @mouseleave="open = false"
        @focusin="open = true"
        @focusout="if (!$el.contains($event.relatedTarget)) open = false"
    >
        @if($isLink)
            <a href="{{ $href }}" class="flex items-center justify-between gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                <span>{{ $item->title }}</span>
                <svg class="h-3 w-3 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>
        @else
            <button
                type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left"
            >
                <span>{{ $item->title }}</span>
                <svg class="h-3 w-3 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="absolute left-full top-0 ms-1 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
            style="display: none;"
        >
            <div class="py-1">
                @foreach($item->children as $child)
                    @include('partials.menu-item-dropdown', ['item' => $child])
                @endforeach
            </div>
        </div>
    </div>
@else
    <a href="{{ $href }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
        {{ $item->title }}
    </a>
@endif