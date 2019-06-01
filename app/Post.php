<?php

namespace App;

use App\Tag;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'published_at',
        'category_id'
    ];

    protected $dates =  [
        'published_at'
    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * check if post has tag
     * 
     * @return bool
     */
    public function hasTag($tagId)
    {
      return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('published_at','<=',now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if(empty($search))
        {
            return $query->published();
        }

        return $query->where('title','LIKE',"%{$search}%")->published();
    }

}
