<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Portfolio;
use App\Models\Skill;

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
                               ->orderBy('order', 'ASC')->get();
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

    public function skills()
    {
        $skills = Skill::query()->where('status', 1)
                       ->orderBy('order', 'ASC')->get();

        return view('pages.skills', compact('skills'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function socialShare()
    {
        return view('layouts.front');
    }
}
