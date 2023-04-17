<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use App\Models\Education;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = Education::all();

        return view('admin.education.index', compact('educations'));
    }

    public function changeStatus(Request $request)
    {
        $id            = $request->educationId;
        $findEducation = Education::find($id);
        $status        = $findEducation->status ? 0 : 1;

        $findEducation->status = $status;
        $findEducation->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $id        = $request->educationId;
        $education = null;
        if (!is_null($id)) {
            $education = Education::find($id);
        }
        return view('admin.education.create', compact('education'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EducationRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->educationId)) {
            $education = Education::find($request->educationId);
            $education->update([
                'university'     => $validated['university'],
                'faculty'        => $validated['faculty'],
                'education_type' => $validated['education_type'],
                'education_date' => $validated['education_date'],
                'description'    => $validated['description'],
                'order'          => $validated['order'],
                'status'         => $status,
            ]);

            alert()->success("Successful", "Education information updated")->persistent(true, true);
        } else {
            Education::create([
                'university'     => $validated['university'],
                'faculty'        => $validated['faculty'],
                'education_type' => $validated['education_type'],
                'education_date' => $validated['education_date'],
                'description'    => $validated['description'],
                'order'          => $validated['order'],
                'status'         => $status,
            ]);

            alert()->success("Successful", "Education information added")->persistent(true, true);
        }

        return redirect()->route('admin.education.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        $id = $request->educationId;
        Education::where('id', $id)->delete();
        return response()->json(['message' => "Education deleted"], 200);
    }
}
