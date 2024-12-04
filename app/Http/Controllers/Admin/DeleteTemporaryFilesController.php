<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DeleteTemporaryFilesController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $temporaryFile = TemporaryFile::where('folder', request()->getContent())->first();

        if ($temporaryFile) {
            storage::deleteDirectory('images/tmp' . $temporaryFile->folder);
            $temporaryFile->delete();
        }

        return response()->noContent();
    }
}
