<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::all();

        return view('admin.experience.index', compact('experiences'));
    }

    public function status(Request $request)
    {
        $id             = $request->experienceId;
        $findExperience = Experience::find($id);
        $status         = $findExperience->status ? 0 : 1;

        $findExperience->status = $status;
        $findExperience->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function create(Request $request)
    {
        $id         = $request->experienceId;
        $experience = null;
        if (!is_null($id)) {
            $experience = Experience::find($id);
        }
        return view('admin.experience.create', compact('experience'));
    }

    public function store(ExperienceRequest $request)
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->experienceId)) {
            $experience = Experience::find($request->experienceId);
            $experience->update([
                'company'         => $validated['company'],
                'position'        => $validated['position'],
                'experience_date' => $validated['experience_date'],
                'description'     => $validated['description'],
                'order'           => $validated['order'],
                'status'          => $status,
            ]);

            alert()->success("Successful", "Experience information updated")->persistent(true, true);
        } else {
            Experience::create([
                'company'         => $validated['company'],
                'position'        => $validated['position'],
                'experience_date' => $validated['experience_date'],
                'description'     => $validated['description'],
                'order'           => $validated['order'],
                'status'          => $status,
            ]);

            alert()->success("Successful", "Experience information added")->persistent(true, true);
        }

        return redirect()->route('admin.experience.index');
    }

    public function delete(Request $request)
    {
        $id = $request->experienceId;
        Experience::where('id', $id)->delete();
        return response()->json(['message' => "Experience deleted"], 200);
    }
}
