<?php


namespace App\ViewComposers;


use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;

class BestProductsComposer
{
    public function compose(View $view)
    {
        // burda butun orderlerin icinde en cox satilan productlarin ucdenesini goturub tapir

//        $bestProductIds = Order::get()->map->products->flatten()->map->pivot->mapToGroups(function ($pivot) {
//            return [$pivot->product_id => $pivot->count];
//        })->map->sum()->sortByDesc(null)->take(3)->keys()->toArray();
//
//        $bestProducts = Product::whereIn('id',$bestProductIds)->get();



         $bestProducts = Product::limit(3)->get();

        $view->with('bestProducts', $bestProducts);

    }
}
