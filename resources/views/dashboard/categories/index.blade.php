@extends('layouts.index')
@section('title', 'STORE APP')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">CATEGORIES</li>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table table-primary">
        <thead>
            <tr>
                <!-- <th scope="col"></th> -->
                <th scope="col">ID</th>
                <th scope="col">img</th>
                <th scope="col">Name</th>
                <th scope="col">Parent</th>
                <th scope="col">Created At</th>
                <!-- <th scope="col"></th> -->
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="">
                
                <td>{{ $category->id }}</td>
                <td><img width="100"  src="{{asset('images/categories/'.$category->img)}} "/></td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent_id  }}</td>
                <td>{{  $category->created_at }}</td>
                
                <td>
                    <a class="btn btn-sm btn-outline-success" href="{{ route('categories.edit', $category->id) }}">Edit</a>
                </td>
                <td>
                    <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-success">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No categories defined</td>
            </tr>
            @endforelse
        </tbody>
    </table>
   
                    <a class="btn btn-sm btn-outline-success" href="{{ route('categories.create') }}">create categorie</a>
              
</div>
@endsection
