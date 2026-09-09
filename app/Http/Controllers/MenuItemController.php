<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('order')->get();
        $pages = Page::all();
        
        return view('admin.menu.index', compact('menuItems', 'pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'page_id' => 'nullable|exists:pages,id',
            'url' => 'nullable|string',
            'order' => 'required|integer',
        ]);

        if (!empty($validated['page_id'])) {
            $page = Page::find($validated['page_id']);
            $validated['target_url'] = '/page/' . $page->slug;
        } else {
            $validated['target_url'] = $validated['url'] ?? '#';
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'order' => 'required|integer',
        ]);

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu order updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item removed successfully.');
    }
}