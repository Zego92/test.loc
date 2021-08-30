<?php


namespace App\Services;


use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderService
{

    public function createOrder(Request $request, User $user)
    {
        $data['user_id'] = $user->id;
        $data['price'] = $request->input('price');
        $data['paid'] = true;
        return Order::create($data);
    }
}
