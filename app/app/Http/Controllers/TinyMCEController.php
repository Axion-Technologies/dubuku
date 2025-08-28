<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TinyMCEController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('uploads/tinymce', 'public');
            return response()->json(['location' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded.'], 422);
    }
}
