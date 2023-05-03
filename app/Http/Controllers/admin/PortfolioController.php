<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use App\Models\Portfolio;
use App\Models\Portfolios_Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Exception;
use function PHPUnit\Framework\isEmpty;

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
            'order'       => $validated['order'],
            'status'      => isset($validated['status']) ? 1 : 0,
        ]);

        if ($request->file('image')) {
            $now = now()->format('YmdHis');
            $p   = Portfolios_Images::where('portfolio_id', $portfolio->id)->get();
            $i   = count($p) > 0 ? 1 : 0;
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

    public function showImages(Request $request, string $id)
    {
        $images = Portfolios_Images::where('portfolio_id', $id)->get();

        return view('admin.portfolio.images', compact('images'));
    }

    public function addImages(Request $request, $id)
    {
        if ($request->file('image')) {
            $now = now()->format('YmdHis');
            $p   = Portfolios_Images::where('portfolio_id', $id)->get();
            $i   = count($p) > 0 ? 1 : 0;
            foreach ($request->file('image') as $image) {
                $extension = $image->getClientOriginalExtension();
                $name      = $image->getClientOriginalName();
                $explode2  = explode('.', $name);
                $slugName  = Str::slug($explode2[0], '-') . "_" . $now . "." . $extension;

                Storage::putFileAs('public/portfolio', $image, $slugName);

                $path = 'portfolio/' . $slugName;

                Portfolios_Images::create([
                    'portfolio_id' => $id,
                    'image'        => $path,
                    'featured'     => $i == 0 ? 1 : 0,
                    'status'       => 1,
                ]);
                $i = 1;
            }
        }

        alert()->success("Successful", "Portfolio images added")->persistent(true, true);
        return redirect()->back();
    }

    public function edit(string $id)
    {
        $portfolio = Portfolio::find($id);

        return view('admin.portfolio.create', compact('portfolio'));
    }

    public function deleteImages($id)
    {
        try {
            $image = Portfolios_Images::find($id);
            if ($image) {
                if (file_exists('storage/' . $image->image)) {
                    unlink('storage/' . $image->image);
                }
                $image->delete();
            }
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return response()->json(['success' => true], 200);
    }

    public function statusImages(Request $request)
    {
        $id            = $request->portfolioId;
        $findPortfolio = Portfolios_Images::find($id);
        if ($findPortfolio->featured === 1) {
            $status = '';
        } else {
            $status                = $findPortfolio->status ? 0 : 1;
            $findPortfolio->status = $status;
            $findPortfolio->save();
        }

        return response()->json([
            'status' => $status,
        ]);
    }

    public function featureImage(Request $request)
    {
        $id            = $request->portfolioId;
        $findImage     = Portfolios_Images::find($id);
        $portfolio_id  = $findImage->portfolio_id;
        $featuredImage = Portfolios_Images::where('portfolio_id', $portfolio_id)->where('featured', 1)->first();
        $feature       = $findImage->featured ? 0 : 1;

        $featuredImage->featured = 0;
        $featuredImage->save();

        $findImage->featured = $feature;
        $findImage->save();

        return response()->json([
            'feature' => $feature,
        ]);
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
            'order'       => $validatedUpdate['order'],
            'status'      => isset($validatedUpdate['status']) ? 1 : 0,
        ]);

        if ($request->file('image')) {
            $now = now()->format('YmdHis');
            $p   = Portfolios_Images::where('portfolio_id', $id)->get();
            $j   = count($p) > 0 ? 1 : 0;
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
