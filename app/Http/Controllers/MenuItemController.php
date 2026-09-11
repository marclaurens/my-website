<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('page')->orderBy('order')->get();
        $tree = MenuItem::buildTree($items);
        $flattened = $this->flatten($tree);
        $pages = Page::all();

        return view('admin.menu.index', compact('flattened', 'pages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'page_id'   => 'nullable|exists:pages,id',
            'url'       => 'nullable|string',
            'order'     => 'required|integer',
            'parent_id' => 'nullable|exists:menu_items,id',
        ]);

        if (!empty($validated['page_id'])) {
            $validated['url'] = null;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item added successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title'     => 'sometimes|required|string|max:255',
            'page_id'   => 'sometimes|nullable|exists:pages,id',
            'url'       => 'sometimes|nullable|string',
            'order'     => 'sometimes|required|integer',
            'parent_id' => 'sometimes|nullable|exists:menu_items,id',
        ]);

        if (array_key_exists('parent_id', $validated) && !empty($validated['parent_id'])) {
            $forbidden = array_merge([$menuItem->id], $menuItem->descendantIds());

            if (in_array((int) $validated['parent_id'], $forbidden, true)) {
                return back()
                    ->withErrors(['parent_id' => 'A menu item cannot be its own parent or a descendant of itself.'])
                    ->withInput();
            }
        }

        if (array_key_exists('page_id', $validated) && !empty($validated['page_id'])) {
            $validated['url'] = null;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        MenuItem::where('parent_id', $menuItem->id)->update(['parent_id' => null]);

        $menuItem->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item removed successfully.');
    }

    protected function flatten(Collection $items, int $depth = 0): Collection
    {
        $out = collect();

        foreach ($items as $item) {
            $out->push((object) ['item' => $item, 'depth' => $depth]);

            if ($item->children->isNotEmpty()) {
                $out = $out->merge($this->flatten($item->children, $depth + 1));
            }
        }

        return $out;
    }
}