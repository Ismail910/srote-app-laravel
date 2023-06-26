@extends('layouts.index')
@section('title', 'Update CATEGORIES')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">UPDATE CATEGORIES</li>
@endsection

@section('content')   
<form action="{{route('categories.update', ['category' => $categorie->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('put')

    <div class="form-group mt-3">
        <label for="exampleInputEmail1">Category Name</label>
        <input type="text" class="form-control" name="name" value="{{ $categorie->name }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>

    <div class="form-group mt-3">
        <label for="exampleInputPassword1">Category Parent</label>
        <select class="form-select" aria-label="Default select example" name="parent_id">
            @foreach($parents as $parantCategory)
            <option value="{{ $parantCategory->id }}" {{ $categorie->parent_id == $parantCategory->id ? 'selected' : '' }}>
                {{ $parantCategory->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" class="form-control">{{ $categorie->description }}</textarea>
    </div>

    <div class="form-outline mb-4">
        <input type="file" id="form6Example4" name="img" class="form-control" />
        <label class="form-label" for="form6Example4">Image</label>
    </div>

    @error('img')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-outline mb-4">
        <label class="form-label" for="form6Example4">Status</label>
        <div class="form-check">
            <input type="radio" name="status" value="active" {{ $categorie->status == 'active' ? 'checked' : '' }} />
            <label class="form-check-label">Active</label>
        </div>
        <div class="form-check">
            <input type="radio" name="status" value="archived" {{ $categorie->status == 'archived' ? 'checked' : '' }} />
            <label class="form-check-label">Archived</label>
        </div>
    </div>

    @error('status')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
@endsection
