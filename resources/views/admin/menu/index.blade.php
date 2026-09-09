@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-bold mb-6">Menu Builder</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.menu.store') }}" method="POST" class="bg-white p-6 shadow rounded mb-6">
        @csrf
        <h2 class="text-lg font-bold mb-4">Add Menu Item</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Link Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
            @forelse($menuItems as $item)
                <li class="flex justify-between items-center py-3">
                    <div>
                        <span class="font-bold text-gray-800">{{ $item->title }}</span>
                        <span class="text-sm text-gray-500 ml-2">({{ $item->target_url }})</span>
                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded ml-2">Order: {{ $item->order }}</span>
                    </div>
                    <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this menu item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Remove</button>
                    </form>
                </li>
            @empty
                <li class="py-3 text-gray-500">No menu items configured yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection