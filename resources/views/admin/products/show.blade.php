@extends('layouts.admin')

@section('title', $product->name)

@section('content')

    <h1>{{ $product->name }}</h1>

    <h3>Tags</h3>
    <ul>
        @foreach($product->tags as $tag)
        <li>{{ $tag->name }}</li>
        @endforeach
    </ul>
@endsection