@extends('layouts.index')
@section('Title', 'CREATE CATEGORIES')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">CREATE CATEGORIES</li>
@endsection

@section('content')
<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('post')

  <div class="form-group mt-3">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control" name="name" 
    value="{{old('name')}}"
    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
  </div>
  @error('name')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror

<!--  
  <div class="form-group mt-3">
    <label for="slug">slug</label>
    <input type="text" class="form-control" value="{{old('slug')}}" name="slug" id="slug" placeholder="slug">
  </div>
  @error('slug')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror -->

<!-- 
  <div class="form-group mt-3">
    <label for="exampleInputPassword1">creator</label>
    <input type="text" class="form-control" value="{{old('created_by')}}" name="created_by" id="exampleInputPassword1" placeholder="creator name">
  </div>
  @error('created_by')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror -->
  

  <div class="form-group mt-3">
    <label for="exampleInputPassword1"> category Parent</label>
   
    <select class="form-select" aria-label="Default select example" name="user_id">
    @foreach($parants as $parantCategory)
      <option value="{{$parantCategory->id}}">{{$parantCategory->name}}</option>
      @endforeach
    </select>
   
  </div>
  <div class="form-group mt-3">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control" value="{{old('description')}}" name="description" id="exampleInputPassword1" placeholder="Description">
  </div>
  @error('description')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
  
  
  <div class="form-outline mb-4">
    <input type="file" id="form6Example4" value="{{old('img')}}" name="img" class="form-control" />
    <label class="form-label" for="form6Example4">image</label>
  </div>

  @error('image')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror

  
  <div class="form-outline mb-4">
    <label class="form-label" for="form6Example4">Status</label>
    <div class="form-check">
        <input type="radio" name="status" value="active" chacked />
        <label class="form-check-label">Active</label>
    </div>
    <div class="form-check">
        <input type="radio" name="status" value="archived"  />
        <label class="form-check-label">archived</label>
    </div>
  </div>

  @error('image')0
  <div class="alert alert-danger">{{$message}}</div>
  @enderror

  <button type="submit" class="btn btn-primary mt-3" >Create</button>
</form>

@endsection


/*<!--
<div class="well">

    {!! Form::open(['url' => '/processform', 'class' => 'form-horizontal']) !!}

    <fieldset>

        <legend>Legend</legend>

        <div class="form-group">
            {!! Form::label('email', 'Email:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
            </div>
        </div>

       
        <div class="form-group">
            {!! Form::label('password', 'Password:', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password']) !!}
                <div class="checkbox">
                    {!! Form::label('checkbox', 'Checkbox') !!}
                    {!! Form::checkbox('checkbox') !!}
                </div>
            </div>
        </div>

       
        <div class="form-group">
            {!! Form::label('textarea', 'Textarea', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::textarea('textarea', $value = null, ['class' => 'form-control', 'rows' => 3]) !!}
                <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
            </div>
        </div>

       
        <div class="form-group">
            {!! Form::label('radios', 'Radios', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                <div class="radio">
                    {!! Form::label('radio1', 'This is option 1.') !!}
                    {!! Form::radio('radio', 'option1', true, ['id' => 'radio1']) !!}

                </div>
                <div class="radio">
                    {!! Form::label('radio2', 'This is option 2.') !!}
                    {!! Form::radio('radio', 'option2', false, ['id' => 'radio2']) !!}
                </div>
            </div>
        </div>

       
        <div class="form-group">
            {!! Form::label('select', 'Select w/Default', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('select', ['S' => 'Small', 'L' => 'Large', 'XL' => 'Extra Large', '2XL' => '2X Large'],  'S', ['class' => 'form-control' ]) !!}
            </div>
        </div>

   
        <div class="form-group">
            {!! Form::label('multipleselect[]', 'Multi Select', ['class' => 'col-lg-2 control-label'] )  !!}
            <div class="col-lg-10">
                {!!  Form::select('multipleselect[]', ['honda' => 'Honda', 'toyota' => 'Toyota', 'subaru' => 'Subaru', 'ford' => 'Ford', 'nissan' => 'Nissan'], $selected = null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            </div>
        </div>

        
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                {!! Form::submit('Submit', ['class' => 'btn btn-lg btn-info pull-right'] ) !!}
            </div>
        </div>

    </fieldset>

    {!! Form::close()  !!}

 </div>*/ -->