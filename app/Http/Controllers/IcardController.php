<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IcardController extends Controller
{
    public function create()
    {
        return view('icard.create');
    }
}
