<?php

namespace Leafr\Core;

use Illuminate\Http\UploadedFile;

class Media extends LeafrModel
{
    protected $table = 'media';

    protected $fillable = [
        'title',
        'description',
        'mime',
        'extension',
        'filename',
        'size',
        'path',
        'meta'
    ];

    public function products() 
    {
        return $this->morphedByMany('Leafr\Commerce\Product', 'mediable');
    }

    public function pages()
    {
        return $this->morphedByMany('Leafr\Core\Page', 'mediable');
    }

    public function posts() 
    {
        return $this->morphedByMany('Leafr\Blogging\Post', 'mediable');
    }

    public function prepare($attr = [], UploadedFile $file)
    {

        $this->fill([
            'title' => $attr['name'],
            'description' => '',
            'mime' => $file->getClientMimeType(),
            'filename' => $this->generateUniqueName($attr['name']),
            'extension' => $file->extension(),
            'size' => $file->getClientSize(),
            'path' => $attr['path'],
            'meta' => ''
        ]);

        if($this->save()) {
            $this->upload($file);
        }

        return $this;

    }

    public function upload(UploadedFile $file)
    {
        return $file->storeAs('public/' . $this->path, $this->filename . '.' . $this->extension);
    }

    private function generateUniqueName($str)
    {
        return uniqid() . '_' . str_slug($str);
    }

    public function getSrcAttribute()
    {
        return $this->path . '/' . $this->filename . '.' . $this->extension;
    }
}
