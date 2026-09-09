<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'is_published',
        'image_path',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::deleting(function (Post $post) {
            // 1. Delete the cover image if present
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            // 2. Extract and delete all inline CKEditor images embedded in the body HTML
            if ($post->body) {
                preg_match_all('/storage\/(editor-images\/[^\s"\'\>]+)/i', $post->body, $matches);

                if (!empty($matches[1])) {
                    foreach ($matches[1] as $imagePath) {
                        Storage::disk('public')->delete($imagePath);
                    }
                }
            }
        });
    }
}