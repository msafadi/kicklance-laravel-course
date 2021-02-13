@extends('layouts.admin')

@section('title', 'Create Product')

@section('content')

<h1>Create Product</h1>

<form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form')
</form>

@endsection
