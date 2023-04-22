<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::all();

        return view('admin.language.index', compact('languages'));
    }

    public function create(Request $request)
    {
        $id       = $request->languageId;
        $language = null;
        if (!is_null($id)) {
            $language = Language::find($id);
        }
        return view('admin.language.create', compact('language'));
    }

    public function store(LanguageRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->languageId)) {
            $language = Language::find($request->languageId);
            $language->update([
                'language' => $validated['language'],
                'level'    => $validated['level'],
                'order'    => $validated['order'],
                'status'   => $status,
            ]);

            alert()->success("Successful", "Language updated")->persistent(true, true);
        } else {
            Language::create([
                'language' => $validated['language'],
                'level'    => $validated['level'],
                'order'    => $validated['order'],
                'status'   => $status,
            ]);

            alert()->success("Successful", "Language added")->persistent(true, true);
        }

        return redirect()->route('admin.language.index');
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $id           = $request->languageId;
        $findLanguage = Language::find($id);
        $status       = $findLanguage->status ? 0 : 1;

        $findLanguage->status = $status;
        $findLanguage->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $id = $request->languageId;
        Language::where('id', $id)->delete();
        return response()->json(['message' => "Language deleted"], 200);
    }
}
