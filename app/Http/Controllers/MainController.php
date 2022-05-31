<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\Subscription;
use App\Services\CurrencyRates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class MainController extends Controller
{
//    public function __construct()
//    {
//        view()->share('categories',Category::get());
//    }

    public function index(ProductsFilterRequest $request)
    {

//        CurrencyRates::getRates();
//        dd(md5('234543'));

//        Log::channel('daily')->info($request->ip());
//        Log::info($request->ip());
//        dd(get_class_methods($request));
//        dd($request->ip());

//        $productQuery = Product::query(); bele yazsag card da categorileride cekdii ucun n+1 problemi yaranir

        $productQuery = Product::with('category');


//        Если вы хотите определить, присутствует ли значение в запросе
// и не является ли оно пустым, вы можете использовать filled метод:
        if ($request->filled('price_from')) {
            $productQuery->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $productQuery->where('price', '<=', $request->price_to);
        }

        foreach (['new', 'hit', 'recommend'] as $field) {
            if ($request->has($field)) {
//                $productQuery->where($field, 1);
                $productQuery->$field();
            }
        }
        //dd($request->post());

        // ->withPath($request->getQueryString() paginette ki linkler filteri pozmasin deye


        $products = $productQuery->orderBy('price', 'asc')->paginate(6)->withPath("?" . $request->getQueryString());

        return view('index', compact('products'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();
//        $products=Product::where('category_id',$category->id)->get();
        return view('category', compact('category'));
    }

    public function product($category, $productCode)
    {
        $product = Product::byCode($productCode)->firstOrFail();
        return view('product', ['product' => $product]);
    }

    public function subscription(Request $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);
        return redirect()->back()->with('success', 'Мы свяжемся с вами');
    }

    public function changeLocale($locale)
    {
        // eyer olmuyan bir dil secilse qariwiglig olmasin deye
        $availableLocation = ['ru', 'en'];
        if (!in_array($locale, $availableLocation)) {
            $locale = config('app.locale');
        }

        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
//        $currentLocale = App::getLocale();
//        dd($currentLocale);
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }
}
