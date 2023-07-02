@props ([
        'name' ,'option', 'checked' => false
    ])

@foreach($option as $value => $text)

       
        <div class="form-chech">
            <input  type="radio" name="{{$name}}" value="{{$value}}"
            @checked(old($name, $checked) == $value)
            {{$attributes->class([
            'form-chech-input',
            'is-invalid' =>  $errors->has($name)
        ])}} class="form-chech-input" />

        <label class="form-label" for="form6Example4">{{$text}}</label>
      
        </div>

@endforeach