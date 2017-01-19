<?php 

namespace Leafr\Portfolio;

use Carbon\Carbon;
use Leafr\Core\LeafrModel as Model;

class PortfolioItem extends Model
{
    protected $casts = [
        'meta' => 'json'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'published_on'
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'meta',
        'user_id',
        'published_on'
    ];

    public function author()
    {
        return $this->belongsTo('Leafr\Core\User', 'user_id', 'id');
    }

    public function medias()
    {
        return $this->morphToMany('Leafr\Core\Media', 'mediable');
    }

    public function scopePublished($query)
    {
        return $query->where('published_on', '<=', date('Y-m-d H:i:s'));
    }

    public function meta()
    {
        return json_decode($this->meta);
    }

    public function addMedia($file, $path = 'post-images')
    {
        $media = (new \Leafr\Core\Media)->prepare([
            'name' => $this->title,
            'path' => $path
        ], $file);

        $this->medias()->attach($media->id);

        return $this;
    }
}
