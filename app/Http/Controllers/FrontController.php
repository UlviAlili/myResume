<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Interest;
use App\Models\Language;
use App\Models\Portfolio;
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
        $portfolios = Portfolio::with('featuredImage')
                               ->where('status', 1)
                               ->orderByDesc('id')->get();
        return view('pages.portfolio', compact('portfolios'));
    }

    public function portfolioDetails($id)
    {
        $portfolio = Portfolio::with('images')
                               ->where('status', 1)
                               ->where("id", $id)->first();

        if (is_null($portfolio)) {
            abort(404, 'Portfolio not found.');
        }

        return view('pages.portfolioDetails', compact('portfolio'));
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
