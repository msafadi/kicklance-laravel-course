@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')

<h1>Create Role</h1>

<form action="/admin/roles" method="post">
    @csrf
    @include('admin.roles._form')
</form>

@endsection
