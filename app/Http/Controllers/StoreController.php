<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::with('products')->paginate(5);
        return view('dashboard.stores.index', ['stores' => $stores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = new Store();

        return view('dashboard.stores.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStoreRequest $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except(['logo_image', 'cover_image']);

        $logo_image = $request->file('logo_image');
        $data['logo_image'] = $this->save_image($logo_image);

        $cover_image = $request->file('cover_image');
        $data['cover_image'] = $this->save_image($cover_image);



        Store::create($data);

        return redirect()->route('stores.index')->with('success', 'Create Store Success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $products = $store->products->paginate(5);
        return view('dashboard.store.show', ['products' => $products, 'store' => $store]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        return view('dashboard.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name')),
        ]);

        $data = $request->except(['logo_image', 'cover_image']);
        $oldLogoImage = $store->logo_image;
        $oldCoverImage = $store->cover_image;

        if ($request->hasFile('logo_image')) {
            $this->delete_image($oldLogoImage); // Delete old logo image
            $logo_image = $request->file('logo_image');
            $data['logo_image'] = $this->save_image($logo_image);
        }
        if ($request->hasFile('cover_image')) {
            $this->delete_image($oldCoverImage);
            $cover_image = $request->file('cover_image');
            $data['cover_image'] = $this->save_image($cover_image);
        }



        $store->update($data);

        return redirect()->route('stores.index')->with('success', 'Update Store Success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $oldLogoImage = $store->logo_image;
        $oldCoverImage = $store->cover_image;

        if ($store->logo_image) {
            $this->delete_image($oldLogoImage);
        }
        if ($store->cover_image) {
            $this->delete_image($oldCoverImage);
        }

        $store->delete();

        return back()->with('success', 'Store has been deleted successfully');
    }



    public function trash()
    {
        $stores = store::onlyTrashed()->paginate(10);
        return view('dashboard\stores\trash', compact('stores'));
    }

    public function restore(Request $request, $id)
    {
        $store  = store::onlyTrashed()->findOrFail($id);
        $store->restore();
        return redirect()->route('stores.trash')->with('success', 'store restored!');
    }
    public function force_delete($id)
    {
        $store = store::onlyTrashed()->findOrFail($id);
        $store->forceDelete();
        if ($store->logo_image) {
            Storage::disk('public')->delete($store->logo_image);
        }
        if ($store->cover_image) {
            Storage::disk('public')->delete($store->cover_image);
        }
        return redirect()->route('stores.trash')->with('success', 'store deleted!');
    }





    private function save_image($image)
    {
        if ($image) {
            $save_path = $image->store('uploads/stores', 'public');
            return $save_path;
        }
    }

    private function delete_image($path)
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
