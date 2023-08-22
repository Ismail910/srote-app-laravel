@extends('layouts.index')
@section('title','PRODUCT DETILS'  )

@section('breadcrumb')

    @parent
   <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">PRODUCT</a></li>
   <li class="breadcrumb-item active">PRODUCT DETIL</li>
@endsection

@section('content')
<h2>Product Name: {{$product->name}}</h2>
<table class="table table-primary">
        <thead>
            <tr>

                <th scope="col">ID</th>
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
           
          

            <tr class="">
                <td><img width="100"  src="{{asset('storage/'.$product->img)}} "/></td>
                <td>{{ $product->id}}</td>
                <td>{{ $product->name}}</td>
                <td>{{ $product->category->name}}</td>
                <td>{{ $product->store->name}}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->status }}</td>
           
        </tbody>
    </table>
   

@endsection
