<div class="form-group">
    <x-form.input type="text" label="Store Name" class="form-control-lg" role="input" name="name" :value="$store->name" />
</div>

@error('name')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<div class="form-group">
    <label for="">Description</label>
    <x-form.textarea name="description" :value="$store->description"></x-form-textarea>

</div>

@error('description')
<div class="alert alert-danger">{{$message}}</div>
@enderror


<div class="form-group">
    <x-form.lable id="logo_image">logo image</x-form.lable>
    <x-form.input type="file" name="logo_image" accept="logo_image/*" />
    @if ($store->logo_image)
    <img src="{{asset('storage/'. $store->logo_image) }}" alt="" height="60" width="60" />
    @endif
</div>

@error('logo_image')
<div class="alert alert-danger">{{$message}}</div>
@enderror

<div class="form-group">
    <x-form.lable id="cover_image">cover image</x-form.lable>
    <x-form.input type="file" name="cover_image" accept="cover_image/*" />
    @if ($store->cover_image)
    <img src="{{asset('storage/'. $store->cover_image) }}" alt="" height="60" width="60" />
    @endif
</div>

@error('cover_image')
<div class="alert alert-danger">{{$message}}</div>
@enderror




<div class="form-group">
    <label for="">Status</label>
    <x-form.radio name="status" :checked=" $store->status " :option="['active' => 'Active','archived' => 'Archived']" />
</div>


@error('status')
<div class="alert alert-danger">{{$message}}</div>
@enderror



<div class="form-group">
    <button type="submit" class="btn btn-primary">{{$button_label ?? 'Save'}}</button>
</div>