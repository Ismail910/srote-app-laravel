<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoresRequest;
use App\Http\Requests\UpdateStoresRequest;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoresRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $stores)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $stores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoresRequest $request, Store $stores)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $stores)
    {
        //
    }
}
