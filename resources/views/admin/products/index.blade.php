@extends('layouts.admin')

@section('title', 'Products')

@section('nav')
@parent
<a href="#" class="nav-link">Users</a>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1 class="mb-5">Products</h1>
    @can('create', App\Models\Product::class)
    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
    @endcan
</div>

<x-alerts message="My custom message">
    <h2>Info</h2>
</x-alerts>

<div class="bg-light p-1 mb-3">
    <form action="{{ route('admin.products.index') }}" method="get" class="form-inline">
        <input type="text" name="name" class="form-control m-1" placeholder="Product Name.." value="{{ $filters['name'] ?? '' }}">
        <input type="number" name="price_min" class="form-control m-1" placeholder="Price From.." value="{{ $filters['price_min'] ?? '' }}">
        <input type="number" name="price_max" class="form-control m-1" placeholder="Price To.." value="{{ $filters['price_max'] ?? '' }}">
        <select name="category_id" class="form-control m-1">
            <option value="">All Categories</option>
            @foreach(App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @if($category->id == ($filters['category_id'] ?? '')) selected @endif>{{ $category->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary m-1">Find</button>
    </form>
</div>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>User</th>
            <th>Created At</th>
            <th>Update At</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @forelse($products as $product)
            <tr>
                <td><img src="{{ $product->image_url }}" height="60" alt=""></td>
                <td>{{ $product->id }}</td>
                <td class="text-success"><a href="{{ route('admin.products.show', $product->id) }}">{{ $product->name }}</a></td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->user->name }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->updated_at }}</td>
                <td>{{ $product->status }}</td>
                <td>
                    @can('update', $product)
                    <a class="btn btn-sm btn-dark" href="{{ route('admin.products.edit', [$product->id]) }}">Edit</a>
                    @endcan
                </td>
                <td>
                    @can('delete', $product)
                    <form action="{{ route('admin.products.destroy', $product->id) }}" class="form-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No Products</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection