@php
    $hasChildren = $item->children && $item->children->isNotEmpty();
    $isLink      = !empty($item->url) || !empty($item->page_id);
    $href        = $item->target_url;
    $active      = request()->url() === $href;
@endphp

@if($hasChildren)
    <div
        class="relative h-full flex items-center"
        x-data="{ open: false }"
        @mouseenter="open = true"
        @mouseleave="open = false"
        @focusin="open = true"
        @focusout="if (!$el.contains($event.relatedTarget)) open = false"
    >
        @if($isLink)
            <x-nav-link :href="$href" :active="$active">
                {{ $item->title }}
            </x-nav-link>
            <button
                type="button"
                @click="open = !open"
                class="-ms-1 inline-flex items-center px-1 text-sm text-gray-400 hover:text-gray-600 focus:outline-none"
                :aria-expanded="open"
                aria-label="Toggle submenu"
            >
                <svg class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        @else
            <button
                type="button"
                @click="open = !open"
                class="inline-flex items-center px-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                :aria-expanded="open"
            >
                {{ $item->title }}
                <svg class="ms-1 h-3 w-3" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        @endif

        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-1"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-1"
            class="absolute z-50 left-0 top-full mt-0 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
            style="display: none;"
            @click.away="open = false"
        >
            <div class="py-1">
                @foreach($item->children as $child)
                    @include('partials.menu-item-dropdown', ['item' => $child])
                @endforeach
            </div>
        </div>
    </div>
@else
    <x-nav-link :href="$href" :active="$active">
        {{ $item->title }}
    </x-nav-link>
@endif