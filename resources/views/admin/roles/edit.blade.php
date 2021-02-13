@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')

    <h1>Update Role</h1>

    <form action="/admin/roles/{{ $role->id }}" method="post">
        @csrf
        @method('PUT')

        @include('admin.roles._form')
    </form>
@endsection