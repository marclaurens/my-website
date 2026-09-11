@php
    $hasChildren = $item->children && $item->children->isNotEmpty();
    $isLink      = !empty($item->url) || !empty($item->page_id);
    $href        = $item->target_url;
    $padLeft     = 16 + ($depth * 16);
@endphp

@if($hasChildren)
    <div x-data="{ open: false }">
        <div class="flex items-center">
            @if($isLink)
                <a
                    href="{{ $href }}"
                    class="flex-1 block pe-2 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 transition duration-150 ease-in-out"
                    style="padding-left: {{ $padLeft }}px;"
                >
                    {{ $item->title }}
                </a>
                <button
                    type="button"
                    @click="open = !open"
                    class="px-3 py-2 text-gray-500 hover:text-gray-800 focus:outline-none"
                    :aria-expanded="open"
                    aria-label="Toggle submenu"
                >
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            @else
                <button
                    type="button"
                    @click="open = !open"
                    class="flex-1 flex items-center justify-between pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
                    style="padding-left: {{ $padLeft }}px;"
                    :aria-expanded="open"
                >
                    <span>{{ $item->title }}</span>
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif
        </div>

        <div x-show="open" class="bg-gray-50">
            @foreach($item->children as $child)
                @include('partials.menu-item-mobile', ['item' => $child, 'depth' => $depth + 1])
            @endforeach
        </div>
    </div>
@else
    <a
        href="{{ $href }}"
        class="block pe-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none transition duration-150 ease-in-out"
        style="padding-left: {{ $padLeft }}px;"
    >
        {{ $item->title }}
    </a>
@endif