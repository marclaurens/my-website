<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'page_id',
        'parent_id',
        'order',
    ];

    protected $casts = [
        'page_id'   => 'integer',
        'parent_id' => 'integer',
        'order'     => 'integer',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function getTargetUrlAttribute(): string
    {
        if ($this->page_id && $this->page) {
            return route('pages.show', $this->page->slug);
        }

        return $this->url ?? '#';
    }

    public function descendantIds(): array
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->descendantIds());
        }

        return $ids;
    }

    public static function buildTree(?Collection $items = null, ?int $parentId = null): Collection
    {
        $items = $items ?? static::with('page')->orderBy('order')->get();

        return $items
            ->filter(fn ($i) => $i->parent_id === $parentId)
            ->map(function ($item) use ($items) {
                $item->setRelation('children', static::buildTree($items, $item->id));
                return $item;
            })
            ->values();
    }
}