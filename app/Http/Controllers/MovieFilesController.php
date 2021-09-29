<?php

namespace App\Http\Controllers;

use App\Models\MovieFiles;
use Illuminate\Http\Request;

class MovieFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($movieId, $images)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MovieFiles  $movieFiles
     * @return \Illuminate\Http\Response
     */
    public function show(MovieFiles $movieFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MovieFiles  $movieFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MovieFiles $movieFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MovieFiles  $movieFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(MovieFiles $movieFiles)
    {
        //
    }
}
