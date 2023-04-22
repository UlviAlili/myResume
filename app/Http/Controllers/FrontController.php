<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $educationList = Education::query()->status()->orderBy('order', 'ASC')
                                  ->select("university", 'faculty', 'education_date', 'education_type', 'description')->get();

        $experienceList = Experience::query()->status()->orderBy('order', 'ASC')
                                    ->select("company", 'position', 'experience_date', 'description')->get();

        return view('pages.index', compact('educationList', 'experienceList'));
    }

    public function resume()
    {
        return view('pages.resume');
    }

    public function portfolio()
    {
        return view('pages.portfolio');
    }

    public function blog()
    {
        return view('pages.blog');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
