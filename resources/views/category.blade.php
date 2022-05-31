@extends('master')
@section('title','Категория '.$category->name)
@section('content')
        <h1>
            {{ $category->name }}   {{ $category->products->count() }}
        </h1>
        <p>
            {{ $category->description }}
        </p>
        <div class="row">
{{--            @include('card',['category'=>$category])--}}
            @foreach($category->products as $product)
                @include('card', compact('product'))
            @endforeach
        </div>
@endsection