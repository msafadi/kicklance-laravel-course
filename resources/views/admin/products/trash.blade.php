@extends('layouts.admin')

@section('title', 'Deleted Products')


@section('content')
<div class="d-flex justify-content-between">
    <h1 class="mb-5">Deleted Products</h1>
    @can('create', App\Models\Product::class)
    <div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
    </div>
    @endcan
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
            <th>Deleted At</th>
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
                <td>{{ $product->deleted_at }}</td>
                <td>
                    @can('restore', $product)
                    <form action="{{ route('admin.products.restore', $product->id) }}" class="form-inline" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-info">Restore</button>
                    </form>
                    @endcan
                </td>
                <td>
                    @can('force-delete', $product)
                    <form action="{{ route('admin.products.forceDelete', $product->id) }}" class="form-inline" method="post">
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