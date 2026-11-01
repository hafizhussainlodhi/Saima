<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AmenityController extends Controller
{
    /**
     * Display a listing of the amenities.
     */
    public function index(Request $request)
    {
        $query = Amenity::query();

        if ($request->filled('q')) {
            $q = trim($request->input('q'));
            $query->where('name', 'LIKE', "%{$q}%");
        }

        $amenities = $query->orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $totalAmenities = Amenity::count();

        return view('admin.amenities.index', compact('amenities', 'totalAmenities'));
    }

    /**
     * Store a newly created amenity.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'file'],
        ], [
            'name.required' => 'Amenity name is required.',
            'icon.required' => 'SVG icon file is required.',
        ]);

        $file = $request->file('icon');

        // Strict SVG validation
        if (!$this->isValidSvgFile($file)) {
            return back()->withInput()->with('error', 'Only SVG files (.svg) are allowed for amenities icon.');
        }

        $uploadDir = public_path('uploads/amenities');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $cleanName = Str::slug($request->input('name'));
        $filename = time() . '_' . $cleanName . '.svg';
        $file->move($uploadDir, $filename);

        $relativePath = '/uploads/amenities/' . $filename;
        $svgContent = @file_get_contents($uploadDir . '/' . $filename) ?: null;

        $maxOrder = (int) Amenity::max('order');

        $amenity = Amenity::create([
            'name'        => trim($request->input('name')),
            'slug'        => Str::slug($request->input('name')),
            'icon'        => $relativePath,
            'svg_content' => $svgContent,
            'order'       => $maxOrder + 1,
            'is_active'   => true,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Amenity created successfully.',
                'amenity' => $amenity,
            ]);
        }

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity "' . $amenity->name . '" added successfully.');
    }

    /**
     * Update the specified amenity.
     */
    public function update(Request $request, Amenity $amenity)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'file'],
        ]);

        $amenity->name = trim($request->input('name'));
        $amenity->slug = Str::slug($amenity->name);

        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            if (!$this->isValidSvgFile($file)) {
                return back()->withInput()->with('error', 'Only SVG files (.svg) are allowed.');
            }

            $uploadDir = public_path('uploads/amenities');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Remove old file if exists
            if (!empty($amenity->icon)) {
                $oldPath = public_path(ltrim($amenity->icon, '/'));
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $cleanName = Str::slug($amenity->name);
            $filename = time() . '_' . $cleanName . '.svg';
            $file->move($uploadDir, $filename);

            $amenity->icon = '/uploads/amenities/' . $filename;
            $amenity->svg_content = @file_get_contents($uploadDir . '/' . $filename) ?: null;
        }

        $amenity->save();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Amenity updated successfully.',
                'amenity' => $amenity,
            ]);
        }

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity "' . $amenity->name . '" updated successfully.');
    }

    /**
     * Remove the specified amenity.
     */
    public function destroy(Request $request, Amenity $amenity)
    {
        $name = $amenity->name;

        // Delete physical file
        if (!empty($amenity->icon)) {
            $path = public_path(ltrim($amenity->icon, '/'));
            if (file_exists($path) && is_file($path)) {
                @unlink($path);
            }
        }

        $amenity->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Amenity "' . $name . '" deleted successfully.',
            ]);
        }

        return redirect()->route('admin.amenities.index')->with('success', 'Amenity "' . $name . '" deleted successfully.');
    }

    /**
     * JSON listing endpoint for live CMS dropdown sync.
     */
    public function listJson()
    {
        $amenities = Amenity::orderBy('order', 'asc')->orderBy('name', 'asc')->get();
        return response()->json($amenities);
    }

    /**
     * Strict check to ensure file is genuinely an SVG vector.
     */
    private function isValidSvgFile($file): bool
    {
        if (!$file || !$file->isValid()) {
            return false;
        }

        // Check extension
        $ext = strtolower($file->getClientOriginalExtension());
        if ($ext !== 'svg') {
            return false;
        }

        // Check content for SVG tag
        $content = @file_get_contents($file->getRealPath());
        if (!$content || !str_contains($content, '<svg')) {
            return false;
        }

        return true;
    }
}
