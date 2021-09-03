<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    /**
     * Get All
     * @return mixed
     */
    public function getList(Request $request);

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
}
