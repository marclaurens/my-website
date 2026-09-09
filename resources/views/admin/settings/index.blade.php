@extends('layouts.admin')

@section('content')
<div class="container mx-auto py-6 max-w-4xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Global Look & Feel Settings</h1>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6 space-y-6">
        @csrf
        @method('PUT')

        <!-- Site Name -->
        <div>
            <label for="site_name" class="block text-gray-700 font-medium mb-2">Site Name</label>
            <input type="text" name="settings[site_name]" id="site_name" value="{{ $settings['site_name'] ?? '' }}" class="w-full border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <!-- Primary Brand Color -->
        <div>
            <label for="primary_color" class="block text-gray-700 font-medium mb-2">Primary Brand Color</label>
            <div class="flex items-center space-x-3">
                <input type="color" name="settings[primary_color]" id="primary_color" value="{{ $settings['primary_color'] ?? '#2563eb' }}" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                <span class="text-sm text-gray-500">Used for buttons, links, and accents.</span>
            </div>
        </div>

        <!-- Header Styling Options -->
        <div class="border-t pt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Header Customization</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="header_bg_color" class="block text-gray-700 font-medium mb-2">Header Background Color</label>
                    <div class="flex items-center space-x-3">
                        <input type="color" name="settings[header_bg_color]" id="header_bg_color" value="{{ $settings['header_bg_color'] ?? '#ffffff' }}" class="h-10 w-20 border border-gray-300 rounded cursor-pointer p-1">
                        <span class="text-sm text-gray-500">Overrides default white navigation bar.</span>
                    </div>
                </div>

                <div>
                    <label for="header_image" class="block text-gray-700 font-medium mb-2">Header Background Image</label>
                    <input type="file" name="header_image" id="header_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-amber-600 mt-1">Recommended dimensions: 1920x200px (Aspect ratio ~9.6:1 or wide banner format).</p>
                    
                    @if(!empty($settings['header_image']))
                        <div class="mt-3">
                            <span class="text-xs text-gray-500 block mb-1">Current Banner:</span>
                            <img src="{{ asset('storage/' . $settings['header_image']) }}" alt="Header Banner" class="h-16 w-full object-cover rounded border">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-2.5 rounded shadow">Save Settings</button>
        </div>
    </form>
</div>
@endsection