<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with([
            'user' => function ($query) {
                $query->select('id', 'name');
            },
            'category' => function ($query) {
                $query->select('id', 'name');
            }
        ])->orderBy('created_at', 'DESC')->paginate(10);
        return view('back.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('back.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        try {
            $product = Product::create($request->except('_token', 'images'));
        } catch (\Exception $exception) {
            Log::error($exception);
            toast("Bir hata oluştu!", "error");
            return redirect()->back();
        }

        try {

            foreach ($request->images as $image) {
                $imageName = $product->slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/images/products', $imageName);
                $product->images()->create([
                    'path' => 'storage/public/images/products/' . $imageName,
                    'is_thumbnail' => false,
                ]);
            }

            toast("Ürün oluşturuldu!", "success");
            return redirect()->route('back.product.index');
        }
        catch (\Exception $exception) {
            Log::error($exception);
            toast("Görseller yüklenirken bir hata oluştu!", "error");
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
