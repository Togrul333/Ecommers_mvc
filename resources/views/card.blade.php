<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">

            {{--//      product modelinde isNew() funkcianalllari yazmag lazimdi  --}}
            @if($product->isNew())
                <span class="badge badge-success">Новинка</span>
            @endif
            @if($product->isXit())
                <span class="badge badge-danger">Хит</span>
            @endif
            @if($product->isRecom())
                <span class="badge badge-warning">Рекомендуем</span>
            @endif

        </div>
        <img src="img/iPhoneX58superretina.jpg" alt="iPhone X 64GB">

        <div class="caption">
            <h3>id : {{ $product->id }}</h3>
            <h3>{{ $product->__('name') }}</h3>
            <p>{{ $product->price }} {{\App\Services\CurrencyConversion::getCurrencySymbol()}}</p>
            <p>


            <form action="{{route('basket-add',$product)}}" method="POST">
                @csrf
                @if($product->isAvailable() && \Illuminate\Support\Facades\Auth::check())
                <button type="submit" class="btn btn-primary" role="button">В корзину</button>
                @else
                    <button type="button" class="btn btn-danger" role="button">Нет доступа</button>
                @endif

                {{--                {{ $product->getCategory->name ?? '' }}--}}
                <a href="{{route('product',[isset($category) ? $category->code : $product->category->code, $product->code])}}"
                   class="btn btn-default"
                   role="button">Подробнее</a>

                {{--                <a href="http://internet-shop.tmweb.ru/mobiles/iphone_x_64"--}}
                {{--                   class="btn btn-default"--}}
                {{--                   role="button">Подробнее</a>--}}
                {{--                <input type="hidden" name="_token" value="YU9gNDwD1UeXeC80upIR0ADxm5OAFwiZ3Ll4GWMH">--}}
            </form>
            </p>
        </div>

    </div>
</div>
