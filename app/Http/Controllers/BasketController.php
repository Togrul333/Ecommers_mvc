<?php

namespace App\Http\Controllers;

use App\classes\Basket;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        if (Auth::check()) {
            $order = (new Basket())->getOrder();
            $orderId = session('orderId');
            $order = Order::where('user_id', Auth::id())->findOrFail($orderId);
            return view('basket', compact('order'));
        } else {
            return redirect()->route('index')->with('warning', 'Вы не авторизованы');

        }

    }

    public function basketPlace()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if (!$basket->countAvailable())
        {
            session()->flash('warning', 'Bunun stoku azdi uje !!');
            return redirect()->route('basket');
        }
        return view('order', compact('order'));
    }

    public function basketAdd(Product $product)
    {
        $result = (new Basket(true))->addProduct($product);
        if ($result) {
            session()->flash('success', $product->name . __('main.product_added'));
        } else {
            session()->flash('warning', 'Bu' . $product->name . '-in stoku azdi !!');
        }
        return redirect()->route('basket');
    }

    public function basketRemove(Product $product)
    {
        (new Basket())->removeProduct($product);
        return redirect()->route('basket');
    }

    public function basketConfirm(Request $request)
    {
        if ((new Basket())->saveOrder($request->name, $request->phone)) {
            session()->flash('success', 'Ваш заказ принят ');
        } else {
            session()->flash('warning', 'Случилась ошибка ');
        }
        return redirect()->route('index');
    }

}
