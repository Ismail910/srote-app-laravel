@extends('layouts.index')
@section('title','STORE DETILS' )

@section('breadcrumb')

@parent
<li class="breadcrumb-item active"><a href="{{route('stores.index')}}">Store</a></li>
<li class="breadcrumb-item active">Store DETIL</li>
@endsection

@section('content')
<h2>Store Name: {{$store->name}}</h2>
<table class="table table-primary">
    <thead>
        <tr>

            <th scope="col">ID</th>
            <th scope="col">cover img</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Created At</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>



        <tr class="">
            <td><img width="100" src="{{asset('storage/'.$store->cover_image)}} " /></td>
            <td>{{ $store->id}}</td>
            <td>{{ $store->name}}</td>
            <td>{{ $store->description}}</td>
            <td>{{ $store->created_at }}</td>
            <td>{{ $store->status }}</td>

    </tbody>
</table>


@endsection