<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialLinkRequest;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socials = SocialLink::all();

        return view('admin.social-link.index', compact('socials'));
    }

    public function create(Request $request)
    {
        $id     = $request->socialId;
        $social = null;
        if (!is_null($id)) {
            $social = SocialLink::find($id);
        }
        return view('admin.social-link.create', compact('social'));
    }

    public function store(SocialLinkRequest $request)
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->socialId)) {
            $social = SocialLink::find($request->socialId);
            $social->update([
                'name'   => $validated['name'],
                'slug'   => Str::slug($validated['name']),
                'link'   => $validated['link'],
                'order'  => $validated['order'],
                'status' => $status,
            ]);

            alert()->success("Successful", "Social Link updated")->persistent(true, true);
        } else {
            SocialLink::create([
                'name'   => $validated['name'],
                'slug'   => Str::slug($validated['name']),
                'link'   => $validated['link'],
                'order'  => $validated['order'],
                'status' => $status,
            ]);

            alert()->success("Successful", "Social Link added")->persistent(true, true);
        }

        return redirect()->route('admin.social.index');
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $id         = $request->socialId;
        $findSocial = SocialLink::find($id);
        $status     = $findSocial->status ? 0 : 1;

        $findSocial->status = $status;
        $findSocial->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $id = $request->socialId;
        SocialLink::where('id', $id)->delete();
        return response()->json(['message' => "Social Link deleted"], 200);
    }
}
