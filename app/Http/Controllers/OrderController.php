<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $response = Gate::inspect('is-not-fexri', [self::class]);

        if ($response->denied()) {
              abort($response->code(),$response->message());
        }
        if ($response->allowed()) {

            session()->flash('success', 'sen super admin deilsen ama en azinan fexride deilsen !!');
        }

        $orders = Order::active()->get();

        return view('orders.index', compact('orders'));
    }
}
