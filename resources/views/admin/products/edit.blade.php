@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

    <h1>Update Product</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.products._form')
    </form>
@endsection