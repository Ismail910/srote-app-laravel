@props ([
        'name' ,'option', 'checked' => false
    ])



       
        <select name="{{$name}}"
        
        
        
        value="{{$value}}"
            @checked(old($name, $checked) == $value)
            {{$attributes->class([
            'form-control',
            'form-select',
            'is-invalid' =>  $errors->has($name)
        ])}}
        @foreach($options as $text)
        <option value="{{$value}}" @selected($value == $selected)>{{$text}}</option>
       @endforeach
        </select>
