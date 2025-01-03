<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'image', 'text', 'description', 'date', 'type', 'posted', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->morphByMany(Tag::class, 'taggable');
    }

    public function getImageUrl()
    {
        return URL::asset('image/post/' . $this->image);
    }
}
