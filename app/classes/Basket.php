<?php


namespace App\classes;


use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    /**
     * Basket constructor.
     */
    public function __construct($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            } else {
                return redirect()->route('index')->with('warning', 'Вы не авторизованы');
            }
            $this->order = Order::create($data);
            session(['orderId' => $this->order->id]);
        } else {
            $this->order = Order::findOrFail($orderId);
        }
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function saveOrder($name, $phone)
    {
        // burda (hem yoxluyur hemde stoku azaldir) yoxluyur eyer mehsulun sayinda
        // problem yoxdusa o zaman gotur mehsulun sayini stokdanda cix kii satildigi bilinsin
        $bool = $this->countAvailable(true);

        // eyer sayinda problem varsa
        if (!$bool)
        {
            return false;
        }

        Mail::to(Auth::user()->email)->send(new OrderCreated($name));
        return $this->order->saveOrder($name, $phone);
    }

    public function countAvailable($updateCount = false)
    {
        foreach ($this->order->products as $orderProduct)
        {
            if ($orderProduct->count < $this->getPivotRow($orderProduct)->count)
            {
                return false;
            }
            if ($updateCount)
            {
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }
        if ($updateCount)
        {
            $this->order->products->map->save();

        }
        return true;
    }

    protected function getPivotRow($product)
    {
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function removeProduct(Product $product)
    {
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id);
                session()->flash('warning', ' Товар удален !!');
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }

    public function addProduct(Product $product)
    {
        // Метод contains определяет, содержит ли коллекция данный элемент.
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            $pivotRow->count++;
            if ($pivotRow->count > $product->count)
            {
                return false;
            }
            $pivotRow->update();
        } else {
            if ($product->count == 0)
            {
                return  false;
            }
            $this->order->products()->attach($product->id);
        }
        return true;
    }
}
