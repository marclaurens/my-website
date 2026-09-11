@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Menu Builder</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" class="bg-white p-6 shadow rounded mb-6">
        @csrf
        <h2 class="text-lg font-bold mb-4">Add Menu Item</h2>
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Link Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Parent</label>
                <select name="parent_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">— Top level —</option>
                    @foreach($flattened as $row)
                        <option value="{{ $row->item->id }}">{{ str_repeat('— ', $row->depth) }}{{ $row->item->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Link to Dynamic Page</label>
                <select name="page_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Custom URL --</option>
                    @foreach($pages as $page)
                        <option value="{{ $page->id }}">{{ $page->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Custom URL (if no page chosen)</label>
                <input type="text" name="url" placeholder="https://..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Display Order</label>
                <input type="number" name="order" value="0" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded">Add Link to Menu</button>
    </form>

    <div class="bg-white shadow rounded p-6">
        <h2 class="text-lg font-bold mb-4">Current Navigation Items</h2>
        <ul class="divide-y divide-gray-200">
            @forelse($flattened as $row)
                @php $item = $row->item; $depth = $row->depth; @endphp
                <li class="py-4" style="padding-left: {{ $depth * 24 }}px;" x-data="{ editing: false }">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            @if($depth > 0)
                                <span class="text-gray-400 me-1">↳</span>
                            @endif
                            <span class="font-bold text-gray-800 text-lg">{{ $item->title }}</span>
                            <span class="text-sm text-gray-500 block md:inline md:ml-2">({{ $item->target_url }})</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                            <button
                                type="button"
                                @click="editing = !editing"
                                class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded border"
                                x-text="editing ? 'Cancel' : 'Edit'"
                            ></button>

                            <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this menu item? Any children will be promoted to the top level.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1">Remove</button>
                            </form>
                        </div>
                    </div>

                    <div x-show="editing" style="display: none;" class="mt-4 bg-gray-50 border rounded p-4">
                        <form action="{{ route('admin.menu.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                                <div>
                                    <label class="block text-sm font-medium mb-1">Link Title</label>
                                    <input type="text" name="title" value="{{ $item->title }}" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Parent</label>
                                    <select name="parent_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">— Top level —</option>
                                        @foreach($flattened as $other)
                                            @php $otherItem = $other->item; @endphp
                                            @if($otherItem->id === $item->id)
                                                @continue
                                            @endif
                                            @if(in_array($otherItem->id, $item->descendantIds(), true))
                                                @continue
                                            @endif
                                            <option value="{{ $otherItem->id }}" {{ (int)$item->parent_id === (int)$otherItem->id ? 'selected' : '' }}>
                                                {{ str_repeat('— ', $other->depth) }}{{ $otherItem->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Link to Dynamic Page</label>
                                    <select name="page_id" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Custom URL --</option>
                                        @foreach($pages as $page)
                                            <option value="{{ $page->id }}" {{ (int)$item->page_id === (int)$page->id ? 'selected' : '' }}>{{ $page->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Custom URL (if no page chosen)</label>
                                    <input type="text" name="url" value="{{ $item->url }}" placeholder="https://..." class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Display Order</label>
                                    <input type="number" name="order" value="{{ $item->order }}" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>

                            <div class="mt-4 flex items-center gap-2">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded">Save Changes</button>
                                <button type="button" @click="editing = false" class="text-gray-600 hover:text-gray-800 text-sm font-medium px-3 py-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                </li>
            @empty
                <li class="py-3 text-gray-500">No menu items configured yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection