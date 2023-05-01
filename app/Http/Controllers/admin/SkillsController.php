<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function index()
    {
        $skills = Skill::all();

        return view('admin.skills.index', compact('skills'));
    }

    public function create(Request $request)
    {
        $id     = $request->skillId;
        $skills = null;
        if (!is_null($id)) {
            $skills = Skill::find($id);
        }
        return view('admin.skills.create', compact('skills'));
    }

    public function store(SkillRequest $request)
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->skillId)) {
            $skills = Skill::find($request->skillId);
            $skills->update([
                'skills'   => $validated['skills'],
                'progress' => $validated['progress'],
                'order'    => $validated['order'],
                'status'   => $status,
            ]);

            alert()->success("Successful", "Skill information updated")->persistent(true, true);
        } else {
            Skill::create([
                'skills'   => $validated['skills'],
                'progress' => $validated['progress'],
                'order'    => $validated['order'],
                'status'   => $status,
            ]);

            alert()->success("Successful", "Skill information added")->persistent(true, true);
        }

        return redirect()->route('admin.skills.index');
    }

    public function status(Request $request)
    {
        $id        = $request->skillId;
        $findSkill = Skill::find($id);
        $status    = $findSkill->status ? 0 : 1;

        $findSkill->status = $status;
        $findSkill->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->skillId;
        Skill::where('id', $id)->delete();
        return response()->json(['message' => "Skill deleted"], 200);
    }
}
