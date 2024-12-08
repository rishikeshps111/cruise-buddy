<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadTemporaryFilesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $filename = $image->getClientOriginalName();
            $folder = uniqid('image-', true);
            $image->storeAs('images/tmp' . $folder, $filename);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $filename
            ]);

            return $folder;
        }
        return '';
    }
}
