<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use App\Models\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteContentController extends Controller
{
    public function index()
    {
        $logo = SiteContent::select('logo')->first();
        $phone = SiteContent::select('phone')->first();
        $email = SiteContent::select('email')->first();
        $address = SiteContent::select('address')->first();
        $copyright = SiteContent::select('copyright')->first();
        // dd($logo);
        return view('backend.siteContent.index', compact('logo', 'phone', 'email', 'address', 'copyright'));
    }

    // update site content
    public function updateContent(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'copyright' => 'nullable|string',
        ]);
        // Retrieve the first record or create a new one
        $siteContent = SiteContent::first();
        if (!$siteContent) {
            $siteContent = new SiteContent();
        }

        // dd($request->all());
        // Handle site_logo upload
        if ($request->hasFile('logo')) {
            if ($siteContent->logo && File::exists(public_path($siteContent->logo))) {
                File::delete(public_path($siteContent->logo)); // Unlink old image
            }
            $site_logo = $request->file('logo');

            // Generate a unique file name with a timestamp
            $fileName = now()->format('YmdHis') . "_" . $site_logo->getClientOriginalName();

            // Move the file to the target directory
            $site_logo->move(public_path('front/assets/img/'), $fileName);

            // Save the file name in the database
            $siteContent->logo =  $fileName;
        }

        // Update other fields
        $siteContent->phone = $request->phone;
        $siteContent->email = $request->email;
        $siteContent->address = $request->address;
        $siteContent->copyright = $request->copyright;

        // Save the site content
        $siteContent->save();
        toastr()->success('content updated successfully!');

        return redirect()->back();
    }

    // view Social Links
    public function socialLinks()
    {
        $fb = SocialLink::select('facebook')->first();
        $insta = SocialLink::select('instagram')->first();
        $linkedin = SocialLink::select('linkedin')->first();
        $twitter = SocialLink::select('twitter')->first();
        return view('backend.siteContent.socialLinks', compact('fb', 'insta', 'linkedin', 'twitter'));
    }

    // update Social Links
    public function updateSocialLinks(Request $request)
    {

        $validated = $request->validate([
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);
        // Save to the database (assuming a `SiteContent` or similar model exists)
        $siteContent = SocialLink::firstOrCreate();
        $siteContent->update($validated);
        toastr()->success('Social Links updated successfully!');
        return redirect()->back();
    }
}


