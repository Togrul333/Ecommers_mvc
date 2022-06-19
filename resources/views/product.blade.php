@extends('master')
@section('title','Товар')
@section('content')
    <h1>{{$product->name}}</h1>
    <h2>{{ $product->category->name }}</h2>
    <p>Цена: <b>{{$product->price}} {{\App\Services\CurrencyConversion::getCurrencySymbol()}}</b></p>
    <img src="{{asset('img/iPhoneX58superretina.jpg')}}" alt="iPhone X 64GB">
    <p>{{$product->__('description')}}</p>
    @if($product->isAvailable())
        <form action="{{route('basket-add',$product->id)}}" method="POST">
            <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>
            @csrf
        </form>
    @else
        <button type="button" class="btn btn-danger" role="button">Нет доступа</button>
        <span> Mehsul movcul oldugu teqdirde size bildiris ede bilerik</span>
        <br>
        <span> Bununcun sadece olarag email unvaninizi qeyd edib ok duymesini basin</span>
        <br>
        <br>

        <form action="{{route('subscription',$product)}}" method="POST">
            <input type="text" name="email">
            <button type="submit" class="btn btn-success" role="button">ok</button>
            @csrf
        </form>
        <br>
        <br>
        <br>
    @endif
@endsection
