@extends('layouts.index')
@section('title', 'STORE APP')

@section('breadcrumb')
    @parent
    <li href="" class="breadcrumb-item active">create</li>
@endsection

@section('content')
<form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')
    
    @include('dashboard.categories._form')
 

  <button type="submit" class="btn btn-primary mt-3" >Create</button>
</form>

@endsection
