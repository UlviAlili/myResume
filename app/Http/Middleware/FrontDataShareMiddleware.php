<?php

namespace App\Http\Middleware;

use App\Models\Interest;
use App\Models\Language;
use App\Models\Profile;
use App\Models\SocialLink;
use Closure;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class FrontDataShareMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $profile = Profile::query()->first();

        $socials = SocialLink::query()->where('status', 1)->orderBy('order', 'ASC')->get();

        $languages = Language::query()->where('status', 1)->orderBy('order', 'ASC')->get();

        $interests = Interest::query()->where('status', 1)->orderBy('order', 'ASC')->get();

        \Illuminate\Support\Facades\View::share('profile', $profile);
        \Illuminate\Support\Facades\View::share('socials', $socials);
        \Illuminate\Support\Facades\View::share('languages', $languages);
        \Illuminate\Support\Facades\View::share('interests', $interests);

        return $next($request);
    }
}
