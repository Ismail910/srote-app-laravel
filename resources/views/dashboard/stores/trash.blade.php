@extends('layouts.index')
@section('title', 'Trashed stores')

@section('breadcrumb')

@parent
<li class="breadcrumb-item active"><a href="{{route('stores.index')}}">storeS</a></li>
<li class="breadcrumb-item active"><a href="{{route('stores.trash')}}">trashed</a></li>
@endsection

@section('content')

<form method="get" action="{{ URL::current()}}" class="d-flex justify-content-between">
    <x-form.input name="name" placeholder="Name" :value="request('name')" />
    <select name="status" class="form-control">
        <option value="">All</option>
        <option value="active" @selected(request('status')=='active' )>active</option>
        <option value="archived" @selected(request('status')=='archived' )>archived</option>
    </select>
    <button class="btn btn-dark">Filter</button>
</form>

@if(session()->has('success'))
<x-alert type="success" />
@endif
@if(session()->has('error'))
<x-alert type="error" />
@endif
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">ID</th>
                <th scope="col">cover image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">deleted At</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stores as $store)
            <tr class="">

                <td>{{ $store->id }}</td>
                <td><img width="100" src="{{asset('storage/'.$store->cover_image)}} " /></td>
                <td>{{ $store->name }}</td>
                <td>{{ $store->description  }}</td>
                <td>{{ $store->deleted_at }}</td>
                <td>{{ $store->status }}</td>

                <td>
                    <form method="post" action="{{ route('stores.restore', $store->id) }}">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn btn-sm btn-outline-success">Restore</button>
                    </form>
                </td>
                <td>
                    <form method="post" action="{{ route('stores.force-delete', $store->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-success">Delete</button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="7">No stores defined</td>
            </tr>

            @endforelse
        </tbody>
    </table>

    {{$stores->withQueryString()->links()}}

    <!-- {{$stores->appends(request()->query())->links()}} -->
    <a class="btn btn-sm btn-outline-success" href="{{ route('stores.index') }}">Back</a>

</div>
@endsection