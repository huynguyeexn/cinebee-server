<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    /**
     * Get List
     * @return mixed
     */
    public function getList(Request $request);

    /**
     * Get Deleted List
     * @return mixed
     */
    public function getDeletedList(Request $request);

    /**
     * Get By ID
     * @param string $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Get By Slug
     * @param string $slug
     * @return mixed
     */
    public function getBySlug($slug);

    /**
     * Store
     * @param array $attributes
     * @return mixed
     */
    public function store($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function delete($id);

    /**
     * Remove
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function remove($id);

    /**
     * Restore
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function restore($id);
}
