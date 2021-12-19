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

    protected $appends = [
        'category', 'author'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,"category_id");
    }
    public function files()
    {
        return $this->belongsToMany(FileUpload::class, 'blog_thumbs')->withPivot('file_upload_id');
    }
    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }

    public function getCategoryAttribute() {
        return $this->categories()->first();
    }

    public function getAuthorAttribute() {
        return $this->employees()->first();
    }
}
