<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('order', 'asc')->get();
        $pages = Page::where('is_published', true)->get();

        return view('admin.menu.index', compact('menuItems', 'pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'url' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item removed successfully.');
    }
}