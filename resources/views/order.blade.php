@extends('master')
@section('title','Оформить заказ')
@section('content')
        <h1>Подтвердите заказ:</h1>
        <div class="container">
            <div class="row justify-content-center">
                <p>Общая стоимость: <b>{{$order->getFulPrice()}} ₽</b></p>
                <form action="{{route('basket-confirm')}}" method="POST">
                    <div>
                        <p>Укажите свое имя и номер телефона, чтобы наш менеджер мог с вами связаться:</p>

                        <div class="container">
                            <div class="form-group">
                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Имя: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="name" id="name" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="form-group">
                                <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Номер телефона: </label>
                                <div class="col-lg-4">
                                    <input type="text" name="phone" id="phone" value="" class="form-control">
                                </div>
                            </div>
                            <br>
                            <br>
{{--                            <div class="form-group">--}}
{{--                                <label for="name" class="control-label col-lg-offset-3 col-lg-2">Email: </label>--}}
{{--                                <div class="col-lg-4">--}}
{{--                                    <input type="text" name="email" id="email" value="" class="form-control">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <br>
                        <input type="hidden" name="_token" value="jOJ8M8SfdPJ6OcMe7zqQUTY3vVYRndz7OAaRN5LX">
                        @csrf
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <input type="submit" class="btn btn-success" value="Подтвердите заказ">
                        @else
                            <input type="button" class="btn btn-danger" value="Что бы подтвердить заказ сначала зарегистрируйтесь">
                        @endif
                    </div>
                </form>
            </div>
        </div>
@endsection

