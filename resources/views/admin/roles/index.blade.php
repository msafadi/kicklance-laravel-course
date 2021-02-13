@extends('layouts.admin')

@section('title', 'Roles')

@section('nav')
@parent
<a href="#" class="nav-link">Users</a>
@endsection

@section('content')
<div class="d-flex justify-content-between">
    <h1 class="mb-5">Roles</h1>
    @can('roles.create')
    <div>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-primary btn-sm mb-3">Create New</a>
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
            <th>Created At</th>
            <th>Update At</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $role->id }}</td>
                <td class="text-success">{{ $role->name }}</td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td>
                    <a class="btn btn-sm btn-dark" href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                </td>
                <td>
                    <form action="{{ route('admin.roles.destroy', $role->id) }}" class="form-inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection