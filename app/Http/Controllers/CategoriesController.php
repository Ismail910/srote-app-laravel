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
        $parants = Categories::all();
        return view('dashboard\categories\create', compact('parants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        $request->marge([
            'slug'=> Str::slug($request->post('name'))
        ]);
        $category = Categories::create($request->all());
        return Redirect::route('dashboard\categories\index')->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
