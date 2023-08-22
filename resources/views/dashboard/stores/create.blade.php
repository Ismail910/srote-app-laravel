@extends('layouts.index')
@section('title', 'create prodeuctS')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">create</li>
@endsection

@section('content')
<form action="{{route('stores.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')

    @include('dashboard.stores._form')

</form>
@endsection