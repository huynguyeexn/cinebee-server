<?php

namespace App\Http\Controllers;

use App\Models\ComboFiles;
use Illuminate\Http\Request;

class ComboFilesController extends Controller
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
    public function store($comboId, $images)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComboFiles  $comboFiles
     * @return \Illuminate\Http\Response
     */
    public function show(ComboFiles $comboFiles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComboFiles  $comboFiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComboFiles $comboFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComboFiles  $comboFiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComboFiles $comboFiles)
    {
        //
    }
}
