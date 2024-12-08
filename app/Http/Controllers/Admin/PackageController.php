<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Models\TemporaryFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePackageRequest;
use App\Http\Requests\Admin\UpdatePackageRequest;
use App\Models\Amenity;
use App\Models\Cruise;
use App\Models\PackageAmenity;
use App\Models\PackageImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PackageController extends Controller
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
    public function create(Request $request, $slug)
    {
        clearTemporaryFiles();
        $amenities = Amenity::all();
        $cruise = Cruise::where('slug', $slug)->firstOrFail();

        return view('2_AdminPanel.4_Pages.7_Packages.Form.form', compact('slug', 'amenities', 'cruise'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePackageRequest $request)
    {
        $data = $request->validated();
        $cruise = Cruise::where('slug', $request->cruise_slug)->firstOrFail();

        $package = Package::create([
            'cruise_id' => $cruise->id,
            'name' => $data['category'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'is_active' => $data['is_active']
        ]);

        $amenities =  $data['amenities'];

        foreach ($amenities as $amenity) {
            PackageAmenity::create([
                'package_id' => $package->id,
                'amenity_id' => $amenity,
            ]);
        }

        $temporaryImages = TemporaryFile::all();

        foreach ($temporaryImages as $temporaryImage) {

            $sourcePath = 'images/tmp' . $temporaryImage->folder . '/' . $temporaryImage->filename;
            $targetPath = 'packages/images/' . Str::random() . '/' . $temporaryImage->filename;

            Storage::copy($sourcePath, $targetPath);

            PackageImage::create([
                'package_id' => $package->id,
                'package_img' => $targetPath,
            ]);
        }

        clearTemporaryFiles();

        return response()->json([
            'message' => toCamelCase($data['category']) . ' Package for ' . $cruise->name . ' Added Successfully',
            'data' => $package,
            'action' => 'store'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package, $package_slug)
    {
        clearTemporaryFiles();
        $amenities = Amenity::all();

        $data = Package::with('packageImages')->with('amenities')->where('slug', $package_slug)->firstOrFail();

        $cruise = Cruise::find($data->cruise_id);
        $slug = $cruise->slug;


        return view('2_AdminPanel.4_Pages.7_Packages.Form.form', compact('slug', 'amenities', 'data', 'cruise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Package $package)
    {
        $data = $request->validated();

        $cruise = Cruise::where('slug', $request->cruise_slug)->firstOrFail();

        $package->update([
            'name' => $data['category'],
            'description' => $data['description'],
            'slug' => $data['slug'],
            'is_active' => $data['is_active']
        ]);

        $amenities =  $data['amenities'];

        PackageAmenity::where('package_id', $package->id)->delete();

        foreach ($amenities as $amenity) {
            PackageAmenity::create([
                'package_id' => $package->id,
                'amenity_id' => $amenity,
            ]);
        }

        $temporaryImages = TemporaryFile::all();

        foreach ($temporaryImages as $temporaryImage) {

            $sourcePath = 'images/tmp' . $temporaryImage->folder . '/' . $temporaryImage->filename;
            $targetPath = 'packages/images/' . Str::random() . '/' . $temporaryImage->filename;

            Storage::copy($sourcePath, $targetPath);

            PackageImage::create([
                'package_id' => $package->id,
                'package_img' => $targetPath,
            ]);
        }

        clearTemporaryFiles();

        return response()->json([
            'message' => toCamelCase($data['category']) . ' Package for ' . $cruise->name . ' Updated Successfully',
            'data' => $package,
            'action' => 'update',
            'redirect_url' => route('cruises.show', ['slug' => $cruise->slug])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package_images = PackageImage::where('package_img', $package->id)->get();

        foreach ($package_images as $package_image) {

            $imagePath = $package_image->getRawOriginal('package_img');
            $directory = dirname($imagePath);

            if (Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->deleteDirectory($directory);
            }

            $package_image->delete();
        }
        $package->delete();

        return response()->json([
            'message' => toCamelCase($package->name) . ' Package Deleted Successfully',
            'data' => $package,
        ], 200);
    }

    public function list(Request $request, $id)
    {
        $query = Package::with('packageImages')->with('amenities')->where('cruise_id', $id);


        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('is_active')) {
            $query->where('is_active', $request->input('is_active'));
        }

        if ($request->filled('order') && $request->input('order')[0]['column'] != 0) {
            $orderColumnIndex = $request->input('order')[0]['column']; // Column index
            $orderDirection = $request->input('order')[0]['dir'];     // 'asc' or 'desc'

            // Map DataTables column index to database column names
            $columns = [
                2 => 'name',
                3 => 'is_active',
            ];

            if (array_key_exists($orderColumnIndex, $columns)) {
                $orderColumn = $columns[$orderColumnIndex];
                $query->orderBy($orderColumn, $orderDirection);
            }
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }

        $totalRecords = Package::where('id', $id)->count();
        $filteredRecords = $query->count();

        // Apply pagination
        $query->skip($request->input('start', 0))
            ->take($request->input('length', 10));

        $packages = $query->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $packages
        ]);
    }

    public function delete_image(Request $request)
    {
        $image = PackageImage::findOrFail($request->id);
        $imagePath = $image->getRawOriginal('package_img');
        $directory = dirname($imagePath);

        if (Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->deleteDirectory($directory);
        }

        $image->forceDelete();

        return response()->json([
            'message' => 'Image Deleted Successfully',
            'data' => $image,
        ], 200);
    }
}
