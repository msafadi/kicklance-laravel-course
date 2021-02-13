
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
    <label for="name">Role Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $role->name) }}" id="name" name="name">
    @error('name')
    <p class="invalid-feedback">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <h3>Permissions</h3>
    @foreach(config('permissions') as $code => $label)
    <div class="form-check">
    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $code }}" @if(in_array($code, $role_permissions)) checked @endif>
    <label class="form-check-label">
        {{ $label }}
    </label>
    </div>
    @endforeach
</div>
<button type="submit" class="btn btn-primary">Save</button>