@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@if (isset($message))
<div class="alert alert-info">
    {{ $slot }} {{ $message }}
</div>
@endif