@extends('auth.admin_master')
@section('title',' Orders')

@section('content')
    <div id="app">
        <div class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h1>Заказы</h1>
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Имя
                                </th>
                                <th>
                                    Телефон
                                </th>
                                <th>
                                    Когда отправлен
                                </th>
                                <th>
                                    Сумма
                                </th>
                                <th>
                                    Действия
                                </th>
                            </tr>
                            @foreach($orders as $order)

                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td>{{$order->getFulPrice()}} ₽</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-success" type="button"
                                               href="https://internet-shop.tmweb.ru/person/orders/2"
                                            >Открыть</a>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



