<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeFeatured;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FeaturedController extends Controller
{
    public function index()
    {
        $allFeatured = HomeFeatured::where('status', 1)->get();
        return view('backend.featured.featured', compact('allFeatured'));
    }

    public function create()
    {
        return view('backend.featured.createFeatured');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'icon' => 'nullable|string',
        ]);

        $featured = new HomeFeatured();


        // Auto-generate slug from title
        $featured->slug = Str::slug($request->title);

        // Optional: Ensure slug is unique (add increment if necessary)
        $existingSlugCount = HomeFeatured::where('slug', $featured->slug)->count();
        if ($existingSlugCount > 0) {
            $featured->slug .= '-' . ($existingSlugCount + 1);
        }


        // Image Upload
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_image.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('front/assets/img//featured'), $fileName);
        //     $featured->image = $fileName;
        // }

        $featured->title = $request->title;
        $featured->icon = $request->icon;
        $featured->description = $request->description;
        $featured->status = 1;

        $featured->save();

        toastr()->success('Featured item created successfully!');
        return redirect()->route('admin.manage.featured');
    }

    public function edit($id)
    {
        $featured = HomeFeatured::findOrFail($id);
        return view('backend.featured.editFeatured', compact('featured'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'icon' => 'nullable|string',
        ]);


        $featured = HomeFeatured::findOrFail($id);

        // Always check if slug is missing or if the title has changed
        if (empty($featured->slug) || $request->title !== $featured->title) {
            $slug = Str::slug($request->title);

            // Ensure unique slug
            $existingSlugCount = HomeFeatured::where('slug', $slug)
                ->where('id', '!=', $id)
                ->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            $featured->slug = $slug;
        }

        // Image Upload (optional)
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_image.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('front/assets/img/featured'), $fileName);
        //     // Optionally unlink old image
        //     // if ($featured->image) {
        //     //     @unlink(public_path('front/assets/img/featured/' . $featured->image));
        //     // }
        //     $featured->image = $fileName;
        // }

        $featured->title = $request->title;
        $featured->icon = $request->icon;
        $featured->description = $request->description;
        $featured->status = $request->status;

        $featured->save();

        toastr()->success('Featured item updated successfully!');
        return redirect()->route('admin.manage.featured');
    }

    public function delete($id)
    {
        $featured = HomeFeatured::findOrFail($id);
        $featured->delete();
        toastr()->success('Featured item deleted successfully!');
        return redirect()->route('admin.manage.featured');
    }
}
