<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('admin.about.index', compact('about'));
    }

    public function create()
    {
        $about = AboutUs::first();
        if ($about) {
            return redirect()->route('admin.about-us.index')->with('error', 'About Us already exists.');
        }
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'members_count' => 'required|integer|min:0',
            'company_dob' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|email',
            'redirect_links' => 'required|array|min:1',
            'redirect_links.*.name' => 'required|string',
            'redirect_links.*.url' => 'required|url',
            'title' => 'required|string',
            'description' => 'required|string',
            'visions' => 'required|array|min:1',
            'visions.*.title' => 'required|string',
            'visions.*.description' => 'required|string',
            'visions.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Process the file uploads for visions
            $visions = [];
            foreach ($request->visions as $vision) {
                if (isset($vision['icon']) && $request->hasFile("visions.*.icon")) {
                    $file = $vision['icon'];
                    $path = $file->store('visions_icons', 'public');
                    $visions[] = [
                        'title' => $vision['title'],
                        'description' => $vision['description'],
                        'icon' => $path,
                    ];
                } else {
                    $visions[] = [
                        'title' => $vision['title'],
                        'description' => $vision['description'],
                        'icon' => null,
                    ];
                }
            }

            AboutUs::create([
                'location' => $request->location,
                'members_count' => $request->members_count,
                'opening_date' => $request->company_dob,
                'phone' => $request->phone,
                'email' => $request->email,
                'urls' => json_encode($request->redirect_links),
                'title' => $request->title,
                'description' => $request->description,
                'vissions' => json_encode($visions),
            ]);

            DB::commit();

            return redirect()->route('admin.about-us.index')->with('success', 'About Us created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to save About Us. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit()
    {
        $about = AboutUs::first();
        if (!$about) {
            return redirect()->route('admin.about-us.index')->with('error', 'No About Us record found.');
        }

        // Ensure visions is decoded as an array
        $about->urls = json_decode($about->urls, true); // Convert JSON to array
        $about->vissions = json_decode($about->vissions, true); // Convert JSON to array

        // Check if visions is not null and is an array
        if (!is_array($about->vissions)) {
            $about->vissions = [];
        }

        return view('admin.about.edit', compact('about'));
    }
    public function update(Request $request)
    {
        $about = AboutUs::first();
        if (!$about) {
            return redirect()->route('admin.about-us.index')->with('error', 'No About Us record found.');
        }

        $request->validate([
            'location' => 'required|string',
            'members_count' => 'required|integer|min:0',
            'company_dob' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|email',
            'redirect_links' => 'required|array|min:1',
            'redirect_links.*.name' => 'required|string',
            'redirect_links.*.url' => 'required|url',
            'title' => 'required|string',
            'description' => 'required|string',
            'visions' => 'required|array|min:1',
            'visions.*.title' => 'required|string',
            'visions.*.description' => 'required|string',
            'visions.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            DB::beginTransaction();

            // Ensure visions is decoded as an array
            $visions = json_decode($about->vissions, true);

            // Check if visions is an array
            if (!is_array($visions)) {
                $visions = [];
            }

            // Process the file uploads and delete old files if any
            foreach ($request->visions as $key => $vision) {
                $existingVision = $visions[$key] ?? null;

                // Delete the old icon if there's a new file uploaded
                if (isset($vision['icon']) && $request->hasFile("visions.$key.icon")) {
                    if ($existingVision && isset($existingVision['icon']) && Storage::exists('public/' . $existingVision['icon'])) {
                        Storage::delete('public/' . $existingVision['icon']);
                    }
                    $file = $vision['icon'];
                    $path = $file->store('visions_icons', 'public');
                    $visions[$key] = [
                        'title' => $vision['title'],
                        'description' => $vision['description'],
                        'icon' => $path,
                    ];
                } else {
                    // If there's no new file, keep the old icon
                    $visions[$key] = [
                        'title' => $vision['title'],
                        'description' => $vision['description'],
                        'icon' => $existingVision['icon'] ?? null,
                    ];
                }
            }

            // Update the AboutUs record
            $about->update([
                'location' => $request->location,
                'members_count' => $request->members_count,
                'opening_date' => $request->company_dob,
                'phone' => $request->phone,
                'email' => $request->email,
                'urls' => json_encode($request->redirect_links),
                'title' => $request->title,
                'description' => $request->description,
                'vissions' => json_encode($visions),
            ]);

            DB::commit();

            return redirect()->route('admin.about-us.index')->with('success', 'About Us updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update About Us. Error: ' . $e->getMessage())->withInput();
        }
    }
}
