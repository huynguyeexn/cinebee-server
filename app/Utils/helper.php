<?php

use Illuminate\Support\Facades\Schema;

if (!function_exists('columnExists')) {
    function columnExists($model, $column = NULL)
    {
        try {

            if (!Schema::hasColumn($model::query()->getQuery()->from, $column)) {
                return false;
            }

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
