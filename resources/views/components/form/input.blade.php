    @props([
        'type' => 'text',
        'name',
        'value' => '',
        'lable' => false
    ])
    @if ($lable)
        <label for="exampleInputEmail1">{{$lable}}</label>
    @endif
        <input 
        type="{{$type}}" 
        name="{{$name}}"  
        id="exampleInputEmail1" 
        value="{{old($name, $value)}}"
        aria-describedby="emailHelp" 
        placeholder="Enter {{$name}}"  
        {{$attributes->class([
            'form-control',
            'is-invalid' =>  $errors->has($name)
        ])}}>
    
        @error($name)
    <div class="alert alert-danger">{{$message}}</div>
    @enderror