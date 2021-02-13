@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

<h1>Create Category</h1>

<form action="/admin/categories" method="post">
    @csrf
    @include('admin.categories._form')
</form>

@endsection
