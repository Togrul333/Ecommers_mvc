@extends('master')
@section('title',' Авторизация')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="margin-top: 10px;margin-bottom: 10px">Авторизация</div>

                <div class="card-body">
                    <form method="POST" action="{{route('loginPost')}}" aria-label="Login">
                        @csrf
                        {{--                                <input type="hidden" name="_token" value="0gewdHNf3Cr6CggNCcPdWmrQGWoeMrCi92qJK2oC">--}}
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control"
                                       name="email" value="" required autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control"
                                       name="password" required>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <label for="remember">
                                    <input type="checkbox" name="remember" id="remember"> Запомнить меня
                                </label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Войти
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
