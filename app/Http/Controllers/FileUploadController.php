<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    public function index()
    {
        $files = FileUpload::all();
        return response()->json(["status" => "success", "count" => count($files), "data" => $files]);
    }

    public function imageList()
    {
        $files = FileUpload::where('type', 'image');
        return response()->json(["status" => "success", "count" => count($files), "data" => $files]);
    }

    public function imageUpload(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
                'images.*' => 'image|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
                'name' => 'string',
                'alt' => 'string',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => "failed", "message" => "Validation error", "errors" => $validator->errors()], 400);
        }

        if ($request->has('image')) {
            $image = $request->file('image');
            // name
            $name = preg_replace('/.\w*$/', '', $image->getClientOriginalName());
            // file_name
            $filename = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
            // type
            $mimeType = 'image';
            // alt
            $alt = $name;
            // size
            $size = $image->getSize();
            // folder
            $path = 'uploads/' . Carbon::now()->format('Y/m/d/');

            Storage::disk()->put($path . $filename, file_get_contents($image));
            $url = Storage::url($path . $filename);

            $response = FileUpload::create([
                'name' => $name,
                'file_name' => $filename,
                'type' => $mimeType,
                'alt' => $alt,
                'size' => $size,
                'folder' => $path,
                'url' => $url,
            ]);

            return response()->json(["data" => $response], 201);
        }

        if ($request->has('images')) {
            $response = [];
            foreach ($request->file('images') as $image) {

                // name
                $name = preg_replace('/.\w*$/', '', $image->getClientOriginalName());
                // file_name
                $filename = time() . Str::random(20) . '.' . $image->getClientOriginalExtension();
                // type
                $mimeType = 'image';
                // alt
                $alt = $name;
                // size
                $size = $image->getSize();
                // folder
                $path = 'uploads/' . Carbon::now()->format('Y/m/d/');

                Storage::disk()->put($path . $filename, file_get_contents($image));
                $url = Storage::url($path . $filename);

                if ($result = FileUpload::create([
                    'name' => $name,
                    'file_name' => $filename,
                    'type' => $mimeType,
                    'alt' => $alt,
                    'size' => $size,
                    'folder' => $path,
                    'url' => $url,
                ])) {
                    array_push($response, $result);
                };
            }
            return response()->json(["data" => $response], 201);
        }
    }
}
