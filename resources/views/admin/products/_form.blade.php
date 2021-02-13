
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="form-group">
    <label for="name">Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" id="name" name="name">
    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="category_id">Category</label>
    <select class="form-control @error('parent_id') is-invalid @enderror" id="category_id" name="category_id">
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" @if( $category->id == old('category_id', $product->category_id) ) selected @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    @error('category_id')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="desctiption">Description</label>
    <textarea class="form-control @error('desctiption') is-invalid @enderror" id="desctiption" name="desctiption">{{ old('desctiption', $product->description) }}</textarea>
    @error('desctiption')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" id="price" name="price">
    @error('price')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="sale_price">Sale Price</label>
    <input type="number" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price) }}" id="sale_price" name="sale_price">
    @error('sale_price')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', $product->quantity) }}" id="quantity" name="quantity">
    @error('quantity')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="image">Image</label>
    <img src="{{ $product->image_url }}" height="60" alt="" class="d-block">
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
    @error('image')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
{{--
<div class="form-group">
    <label for="">Tags</label>
    @foreach($tags as $tag)
    <div class="form-check">
        <input type="checkbox" class="form-check-input" name="tag[]" value="{{ $tag->id }}" @if(in_array($tag->id, $product_tags)) checked @endif>
        <label class="form-check-label">{{ $tag->name }}</label>
    </div>
    @endforeach
</div>
--}}
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" class="form-control @error('tags') is-invalid @enderror" value="{{ old('tags', $product_tags) }}" id="tags" name="tags">
    @error('tags')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Save</button>