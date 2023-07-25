<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  

       

        $request = request();
        // $query = Category::query();
        // if($name = $request->query('name')){
        //     $query->where('name', 'like', "%{$name}%");
        // }
        // if($status = $request->query('status')){
        //     $query->where('status', '=', $status);
        // }   
           
            $cat = Category::with('parent')
            /*leftjoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])*/

          
            
            ->withCount([
                'products'=>function($query){
                    $query->where('status', '=', 'active');
                }]) 
            // ->select('categories.*')
            // ->selectRaw('(SELECT COUNT(*) from products where status = "active" AND category_id = categories.id) as products_count')
            // ->addSelect(DB::raw('(SELECT COUNT(*) from products where AND status = 'active' AND category_id = categories.id) as products_count)')
            ->filter($request->query())
            // ->latest()
            // ->onlyTrashed() dicplayed the category by softDelete
           
            ->paginate(10);
        // $cat = $query->paginate(2);
        // $cat = Category::active()->paginate(3);
        // $cat = Category::Status('archived')->paginate(2);
        return view('dashboard\categories\index',['categories'=>$cat] );
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $categorie = new Category();
        return view('dashboard\categories\create', compact('parents','categorie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
       
        // $request::marge([
        //     'slug'=> Str::slug($request->post('name'))
        // ]);
        // $category =Category::create($request->all());
        // return Redirect::route('dashboard\categories\index')->with('success', 'Category created successfully');
           
            
        // $data = $request->merge([
        //     'slug' => Str::slug($request->input('name'))
        // ])->all();
    
        // $category = Category::create($data);
    
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
        // Category::create($request->post());
        /////////////////////////////// anthor way ////////////////////////////////

        // $Category= request()->all();
        // $categorie = new Category();
        // $image= request()->img;
        // if($image){
        //     $image_info = time().'.'.$image->extension();
        //     $categorie->img = $image_info;
        //     $image->move(public_path('images/categories'), $image_info);  
        // }
        // $categorie->name= $Category['name'];
        // $categorie->parent_id= $Category['parent_id'];
        // $categorie->description = $Category['description'];
        // $categorie->slug =  Str::slug($request->post('name'));
        // $categorie->status = $Category['status'];

        // $categorie->save();

        /////////////////////////////// anthor way ////////////////////////////////

        $request->merge([
            "slug"=>str::slug($request->post('name')),
           
        ]);
       $data = $request->except('img');
        // if($request->hasFile('img')){
        //     $file = $request->file('img');
        //     // $path = $file->store('uploads',[
        //     //     'disc'=>'public'
        //     // ]);
        //     $path = $file->store('uploads', 'public');
        //     $data['img'] = $path;
        // }
        if ($request->hasFile('img')) {
            $path = $this->uploadImage($request);
            $data['img'] = $path;
        }
        $data['parent_id'] = $request->parent_id;
       
        Category::create($data);
       

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }
   

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
       return view('dashboard.categories.show', [
        'category' => $category
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $parents = Category::where('id', '<>', $id)
        ->get();
        $categorie = Category::where('id' , $id)->first();
        if($categorie){
            return view('dashboard.categories.edit', compact('parents', 'categorie'));
        }else{
            
            
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        // $category =  request()->all();
        // $categories =Category::where('id', $id)->first();
        // $img = request()->img;
       
        // if($img){
        //     if ($categories->img && file_exists(public_path('images/categories/' . $categories->img))){
        //         unlink(public_path('images/categories/' . $categories->img));
        //     }
        //     $image_info = time().'.'.$img->extension();
        //     $categories->img = $image_info;
        //     $img->move(public_path('images/categories'), $image_info); 
            
        // }
        // $categories->name = $category['name'];
        // if( $request['parent_id']){
        //     $categories->parent_id= $category['parent_id'];
        // }
        // $categories->description = $category['description'];
        // $categories->slug =  Str::slug($request->post('name'));
        // $categories->status = $category['status'];

        // $categories->save();
        ///////////////////////////////////// anthor way ////////////////////////////
        
        $category = Category::findOrFail($id);
        $old_img = $category->img;
        
        // $data = $request->except('img');
        // if ($request->hasFile('img')){
        //     $file = $request->file('img');
        //     $path = $file->store('uploads', 'public');
        //     $data['img'] = $path;
        // }
        $data = $request->except('img');
        if ($request->hasFile('img')) {
            $path = $this->uploadImage($request);
            $data['img'] = $path;
            if ($category->img && Storage::disk('public')->exists($category->img)) {
                Storage::disk('public')->delete($category->img);
            }
        }
        $category->update($data);
        if($old_img && isset($data['img'])){
            Storage::disk('public')->delete($old_img);
        }
        return redirect()->route('categories.index')->with('success', 'Category updeted successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
    //   if ($category){
    //         if($category->img ){
    //             try {
    //                 unlink(public_path('images/categories/' . $category->img));
    //             } catch (\Throwable $th) {}
    //         }
    //     }
    //         $category->delete();

    ////////////////////////////////////anthor way //////////////////
        $category->delete();
        // if ($category->img){
        //     Storage::disk('public')->delete($category->img);
        // }
        return back()->with('success', 'Post has been deleted successfully');
      
    }

    public function uploadImage( $request){
        if(!$request->hasFile('img')){
            return;
        }
       $file = $request->file('img');
       $path = $file->store('uploads','public');
       return $path;
    }
   


    // public function update(UpdateCategoryRequest $request, string $id)
    // {
        // Retrieve the category by ID
        // $category = Category::findOrFail($id);

        // Remove the 'img' field from the request data
        // $data = $request->except('img');

        // Check if a new image file is uploaded
        // if ($request->hasFile('img')) {
        //     // Upload the new image
        //     $path = $this->uploadImage($request);

        //     // Update the 'img' field in the $data array
        //     $data['img'] = $path;

        //     // Delete the old image file
        //     if ($category->img && Storage::disk('public')->exists($category->img)) {
        //         Storage::disk('public')->delete($category->img);
        //     }
        // }

    //     // Update the category with the new data
    //     $category->update($data);

    //     return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    // }

// public function uploadImage( $request)
// {
//     if (!$request->hasFile('img')) {
//         return null;
//     }

//     $file = $request->file('img');
//     $path = $file->store('uploads', 'public');
//     return $path;
// }


public function trash(){
    $categories = Category::onlyTrashed()->paginate(10);
    return view('dashboard\categories\trash', compact('categories'));
}

public function restore(Request $request, $id){
    $category  = Category::onlyTrashed()->findOrFail($id);
    $category->restore();
    return redirect()->route('categories.trash')->with('success','category restored!');
}
public function force_delete($id){
    $category = Category::onlyTrashed()->findOrFail($id);
    $category->forceDelete();
     if ($category->img){
            Storage::disk('public')->delete($category->img);
        }
    return redirect()->route('categories.trash')->with('success','category deleted!');
}


}
