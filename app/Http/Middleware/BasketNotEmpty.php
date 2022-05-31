<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BasketNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            session()->flash('warning', 'Ваша корзина пуста !!');
            return redirect()->route('index');

        } else {
            return $next($request);
        }

    }
}
