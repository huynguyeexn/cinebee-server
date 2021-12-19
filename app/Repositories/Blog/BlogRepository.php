<?php

namespace App\Repositories\Blog;

use App\Models\Blog;
use App\Repositories\BaseRepository;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    public function getModel()
    {
        return Blog::class;
    }
    public function getById_n($id){
        try {
            $blog = $this->model->findOrFail($id);
            $file = $this->model->findOrFail($id)->files;
            $data = [
                'id' => $id,
                'title' => $blog->title,
                'slug'  => $blog->slug,
                'summary' => $blog->summary,
                'date'  => $blog->date,
                'content' => htmlspecialchars_decode($blog->content),
                'show'  => $blog->show,
                'background' => $file,
                'background_rq'=> [$file[0]->id],
                'category' => $blog->category,
                'author' => $blog->author,
            ];
            return $data;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}