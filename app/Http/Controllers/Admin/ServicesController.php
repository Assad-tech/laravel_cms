<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index()
    {
        $allServices = Service::where('status', 1)->get();
        return view('backend.service.service', compact('allServices'));
    }

    public function create()
    {
        return view('backend.service.createService');
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

        $newService = new Service();


        // Auto-generate slug from title
        $newService->slug = Str::slug($request->title);

        // Optional: Ensure slug is unique (add increment if necessary)
        $existingSlugCount = Service::where('slug', $newService->slug)->count();
        if ($existingSlugCount > 0) {
            $newService->slug .= '-' . ($existingSlugCount + 1);
        }


        // Image Upload
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_image.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('front/assets/img//featured'), $fileName);
        //     $newService->image = $fileName;
        // }

        $newService->title = $request->title;
        $newService->icon = $request->icon;
        $newService->description = $request->description;
        $newService->status = 1;

        $newService->save();

        toastr()->success('Service created successfully!');
        return redirect()->route('admin.manage.services');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('backend.service.editService', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'icon' => 'nullable|string',
        ]);


        $updateService = Service::findOrFail($id);

        // Always check if slug is missing or if the title has changed
        if (empty($updateService->slug) || $request->title !== $updateService->title) {
            $slug = Str::slug($request->title);

            // Ensure unique slug
            $existingSlugCount = Service::where('slug', $slug)
                ->where('id', '!=', $id)
                ->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }

            $updateService->slug = $slug;
        }

        // Image Upload (optional)
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $fileName = time() . '_image.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('front/assets/img/service'), $fileName);
        //     // Optionally unlink old image
        //     // if ($updateService->image) {
        //     //     @unlink(public_path('front/assets/img/service/' . $updateService->image));
        //     // }
        //     $updateService->image = $fileName;
        // }

        $updateService->title = $request->title;
        $updateService->icon = $request->icon;
        $updateService->description = $request->description;
        $updateService->status = $request->status;

        $updateService->save();

        toastr()->success('Service updated successfully!');
        return redirect()->route('admin.manage.services');
    }

    public function delete($id)
    {
        $deleteService = Service::findOrFail($id);
        $deleteService->delete();
        toastr()->success('Service deleted successfully!');
        return redirect()->route('admin.manage.services');
    }
}
