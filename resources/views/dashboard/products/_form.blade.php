

<div class="form-group">
    <x-form.input type="text" label="Product Name" class="form-control-lg" role="input" name="name" :value="$product->name" />
</div>

@error('name')
<div class="alert alert-danger">{{$message}}</div>
@enderror




<div class="form-group">
    <label for="">Store</label>
    <select name="store_id" class="form-control form-select">
        <option value="">Primary Store</option>
        @foreach(App\Models\Store::all() as $store)
        <option value="{{ $store->id }}" {{ old('store_id', $product->store_id) == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>
        @endforeach
    </select>
</div>

@error('store_id')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<div class="form-group">
    <label for="">Category</label>
    <select name="category_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach(App\Models\Category::all() as $Category)
        <option value="{{ $Category->id }}" {{ old('Category_id', $product->Category_id) == $Category->id ? 'selected' : '' }}>{{ $Category->name }}</option>
        @endforeach
    </select>
</div>

@error('Category_id')
<div class="alert alert-danger">{{$message}}</div>
@enderror



<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$product->description"></x-form-textarea>

</div>

@error('description')
<div class="alert alert-danger">{{$message}}</div>
@enderror


<div class="form-group">
    <x-form.lable id="image">Image</x-form.lable>
    <x-form.input type="file" name="image" accept="image/*" />
    @if ($product->image)
    <img src="{{asset('storage/'. $product->image) }}" alt="" height="60" width="60" />
    @endif
</div>

@error('image')
<div class="alert alert-danger">{{$message}}</div>
@enderror


<div class="form-group">
    <x-form.input label="Price" name="price" :value="$product->price" />
</div>

@error('compare_price')
<div class="alert alert-danger">{{$message}}</div>
@enderror


<div class="form-group">
    <x-form.input label="Compare Price" name="compare_price" :value="$product->compare_price" />
</div>


@error('compare_price')
<div class="alert alert-danger">{{$message}}</div>
@enderror


<div class="form-group">
    <x-form.input label="Tags" id="" name="tags" :value="$tags" />

</div>


@error('tags')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<div class="form-group">
    <label for="">Status</label>
    <x-form.radio name="status" :checked=" $product->status " :option="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
</div>


@error('status')
<div class="alert alert-danger">{{$message}}</div>
@enderror



<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<script>
   var input = document.querySelector('input[name=tags]');
    new Tagify(input)
</script>
@endpush
