<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class FileUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'file_name',
        'type',
        'alt',
        'size',
        'folder',
        'url',
    ];

    protected $appends = ['thumbUrl', 'uid'];

    public function movieFiles()
    {
        return $this->belongsToMany(Movie::class, 'movie_files');
    }
    public function comboFiles()
    {
        return $this->belongsToMany(Combo::class, 'combo_files');
    }
    public function BlogFile(){
        return $this->belongsToMany(Blog::class,'blog_thumbs');
    }
    public function getThumbUrlAttribute()
    {
        return $this->url;
    }
    public function getUidAttribute()
    {
        return $this->id;
    }
}
