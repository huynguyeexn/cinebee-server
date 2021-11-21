<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'date',
        'views',
        'content',
        'show',
        'category_id',
        'employee_id',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function categories()
    {
        return $this->belongsto(Category::class,"category_id");
    }
    public function files()
    {
        return $this->belongsToMany(FileUpload::class, 'blog_thumbs')->withPivot('file_upload_id');
    }
    public function employees()
    {
        return $this->belongsto(Employee::class);
    }
}