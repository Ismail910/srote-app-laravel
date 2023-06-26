<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $cat = Categories::all();
        
        return view('dashboard\categories\index',['categories'=>$cat] );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorie = Categories::all();
        return view('dashboard\categories\create', compact('categorie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
       
        // $request::marge([
        //     'slug'=> Str::slug($request->post('name'))
        // ]);
        // $category =Categories::create($request->all());
        // return Redirect::route('dashboard\categories\index')->with('success', 'Category created successfully');
           
            
        // $data = $request->merge([
        //     'slug' => Str::slug($request->input('name'))
        // ])->all();
    
        // $category = Categories::create($data);
    
        // if ($request->hasFile('img')) {
        //     $image = $request->file('img');
        //     if ($image->isValid()) {
        //         $profilePhoto = base64_encode(file_get_contents($image));
        //         $request->merge(['img' => $profilePhoto]);
        //     } else {
        //         return redirect()->back()->with('error', 'Invalid file upload');
        //     }
        // }
        // dd($request);
        // Categories::create($request->post());
        ///////////////////////////////////////////////////////////////

        $categories= request()->all();
        $categorie = new Categories();
        $image= request()->img;
        if($image){
            $image_info = time().'.'.$image->extension();
            $categorie->img = $image_info;
            $image->move(public_path('images/categories'), $image_info);  
        }
        $categorie->name= $categories['name'];
        $categorie->parent_id= $categories['parent_id'];
        $categorie->description = $categories['description'];
        $categorie->slug =  Str::slug($request->post('name'));
        $categorie->status = $categories['status'];

        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');

    }
   

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        if($categories){
            return $categories;
        }else{

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $parents = Categories::where('id','<>',$id)->get();
        $categorie = Categories::where('id' , $id)->first();
        if($categorie){
            return view('dashboard.categories.edit', compact('parents', 'categorie'));
        }else{
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, string $id)
    {
        $category =  request()->all();
        $categories =Categories::where('id', $id)->first();
        $img = request()->img;
       
        if($img){
            if ($categories->img && file_exists(public_path('images/categories/' . $categories->img))){
                unlink(public_path('images/categories/' . $categories->img));
            }
            $image_info = time().'.'.$img->extension();
            $categories->img = $image_info;
            $img->move(public_path('images/categories'), $image_info); 
            
        }
        $categories->name = $category['name'];
        if( $request['parent_id']){
            $categories->parent_id= $category['parent_id'];
        }
        $categories->description = $category['description'];
        $categories->slug =  Str::slug($request->post('name'));
        $categories->status = $category['status'];

        $categories->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
      if ($category){
            if($category->img ){
                try {
                    unlink(public_path('images/categories/' . $category->img));
                } catch (\Throwable $th) {}
            }
       
        }
            $category->delete();
            return back()->with('success', 'Post has been deleted successfully');
      
    }
   
}
