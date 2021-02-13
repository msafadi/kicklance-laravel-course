@extends('layouts.admin')

@section('title', 'Categories')

@section('nav')
@parent
<a href="#" class="nav-link">Users</a>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1 class="mb-5">Categories</h1>
    @can('categories.create')
    <div>
        <a href="/admin/categories/create" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
    @endcan
</div>

<x-alerts/>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Products #</th>
            <th>Created At</th>
            <th>Update At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->id }}</td>
                <td class="text-success">{{ $category->name }}</td>
                <td>{{ $category->parent->name }}</td>
                <td>{{ $category->products_count }}</td>
                <td>{{ $category->created_at->format('l, F d, Y h:i:s A') }}</td>
                <td>{{ $category->updated_at->diffForHumans() }}</td>
                <td>
                    @can('categories.update')
                    <a class="btn btn-sm btn-dark" href="/admin/categories/{{ $category->id }}/edit">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('categories.delete')
                    <form action="/admin/categories/{{ $category->id }}" class="form-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection