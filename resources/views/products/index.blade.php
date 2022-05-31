@extends('auth.admin_master')
@section('title',' Products')

@section('content')
    <div class="col-md-12">
        <h1>Products</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Код
                </th>
                <th>
                    Название
                </th>
                <th>
                    Категория
                </th>
                <th>
                    Цена
                </th>
                <th>
                    Кол-во
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->code }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->count }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('admin.products.show', $product) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('admin.products.edit', $product) }}">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}
        <br>
        <br>
        <a class="btn btn-success" type="button"
           href="{{ route('admin.products.create') }}">Добавить категорию</a>
        <br>
        <br>
        <br>

    </div>
@endsection



