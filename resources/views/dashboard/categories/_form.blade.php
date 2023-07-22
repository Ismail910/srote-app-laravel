
<div class="form-group mt-3">
    <x-form.lable id="name"> category name  </x-form-lable>
       <x-form.input name="name" :value="$categorie->name"  class="any"/>
  </div>
 
  <div class="form-group mt-3">
    <label for="exampleInputPassword1"> category Parent</label>
   
    
     <select class="form-select" aria-label="Default select example" name="parent_id">
       <option value="">parent</option>
            @foreach($parents as $parantCategory)

           
            <option value="{{ $parantCategory->id }}" {{ $categorie->parent_id == $parantCategory->id ? 'selected' : '' }}>
                {{ $parantCategory->name }}
            </option>
            @endforeach
        </select>
  </div>
  @error('parent_id')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror
  
  <div class="form-group mt-3">
    <x-form.lable id="description"> Description  </x-form-lable>
    <x-form.textarea   :value="$categorie->description" name="description" />
  </div>
 
  <!-- <div class="form-group mt-3">
    <label for="exampleInputPassword1">Description</label>
    <input type="text" class="form-control  @error('description') is-invalid @enderror" value="{{old('description', $categorie->description)}}" name="description" id="exampleInputPassword1" placeholder="Description">
  </div>
  @error('description')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror -->
  

  
  <div class="form-outline mb-4">
        <x-form.lable id="img"> Image  </x-form-lable>
        <x-form.input  type="file" name="img" />
      
    </div>
    @if($categorie->img)
    <img width="100"  src="{{asset('storage/'.$categorie->img)}} "/>
    @endif
<!--   
  <div class="form-outline mb-4">
        <input type="file" id="form6Example4" name="img" class="form-control" accept= "image/*"/>
        <label class="form-label" for="form6Example4">Image</label>
    </div>
    @if($categorie->img)
    <img width="100"  src="{{asset('storage/'.$categorie->img)}} "/>
   
    @endif

    @error('img')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror -->

    <div class="form-outline mb-4">
       
        <x-form.lable  id="status"> Status  </x-form-lable>
       <x-form.radio  name="status" :checked="$categorie->status" :option="['active' => 'Active', 'archived'=>'Archived']" />
    </div>

  @error('status')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror

  <!-- <div class="form-outline mb-4">
        <label class="form-label" for="form6Example4">Status</label>
        <div class="form-check">
            <input type="radio" name="status" value="active" {{ $categorie->status == 'active' ? 'checked' : '' }} />
            <label class="form-check-label">Active</label>
        </div>
        <div class="form-check">
            <input type="radio" name="status" value="archived" {{ $categorie->status == 'archived' ? 'checked' : '' }} />
            <label class="form-check-label">Archived</label>
        </div>
    </div>

  @error('status')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror -->

  