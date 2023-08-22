@extends('layouts.index')
@section('title', 'Update prodeuctS')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">UPDATE</li>
@endsection

@section('content')
<form action="{{route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')

    @include('dashboard.products._form')

    </form>
@endsection





