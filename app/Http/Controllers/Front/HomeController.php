<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AboutOurClient;
use App\Models\AboutUs;
use App\Models\AboutUsStats;
use App\Models\Home;
use App\Models\HomeFeatured;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // homepage
    public function index()
    {
        $content = Home::first(); 
        $sliders = Home::all();
        $allFeatureds = HomeFeatured::where('status', 1)->get();
        $aboutUs = AboutUs::first();
        $aboutUsStats = AboutUsStats::where('status', 1)->get();
        $aboutUsClients = AboutOurClient::where('status', 1)->get();
        $allServices = Service::where('status', 1)->get();
        // dd($aboutUsClients);
        return view('index', compact('content', 'sliders', 'allFeatureds', 'aboutUs', 'aboutUsStats', 'aboutUsClients','allServices'));
    }
}
