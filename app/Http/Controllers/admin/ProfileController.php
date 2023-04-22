<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Profile::find(1);

        return view('admin.profile.create', compact('information'));
    }

    public function update(ProfileRequest $request)
    {
        //        dd($request->all());
        $validated = $request->validated();

        $information = Profile::find(1);
        if ($request->file('cv')) {
            $file             = $request->file('cv');
            $extension        = $file->getClientOriginalExtension();
            $fileOriginalName = $file->getClientOriginalName();
            $explode          = explode('.', $fileOriginalName);

            $fileOriginalName = Str::slug($explode[0], '-') . '_' . now()->format('d-m-y_H-i-s') . '.' . $extension;
            Storage::putFileAs('public/cv', $file, $fileOriginalName);
            $cv = 'cv/' . $fileOriginalName;
            $information->update([
                'cv' => $cv,
            ]);
        }
        if ($request->file('image')) {
            $file2             = $request->file('image');
            $extension2        = $file2->getClientOriginalExtension();
            $fileOriginalName2 = $file2->getClientOriginalName();
            $explode2          = explode('.', $fileOriginalName2);

            $fileOriginalName2 = Str::slug($explode2[0], '-') . '_' . now()->format('d-m-y_H-i-s') . '.' . $extension2;
            Storage::putFileAs('public/image', $file2, $fileOriginalName2);
            $image = 'image/' . $fileOriginalName2;
            $information->update([
                'image' => $image,
            ]);
        }

        $information->update([
            'main_title'        => $validated['main_title'],
            'about_text'        => $validated['about_text'],
            'btn_contact_text'  => $validated['btn_contact_text'],
            'small_title_left'  => $validated['small_title_left'],
            'small_title_right' => $validated['small_title_right'],
            'full_name'         => $validated['full_name'],
            'job_name'          => $validated['job_name'],
            'website'           => $validated['website'],
            'phone'             => $validated['phone'],
            'mail'              => $validated['mail'],
            'location'          => $validated['location'],
        ]);

        alert()->success("Successful", "Profile information updated")->persistent(true, true);

        return redirect()->back();
    }


}
