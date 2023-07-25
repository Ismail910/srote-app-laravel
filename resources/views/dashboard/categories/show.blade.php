@extends('layouts.index')
@section('title','CATEGORIE DETILS'  )

@section('breadcrumb')

    @parent
   <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">CATEGORIES</a></li>
   <li class="breadcrumb-item active">CATEGORIE DETIL</li>
@endsection

@section('content')
<h2>Category Name: {{$category->name}}</h2>
<table class="table table-primary">
        <thead>
            <tr>
                <th scope="col">img</th>
                <th scope="col">Name</th>
                <th scope="col">category</th>
                <th scope="col">Store</th>
                <th scope="col">Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $products = $category->products()->with('store')->latest()->paginate(5)
            @endphp
            @forelse( $products as $product)
            
            <tr class="">
                <td><img width="100"  src="{{asset('storage/'.$product->img)}} "/></td>
                <td>{{ $product->name}}</td>
                <td>{{ $product->category->name}}</td>
                <td>{{ $product->store->name}}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->status }}</td>
            @empty
            <tr>
                <td colspan="7">No products defined</td>
            </tr>

            @endforelse
        </tbody>
    </table>
    {{  $products->links()}}

@endsection
