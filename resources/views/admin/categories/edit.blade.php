@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

    <h1>Update Category</h1>

    <form action="/admin/categories/{{ $category->id }}" method="post">
        @csrf
        @method('PUT')

        @include('admin.categories._form')
    </form>
@endsection