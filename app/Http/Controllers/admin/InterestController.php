<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InterestRequest;
use App\Models\Interest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    public function index()
    {
        $interests = Interest::all();

        return view('admin.interest.index', compact('interests'));
    }

    public function create(Request $request)
    {
        $id       = $request->interestId;
        $interest = null;
        if (!is_null($id)) {
            $interest = Interest::find($id);
        }
        return view('admin.interest.create', compact('interest'));
    }

    public function store(InterestRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $status    = 0;
        if (isset($request->status)) {
            $status = 1;
        }

        if (isset($request->interestId)) {
            $interest = Interest::find($request->interestId);
            $interest->update([
                'name'   => $validated['name'],
                'order'  => $validated['order'],
                'status' => $status,
            ]);

            alert()->success("Successful", "Interest updated")->persistent(true, true);
        } else {
            Interest::create([
                'name'   => $validated['name'],
                'order'  => $validated['order'],
                'status' => $status,
            ]);

            alert()->success("Successful", "Interest added")->persistent(true, true);
        }

        return redirect()->route('admin.interest.index');
    }

    public function changeStatus(Request $request): JsonResponse
    {
        $id           = $request->interestId;
        $findInterest = Interest::find($id);
        $status       = $findInterest->status ? 0 : 1;

        $findInterest->status = $status;
        $findInterest->save();

        return response()->json([
            'status' => $status,
        ]);
    }

    public function delete(Request $request): JsonResponse
    {
        $id = $request->interestId;
        Interest::where('id', $id)->delete();
        return response()->json(['message' => "Interest deleted"], 200);
    }
}
