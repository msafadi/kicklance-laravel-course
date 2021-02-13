
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
    <label for="name">Category Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" id="name" name="name">
    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="parent_id">Parent</label>
    <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
        <option value="">No Parent</option>
        @foreach ($categories as $parent)
        <option value="{{ $parent->id }}" @if( $parent->id == old('parent_id', $category->parent_id) ) selected @endif>{{ $parent->name }}</option>
        @endforeach
    </select>
    @error('parent_id')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="desctiption">Description</label>
    <textarea class="form-control @error('desctiption') is-invalid @enderror" id="desctiption" name="desctiption">{{ old('desctiption', $category->description) }}</textarea>
    @error('desctiption')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Save</button>