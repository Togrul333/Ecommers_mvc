@extends('master')
@section('title','basket ')
@section('content')
    {{--        <p class="alert alert-success">Добавлен товар iPhone X 64GB</p>--}}
    <h1>Корзина</h1>
        @if(!$order->products->isEmpty())
            <p>Оформление заказа</p>
            <div class="panel">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Стоимость</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td>
                                <a href="{{route('product',[$product->category->code,$product->code])}}">
                                    <img height="56px"
                                         src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
                                    {{$product->name}}
                                </a>
                            </td>
                            <td><span class="badge">{{$product->pivot->count}}</span>
                                <div class="btn-group form-inline">
                                    <form action="{{route('basket-remove',$product)}}" method="POST">
                                        <button type="submit" class="btn btn-danger" href=""><span
                                                class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                                        <input type="hidden" name="_token"
                                               value="jOJ8M8SfdPJ6OcMe7zqQUTY3vVYRndz7OAaRN5LX">
                                        @csrf
                                    </form>
                                    <form action="{{route('basket-add',$product)}}" method="POST">
                                        <button type="submit" class="btn btn-success"
                                                href=""><span
                                                class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                                        <input type="hidden" name="_token"
                                               value="jOJ8M8SfdPJ6OcMe7zqQUTY3vVYRndz7OAaRN5LX">
                                        @csrf
                                    </form>
                                </div>
                            </td>
                            <td>{{$product->price}} {{\App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
                            <td>{{$product->getPriceForCount()}} {{\App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Общая стоимость:</td>
                        <td>{{$order->getFulPrice()}} {{\App\Services\CurrencyConversion::getCurrencySymbol()}}</td>
                    </tr>
                    </tbody>
                </table>
                <br>
                <div class="btn-group pull-right" role="group">
                    <a type="button" class="btn btn-success" href="{{route('basket-place')}}">Оформить
                        заказ</a>
                </div>
            </div>
        @else
            <p class="alert alert-danger">Корзина пуста</p>
        @endif
@endsection


