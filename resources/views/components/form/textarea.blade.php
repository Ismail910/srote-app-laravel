@props([
        
        'name',
        'value' => '',
        'lable' => false
    ])

    @if ($lable)
        <label for="exampleInputEmail1">{{$lable}}</label>
    @endif

    <textarea 
    name="{{$name}}"  
    id="exampleInputEmail1" 
    aria-describedby="emailHelp" 
    placeholder="Enter {{$name}}"  
    {{$attributes->class([
        'form-control',
        'is-invalid' =>  $errors->has($name)
    ])}}
    >{{old($name, $value)}} </textarea>
    
        @error($name)
             <div class="alert alert-danger">{{$message}}</div>
        @enderror