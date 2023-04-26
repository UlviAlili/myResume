<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\Portfolios_Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('featuredImage')->get();

        return view('admin.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        $portfolio = '';
        return view('admin.portfolio.create', compact('portfolio'));
    }

    public function store(PortfolioRequest $request)
    {
        $validated = $request->validated();

        $portfolio = Portfolio::create([
            'title'       => $validated['title'],
            'tags'        => $validated['tags'],
            'about'       => $validated['about'],
            'website'     => $validated['website'],
            'keywords'    => $validated['keywords'],
            'description' => $validated['description'],
            //            'order'       => $validated['order'],
            'status'      => isset($validated['status']) ? 1 : 0,
        ]);

        if ($request->file('image')) {
            $now = now()->format('YmdHis');
            $i   = 0;
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $name      = $image->getClientOriginalName();
                $explode2  = explode('.', $name);
                $slugName  = Str::slug($explode2[0], '-') . "_" . $now . "." . $extension;

                Storage::putFileAs('public/portfolio', $image, $slugName);

                $path = 'portfolio/' . $slugName;

                Portfolios_Images::create([
                    'portfolio_id' => $portfolio->id,
                    'image'        => $path,
                    'featured'     => $i == 0 ? 1 : 0,
                    'status'       => 1,
                ]);
                $i = 1;
            }
        }

        alert()->success("Successful", "Portfolio information added")->persistent(true, true);
        return redirect()->route('admin.portfolio.index');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $portfolio = Portfolio::find($id);

        return view('admin.portfolio.create', compact('portfolio'));
    }

    public function update(PortfolioRequest $request, string $id)
    {
        $portfolio       = Portfolio::find($id);
        $validatedUpdate = $request->validated();

        $portfolio->update([
            'title'       => $validatedUpdate['title'],
            'tags'        => $validatedUpdate['tags'],
            'about'       => $validatedUpdate['about'],
            'website'     => $validatedUpdate['website'],
            'keywords'    => $validatedUpdate['keywords'],
            'description' => $validatedUpdate['description'],
            //            'order'       => $validated['order'],
            'status'      => isset($validatedUpdate['status']) ? 1 : 0,
        ]);

        if ($request->file('image')) {
            $now = now()->format('YmdHis');
            $j   = 0;
            foreach ($request->file('image') as $image2) {
                $extension2 = $image2->getClientOriginalExtension();
                $name2      = $image2->getClientOriginalName();
                $explode3   = explode('.', $name2);
                $slugName2  = Str::slug($explode3[0], '-') . "_" . $now . "." . $extension2;

                Storage::putFileAs('public/portfolio', $image2, $slugName2);

                $path2 = 'portfolio/' . $slugName2;

                Portfolios_Images::create([
                    'portfolio_id' => $id,
                    'image'        => $path2,
                    'featured'     => $j == 0 ? 1 : 0,
                    'status'       => 1,
                ]);
                $j = 1;
            }
        }

        alert()->success("Successful", "Portfolio information updated")->persistent(true, true);
        return redirect()->route('admin.portfolio.index');

    }

    public function destroy(string $id)
    {
        $portfolio = Portfolio::find($id);
        if ($portfolio) {
            $portfolio->delete();
        }
        return response()->json(['success' => true], 200);
    }

    public function changeStatus(Request $request)
    {
        $id            = $request->portfolioId;
        $findPortfolio = Portfolio::find($id);
        $status        = $findPortfolio->status ? 0 : 1;

        $findPortfolio->status = $status;
        $findPortfolio->save();

        return response()->json([
            'status' => $status,
        ]);
    }

}
