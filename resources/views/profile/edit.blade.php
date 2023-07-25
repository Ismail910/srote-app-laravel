
@extends('layouts.index')
@section('title', 'EDIT PROFILE')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">EDIT PROFILE</li>
@endsection

@section('content')   
<form action="{{route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('patch')

    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="first_name"> First Name   </x-form-lable>
            <x-form.input name="first_name"  :value="$user->profile->frist_name"/>
        </div>
        <div class="col-md-6">
            <x-form.lable id="last_name"> Lasst Name   </x-form-lable>
            <x-form.input name="last_name"  :value="$user->profile->last_name"/>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="birthday"> birthday    </x-form-lable>
            <x-form.input name="birthday" type="date" :value="$user->profile->birthday" />
        </div>
        <div class="col-md-6">
            <x-form.lable id="birthday"> Gender </x-form-lable>
            <x-form.radio name="gender" :option="['male', 'female']" :checked="$user->profile->gender" />
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6">
            <x-form.lable id="street_address"> Street Address  </x-form-lable>
            <x-form.input name="street_address" :value="$user->profile->street_addess"/>
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
                <label for="exampleInputPassword1"> Country </label>
                <select class="form-select" aria-label="Default select example" name="cauntry">
                <option value="">country</option>
                        @foreach($countries as  $country)
                        <option value="{{$user->profile->country}}">
                            {{ $country }}
                        </option>
                        @endforeach
                </select>
        </div>
        <div class="form-group mt-3">
                <label for="exampleInputPassword1"> Language </label>
                <select class="form-select" aria-label="Default select example" name="locale">
                <option value="">language</option>
                        @foreach($locales as $locale)
                        <option value="{{$user->profile->locale}}">
                            {{ $locale }}
                        </option>
                        @endforeach
                </select>
        </div>
       
    <button type="submit" class="btn btn-primary mt-3">Create</button>
</form>
@endsection


