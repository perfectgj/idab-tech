<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

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
            $about = (object)[
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
}
