<?php

$attributes = $attributes->class([
    'form-control',
    'is-invalid' => $errors->has($name),
]);

$lable = $lable ?? false;

?>

@if ($lable)
    <label for="exampleInputEmail1">{{$lable}}</label>
@endif

<textarea
    name="{{$name}}"
    id="exampleInputEmail1"
    aria-describedby="emailHelp"
    placeholder="Enter {{$name}}"
    {{$attributes}}
>{{old($name, $value)}} </textarea>

@error($name)
    <div class="alert alert-danger">{{$message}}</div>
@enderror
