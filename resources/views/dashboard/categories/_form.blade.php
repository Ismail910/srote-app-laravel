
<div class="form-group mt-3">
        <label for="exampleInputEmail1">Category Name</label>
        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
    </div>

  <div class="form-group mt-3">
    <label for="exampleInputPassword1"> category Parent</label>
   
    <select class="form-select" aria-label="Default select example" name="parent_id">
    <option value="">parent</option>
    @foreach($categorie as $parantCategory)
     
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

  @error('image')
  <div class="alert alert-danger">{{$message}}</div>
  @enderror