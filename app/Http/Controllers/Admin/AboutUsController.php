<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutOurClient;
use App\Models\AboutUs;
use App\Models\AboutUsStats;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        $stats = AboutUsStats::where('status', 1)->get();
        $clients = AboutOurClient::where('status', 1)->get();
        return view('backend.aboutUs.index', compact('about', 'stats', 'clients'));
    }

    public function updateAboutUs(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Retrieve or create About Us entry
        $about = AboutUs::firstOrCreate([]);

        // Handle Image upload if provided
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_about.' . $file->getClientOriginalExtension();
            $file->move(public_path('front/assets/img'), $fileName);

            // Delete old image if exists
            if (!empty($about->image) && file_exists(public_path('front/assets/img' . $about->image))) {
                unlink(public_path('front/assets/img' . $about->image));
            }

            $about->image = $fileName;
        }

        $about->heading = $validated['heading'];
        $about->description = $validated['description'];
        $about->save();

        toastr()->success('About Us details updated successfully!');
        return redirect()->route('admin.manage.about-us');
    }
    // __________ Stats _________
    // Create new Stats
    public function createStats()
    {
        return view('backend.aboutUs.createStats');
    }
    // Store new Stats
    public function storeStats(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'stats_icon' => 'required|string',
            'stats_title' => 'required|string',
            'stats_value' => 'required|integer|min:0',
        ]);

        $stats = new AboutUsStats();
        $stats->stats_icon = $validated['stats_icon'];
        $stats->stats_title = $validated['stats_title'];
        $stats->stats_value = $validated['stats_value'];
        $stats->status = 1;
        $stats->save();

        toastr()->success('Stats added successfully!');
        return redirect()->route('admin.manage.about-us');
    }

    // Edit Stats
    public function editStats($id)
    {
        $stats = AboutUsStats::findOrFail($id);
        return view('backend.aboutUs.editStats', compact('stats'));
    }

    // Update Stats
    public function updateStats(Request $request, $id)
    {
        $validated = $request->validate([
            'stats_icon' => 'required|string',
            'stats_title' => 'required|string',
            'stats_value' => 'required|integer|min:0',
        ]);

        $stats = AboutUsStats::findOrFail($id);
        $stats->stats_icon = $validated['stats_icon'];
        $stats->stats_title = $validated['stats_title'];
        $stats->stats_value = $validated['stats_value'];
        $stats->save();

        toastr()->success('Stats updated successfully!');
        return redirect()->route('admin.manage.about-us');
    }

    // Delete Stats
    public function deleteStats($id)
    {
        $stats = AboutUsStats::findOrFail($id);
        $stats->delete();
        toastr()->success('Stats deleted successfully!');
        return redirect()->route('admin.manage.about-us');
    }

    // __________ Company Logos and links ___________
    public function createClient()
    {
        return view('backend.aboutUs.createClient');
    }

    public function storeClient(Request $request)
    {
        $validated = $request->validate([
            'site_link' => 'required|url',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $client = new AboutOurClient();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_client.' . $file->getClientOriginalExtension();
            $file->move(public_path('front/assets/img/clients'), $fileName);
            $client->company_logo = $fileName;
        }
        $client->company_link = $validated['site_link'];
        $client->status = 1;
        $client->save();

        toastr()->success('Logo added successfully!');
        return redirect()->route('admin.manage.about-us');
    }

    public function editClient($id)
    {
        $client = AboutOurClient::findOrFail($id);
        return view('backend.aboutUs.editClient', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        $validated = $request->validate([
            'site_link' => 'required|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $client = AboutOurClient::findOrFail($id);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = time() . '_client.' . $file->getClientOriginalExtension();
            $file->move(public_path('front/assets/img/clients'), $fileName);
            // Delete old image if exists
            if (!empty($client->company_logo) && file_exists(public_path('front/assets/img/clients' . $client->company_logo))) {
                unlink(public_path('front/assets/img/clients' . $client->company_logo));
            }
            $client->company_logo = $fileName;
        }
        $client->company_link = $validated['site_link'];
        $client->save();

        toastr()->success('Logo updated successfully!');
        return redirect()->route('admin.manage.about-us');
    }
}
