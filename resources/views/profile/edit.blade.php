
@extends('layouts.index')
@section('title', 'EDIT PROFILE')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">EDIT PROFILE</li>
@endsection


@section('content')   

@if(session()->has('success'))
<x-alert type="success"/>
@endif
@if(session()->has('error'))
<x-alert type="error"/>
@endif

<form action="{{route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="first_name"> First Name   </x-form-lable>
            <x-form.input name="first_name"  :value="$user->profile->first_name"/>
            
        </div>
        <div class="col-md-6">
            <x-form.lable id="last_name"> Lasst Name   </x-form-lable>
            <x-form.input name="last_name"  :value="$user->profile->last_name"/>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
           
            <x-form.input name="birthday" type="date" :value="$user->profile->birthday" label="Birthday" />
        </div>
        <div class="col-md-6">
            <x-form.lable id="gender"> Gender </x-form-lable>
           
            <x-form.radio name="gender" :checked="$user->profile->gender" :option="['male' => 'Male', 'female' => 'Female']" />


        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="street_address"> Street Address  </x-form-lable>
            <x-form.input name="street_address" :value="$user->profile->street_address"/>
        </div>
        <div class="col-md-6">
            <x-form.lable id="city"> City   </x-form-lable>
            <x-form.input name="city" label="City " :value="$user->profile->city"/>
        </div>
        <div class="col-md-6">
            <x-form.lable id="state"> State </x-form-lable>
            <x-form.input name="state" label="State" :value="$user->profile->state"/>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="postl_code"> Postal code   </x-form-lable>
            <x-form.input name="postl_code" :value="$user->profile->postl_code"/>
        </div>
        <div class="form-group mt-3">
        <div class="form-group">
    <label for="exampleInputPassword1">Country</label>
    <select class="form-select" aria-label="Default select example" name="country">
        <option value="">Select a country</option>
        @foreach($countries as $country)
        <option value="{{ $country }}" {{ $user->profile->country === substr($country, 0, 2) ? 'selected' : '' }}>
            {{ $country }}
        </option>
        @endforeach
    </select>
</div>
@error('country')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror

<div class="form-group mt-3">
    <label for="exampleInputPassword1">Language</label>
    <select class="form-select" aria-label="Default select example" name="locale">
        <option value="">Select a language</option>
        @foreach($locales as $locale)
        <option value="{{ $locale }}" {{ $user->profile->locale === substr($locale, 0, 2) ? 'selected' : '' }}>
            {{ $locale }}
        </option>
        @endforeach
    </select>
</div>
@error('locale')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
       
    <button type="submit" class="btn btn-primary mt-3">Create</button>
</form>
@endsection


