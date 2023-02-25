<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = Product::where('is_active', 1)
            ->with('category')
            ->latest('id')
            ->select(
                'id',
                'category_id',
                'name',
                'slug',
                'product_price',
                'product_stock',
                'alert_quantity',
                'product_image',
                'product_rating',
                'updated_at'
            )
            ->get();
        return view('backend.pages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'title'])->get();
        return view('backend.pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'product_code' => $request->product_code,
            'product_price' => $request->product_price,
            'product_stock' => $request->product_stock,
            'alert_quantity' => $request->alert_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'additional_info' => $request->additional_info,
        ]);
        $this->image_upload($request, $product->id);

        Toastr::success('New Product Added Successfully');

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::get(['id', 'title']);
        $products = Product::whereSlug($slug)->first();

        return view('backend.pages.product.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //dd($request->all());
        //dd($request->all());
        $products = Product::whereSlug($slug)->first();
        $products->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'product_code' => $request->product_code,
            'product_price' => $request->product_price,
            'product_stock' => $request->product_stock,
            'alert_quantity' => $request->alert_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'additional_info' => $request->additional_info,
        ]);

        //dd($request->all());
        $this->image_upload($request, $products->id);

        Toastr::success('Product Updated Successfully');

        return redirect()->route('product.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $products = Product::whereSlug($slug)->first();

        if ($products->product_image != 'default_product.jpg') {
            if ($products->product_image) {
                $photo_location = 'uploads/products/' . $products->product_image;
                unlink($photo_location);
            }
        }

        $products->delete();

        Toastr::success('Product Deleted Successfully');

        return redirect()->route('product.index');
    }

    public function image_upload($request, $item_id)
    {
        $product = Product::findorFail($item_id);

        if($request->hasFile('product_image'))
        {
            if($product->product_image != 'default_product.jpg')
            {
                //delete image
                $photo_location = 'public/uploads/products/';
                $old_photo_location = $photo_location .
                $product->product_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/products/';
            $uploaded_photo = $request->file('product_image');
            $new_photo_name = $product->id . '.' .
            $uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location . $new_photo_name;
            Image::make($uploaded_photo)->resize(600,600)->save(base_path($new_photo_location),40);
            $check = $product->update([
                'product_image' => $new_photo_name
            ]);
        }
    }
}
