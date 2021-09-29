<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function movieFiles()
    {
        return $this->belongsToMany(Movie::class, 'movie_files');
    }
}
