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
                <li class="py-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <span class="font-bold text-gray-800 text-lg">{{ $item->title }}</span>
                        <span class="text-sm text-gray-500 block md:inline md:ml-2">({{ $item->target_url }})</span>
                    </div>
                    
                    <div class="flex items-center gap-3 w-full md:w-auto justify-between md:justify-end">
                        <!-- Inline Update Form for Order -->
                        <form action="{{ route('admin.menu.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            @method('PUT')
                            <label class="text-xs text-gray-600 font-medium">Order:</label>
                            <input type="number" name="order" value="{{ $item->order }}" class="w-20 border p-1 rounded text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1.5 rounded border">Update</button>
                        </form>

                        <!-- Delete Form -->
                        <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Remove this menu item?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium px-2 py-1">Remove</button>
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