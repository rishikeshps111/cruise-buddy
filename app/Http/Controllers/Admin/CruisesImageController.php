<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cruise;
use App\Models\CruisesImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCruisesImageRequest;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class CruisesImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        clearTemporaryFiles();

        $itemId = $request->get('id');
        $size = $request->get('size', 'modal-md');
        $data = Cruise::with('cruisesImages')->find($itemId);
        return response()->json([
            'title' => 'Cruise Images',
            'size' => $size,
            'content' => view('2_AdminPanel.4_Pages.6_Cruises.Image.form', compact('data'))->render(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCruisesImageRequest $request)
    {
        $temporaryImages = TemporaryFile::all();

        foreach ($temporaryImages as $temporaryImage) {
            // Construct the source and target paths
            $sourcePath = 'images/tmp' . $temporaryImage->folder . '/' . $temporaryImage->filename;
            $targetPath = 'cruises/images/' . Str::random() . '/' . $temporaryImage->filename;

            // Copy the file
            Storage::copy($sourcePath, $targetPath);

            // Save the record to the database
            CruisesImage::create([
                'cruise_id' => $request->cruise_id,
                'cruise_img' => $targetPath,
            ]);
        }

        // After the loop, delete the temporary directories and files
        foreach ($temporaryImages as $temporaryImage) {
            Storage::deleteDirectory('images/tmp' . $temporaryImage->folder);
            $temporaryImage->delete();
        }

        return response()->json([
            'message' => 'Cruise Images Added Successfully',
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(CruisesImage $cruisesImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CruisesImage $cruisesImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateCruisesImageRequest $request, CruisesImage $cruisesImage)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CruisesImage $cruisesImage)
    {
        $imagePath = $cruisesImage->getRawOriginal('cruise_img');
        $directory = dirname($imagePath);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $cruisesImage->forceDelete();

        return response()->json([
            'message' => 'Cruise Image Deleted Successfully',
            'data' => $cruisesImage,
        ], 200);
    }
}
