## Laravel: интернет магазин

# ларавел без веб сервера может открыть проект

# ctrl + c закрывает порт

- http://internet-shop.tmweb.ru/

1) берем всю верстку исползуем html css

2) заполнел бд через сеедеры и фабрик

3) relation

php artisan migrate:rollback --step=1

// Метод contains определяет, содержит ли коллекция данный элемент. if ($order->products->contains($productId))

4) pivot table [order_product]


5) orders de palicies istifade edilib

php artisan make:controller CategoryController --resource --model=Category

# <li @if(\Illuminate\Support\Facades\Route::currentRouteNamed('admin.categories.index')) class="active" @endif><a href="{{route('admin.categories.index')}}">Категории</a>

controllerde yazib tetbiq etmek olur

# Artisan::call('migrate:fresh --seed');

php artisan make:migration alter_table_products --table=products

## esas meslelelerden biri filetr products

       $productQuery = Product::query();

// Если вы хотите определить, присутствует ли значение в запросе // и не является ли оно пустым, вы можете использовать
filled метод:
if ($request->filled('price_from')) { $productQuery->where('price', '>=', $request->price_from); } if ($request->
filled('price_to')) { $productQuery->where('price', '<=', $request->price_to); }

        foreach (['new', 'hit', 'recommend'] as $field) {
            if ($request->has($field)) {
                $productQuery->where($field, 1);
            }
        }
        //dd($request->post());

        // ->withPath($request->getQueryString() paginette ki linkler filteri pozmasin deye
        $products = $productQuery->orderBy('price', 'asc')->paginate(6)->withPath("?" . $request->getQueryString());

        return view('index', compact('products'));

-----------------------------------------------------------------------------------------------
ProductsFilterRequest public function rules()
{ return [
'price_from'=>'nullable|numeric|min:0',
'price_to'=>'nullable|numeric|min:0'
]; }

nullable teyin olunmasa request duzguniwlemir
redirectler olur numeric oldugnu iddia etdiyimiz wey tapilmadigi ucun 
-----------------------------------------------------------------------------------
card -da eyer categorimiz varsa yeniden relationla categorini almamagcun sorgu azltmagcun
isset($category) ? $category->code : $product->category->code [yazdig]

<a href="{{route('product',[isset($category) ? $category->code : $product->category->code, $product->code])}}"
class="btn btn-default"
role="button">Подробнее</a>
---------------------------------------------------------------------------------------------
        optimization sql zaprosov 
1) categorilerin vaxtinda verilmesi
2) categori varsa yeniden goturulmemesi
3) scoplarnan qisaldilmasi 


---------------------------------------------------------------------------------------------
ctrl+ g   дает вазможность искать по строке



UPDATE products SET count = 5 WHERE id BETWEEN 1 AND 30
----------------------------------------------------------------------------------------------

# composer require barryvdh/laravel-debugbar --dev


---------------------------------------------------------------------------------------------------
orderlerin listesinde silinmiw mal olsada olari withtrashed() edib gostermek lazimdi 
cunku o mehsul bazada olmasada vaxtinda sifaris verilib cattirilib sadece gosterilmelidi

---------------------------------------------------------------------------------------------------
mehsul stokta azalibsa sebetde onu artirammir
basscetControlleri cox neqruzka vermemekcun bir klasss yarattig onda basketin iwlerin gorduk class Basket
mehsulu aldigdan sonra stokuda azalmalidi 
-----------------------------------------------------
linkde istifade etdiyimiz stunlar unikal olmalidi meselcun burda
sef etmisdim productCode unikal olmadigi ucun product page acanda bawka malin seyfesi acilirdi
bu kola duzeltdim 

        $productQuery = Product::all();

        $i=0;
        foreach ($productQuery as $product) {
            $i++;
            $text = "ferqli". rand(3,666678).$i;
            $product->code = $text;
            $product->update();
        }

-----------------------------------------------------

php artisan make:mail OrderCreated
-------------------------------------------------
Создание миграций для перевода данных
- Создание трейта для выбора нужного значения
- Использование функции для выбора нужного значения поля

trait yaraddig kiii bazadan gelen attributlar secilmis dile uygun gelsin hem categoride hemde productda
-------------------------------------------------
composer require guzzlehttp/guzzle
-------------------------------------------------
php artisan db:seed --class=CurrencySeeder



-------------------------------------------------
 ->

                                             
                                     
                   PROPERTY             
            pivot
                   PRODUCT       SKU
                            pivot
                                PROPERTY_OPTIONS






https://www.youtube.com/watch?v=7SVKZRwqaW8&list=PL5RABzpdpqAlSRJS1KExmJsaPFQc161Dy&index=37





1 admin rahat filter 2 validation iwlemedi 3 yerler deisse ne olar?

4) azdan coxa get

#### установка ларавел modules Войдите в модульный мир

https://github.com/nWidart/laravel-modules
https://nwidart.com/laravel-modules/v6/introduction
https://nicolaswidart.com/blog/writing-modular-applications-with-laravel-modules

Чтобы установить через Composer, выполните следующую команду:

# composer require nwidart/laravel-modules

# php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

# composer dump-autoload

{
"autoload": {
"psr-4": {
"App\\": "app/",
"Modules\\": "Modules/",
"Database\\Factories\\": "database/factories/",
"Database\\Seeders\\": "database/seeders/"
}

}

Каждый модуль имеет свои маршруты/контроллеры/модели/представления/бизнес-логику и т.д. Это означает, что каждый модуль
содержит группу классов, которые каким-то образом связаны друг с другом.





































<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and
creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in
many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache)
  storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all
modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video
tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging
into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in
becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in
the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by
the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell
via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
