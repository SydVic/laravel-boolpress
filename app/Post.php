<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'content'
    ];

        
    /**
     * createUniqueSlug
     *
     * @return unique slug string
     */
    public static function generateUniqueSlug($title) {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $slug_found = Post::where('slug', '=', $slug)->first();
        while($slug_found) {
            $slug = $base_slug . '-' . $count;
            $slug_found = Post::where('slug', '=', $slug)->first();
            $count++;
        }
        return $slug;
    }
}
