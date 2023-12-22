<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    public function loadimages()
    {
        $imagePath = public_path('dist/img/templates');
        $files = File::files($imagePath);

        $imageNames = [];
        foreach ($files as $file) {
            $imageNames[] = $file->getFilename(); // Include file extension
        }

        return array((object) [
            'data' => $imageNames,
        ]);
    }
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('dist/img/templates'), $imageName);

        return array((object) [
            'status' => 200,
            'statusCode' => "success",
            'message' => "File Added Successfully!"
        ]);
    }
}
