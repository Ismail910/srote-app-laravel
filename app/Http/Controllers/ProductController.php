<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $products = Product::with(['category', 'store'])->paginate(5);
       return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();
        $tags = new Tag();
        return view('dashboard.products.create', compact('product','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $request->merge([
            'slug'=>str::slug($request->post('name')),
        ]);
        $data = $request->except('image');
        if($request->hasFile('image')){
            $file = $request->file('image');
            $path = $file->store('uploads/products','public');
            $data['image'] = $path ;
        }

        $product =  Product::create($data);
        $tags =  json_decode($request->post('tags'));
        $tag_ids = [];
        $saved_tags = Tag::all();
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        return redirect()->route('products.index')->with('success','Success Product Added');



    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        return view('dashboard.products.show', compact('product', 'tags'));

    }


    public function edit(Product $product)
{
    $tags = implode(',', $product->tags()->pluck('name')->toArray());
    return view('dashboard.products.edit', compact('product', 'tags'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->except('tags'));
        $tags =  json_decode($request->post('tags'));
        $tag_ids = [];

        // foreach ($tags as $item) {
        //     $slug = Str::slug($item->value);
        //     $tag = Tag::where('slug', $slug)->first();
        //     if(!$tag){
        //         $tag = Tag::create([
        //             'name' => $item->value,
        //             'slug' => $slug,
        //         ]);
        //     }
        //     $tag_ids[] = $tag->id;
        // }


        $oldImage = $product->image;

        if ($request->hasFile('image')) {
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            $file = $request->file('image');
            $path = $file->store('uploads/products', 'public');
            $product->image = $path;
            $product->save();
        }

        $saved_tags = Tag::all();
        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = $saved_tags->where('slug', $slug)->first();
            if(!$tag){
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);


        return redirect()->route('products.index')->with('success','Success update product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if(!$product->image){
            $product->delete();
        }

            Storage::disk('public')->delete($product->image);
            $product->delete();
            return redirect()->route('products.index')->with('success','Success delete product');
    }


public function trash(){
    $products = Product::onlyTrashed()->paginate(10);
    return view('dashboard\products\trash', compact('products'));
}

public function restore(Request $request, $id){
    $product  = Product::onlyTrashed()->findOrFail($id);
    $product->restore();
    return redirect()->route('products.trash')->with('success','product restored!');
}
public function force_delete($id){
    $product = Product::onlyTrashed()->findOrFail($id);
    $product->forceDelete();
     if ($product->image){
            Storage::disk('public')->delete($product->image);
        }
    return redirect()->route('products.trash')->with('success','product deleted!');
}


}
