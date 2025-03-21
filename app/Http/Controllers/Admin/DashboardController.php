<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.home.index');
    }

    public function viewHome()
    {
        $homeData = Home::get();
        // dd($homeData);
        return view('backend.home.home', compact('homeData'));
    }

    public function create()
    {
        return view('backend.home.createHome');
    }
    public function store(Request $request)
    {

        $request->validate([
            'greeting' => 'nullable|string',
            'site_name' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'banner_description' => 'nullable|string',
            'link_on_banner' => 'nullable|url',
            'link_text' => 'nullable|string',
        ]);

        // dd($request);
        $home = new Home();

        if ($request->hasFile('banner_image')) {
            $file = $request->file('banner_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('front/assets/img/banners'), $fileName);
            $home->banner = $fileName;
        }

        $home->greeting = $request->greeting;
        $home->site_name = $request->site_name;
        $home->banner_description = $request->banner_description;
        $home->banner_link = $request->link_on_banner;
        $home->link_text = $request->link_text;
        $home->save();
        toastr()->success('Home section created successfully!');
        return redirect()->back();
    }

    public function edit($id)
    {
        $content = Home::find($id);
        // dd($home);
        return view('backend.home.editHome', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'greeting' => 'nullable|string',
            'site_name' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'banner_description' => 'nullable|string',
            'link_on_banner' => 'nullable|url',
            'link_text' => 'nullable|string',
        ]);

        $home = Home::find($id);

        if ($request->hasFile('banner_image')) {
            if ($home->banner && file_exists(public_path('front/assets/img/banners/' . $home->banner))) {
                unlink(public_path('front/assets/img/banners/' . $home->banner));
            }
            $file = $request->file('banner_image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('front/assets/img/banners'), $fileName);
            $home->banner = $fileName;
        }

        $home->greeting = $request->greeting;
        $home->site_name = $request->site_name;
        $home->banner_description = $request->banner_description;
        $home->banner_link = $request->link_on_banner;
        $home->link_text = $request->link_text;
        $home->save();
        toastr()->success('Home section updated successfully!');
        return redirect()->route('admin.manage.home');
    }

    public function delete($id)
    {
        $home = Home::find($id);
        $home->delete();
        toastr()->success('Home section deleted successfully!');
        return redirect()->route('admin.manage.home');
    }
}
