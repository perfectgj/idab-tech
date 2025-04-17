<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    public function aboutus()
    {
        $about = AboutUs::first();

        if ($about) {
            $about->urls = json_decode($about->urls ?? '[]', true);
            $about->vissions = json_decode($about->vissions ?? '[]', true);
        } else {
            // Provide default structure if no record found
            $about = (object) [
                'location' => '',
                'members' => '',
                'dob' => '',
                'urls' => [],
                'phone' => '',
                'email' => '',
                'title' => '',
                'description' => '',
                'vissions' => [],
            ];
        }

        return view('frontend.about', compact('about'));
    }

    public function projects()
    {
        $projects = Project::where('status', 1)
            ->latest()
            ->paginate(6);
        return view('frontend.projects', compact('projects'));
    }

    public function services()
    {
        $services = Service::where('status', 1)
            ->latest()
            ->paginate(6);

        return view('frontend.services', compact('services'));
    }

    public function our_team()
    {
        $teams = Team::where('status', 1)
            ->latest()
            ->paginate(6);

        return view('frontend.team', compact('teams'));
    }

    public function products()
    {
        $category = Category::with('products')
            ->latest()
            ->paginate(6);

        return view('frontend.products', compact('category'));
    }

    public function contact_us()
    {
        return view('frontend.contact');
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'query' => 'required|string',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $contactUs = new ContactUs();
            $contactUs->name = $request->input('name');
            $contactUs->query = $request->input('query');
            $contactUs->email = $request->input('email');
            $contactUs->phone = $request->input('phone');
            $contactUs->country = $request->input('country_code') ?? '';
            $contactUs->save();

            DB::commit();

            return redirect()->back()->with('success', 'Query submitted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Contact Form Error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }
    }


}
