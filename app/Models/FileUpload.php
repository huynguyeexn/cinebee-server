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
    ];

    protected $appends = ['url', 'thumbUrl', 'uid'];

    public function movieFiles()
    {
        return $this->belongsToMany(Movie::class, 'movie_files');
    }
    public function getThumbUrlAttribute()
    {
        return URL::to('/') . '/' . $this->folder . $this->file_name;
    }
    public function getUrlAttribute()
    {
        return URL::to('/') . '/' . $this->folder . $this->file_name;
    }
    public function getUidAttribute()
    {
        return $this->id;
    }
}
