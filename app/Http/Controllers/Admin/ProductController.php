<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.products.index',compact('products'));
    }
    public function create() {
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::where('status',0)->get();
        return view('admin.products.create', compact('categories', 'brands','colors'));
    }
    public function store(ProductFormRequest $request) {
        
        $validated = $request->validated();

        $category = Category::findOrFail($validated['category_id']);
        $product = $category->products()->create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'brand' => $validated['brand'],
            'small_description' => $validated['small_description'],
            'description' => $validated['description'],
            'original_price' => $validated['original_price'],
            'selling_price' => $validated['selling_price'],
            'quantity' => $validated['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
        ]);

        if($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePath = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePath,
                ]);
            }
        }

        if($request->colors){
            foreach($request->colors as $key => $color) {
                $product->productColors()->create([
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'quantity' => $request->colorquantity[$key] ?? 0,
                ]);
            }
        }

        return redirect('/admin/products')->with('message','Product added');
    }

    public function edit(Product $product) {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit',compact('product','categories','brands'));
    }

    public function update(ProductFormRequest $request, Product $product) {
        $validated = $request->validated();

        $product->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['slug']),
            'brand' => $validated['brand'],
            'small_description' => $validated['small_description'],
            'description' => $validated['description'],
            'original_price' => $validated['original_price'],
            'selling_price' => $validated['selling_price'],
            'quantity' => $validated['quantity'],
            'trending' => $request->trending == true ? '1' : '0',
            'status' => $request->status == true ? '1' : '0',
            'meta_title' => $validated['meta_title'],
            'meta_description' => $validated['meta_description'],
            'meta_keyword' => $validated['meta_keyword'],
        ]);

        if($request->hasFile('image')) {
            $uploadPath = 'uploads/products/';
            $i = 1;
            foreach($request->file('image') as $imageFile){
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time().$i++.'.'.$extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePath = $uploadPath.$filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePath,
                ]);
            }
        }

        return redirect('/admin/products')->with('message','Product updated');
    }

    public function deleteImage($delete_image_id) {
        $image = ProductImage::findOrFail($delete_image_id);
        if(File::exists($image->image)){
            File::delete($image->image);
        }
        $image->delete();

        return redirect()->back()->with('message','image deleted');
    }
    public function delete(Product $product) {
        foreach($product->productImages() as $image) {
            if(File::exists($image->image)){
                File::delete($image->image);
            }
        }
        $product->delete();
        return redirect('/admin/products')->with('message','Product deleted');
    }
}
