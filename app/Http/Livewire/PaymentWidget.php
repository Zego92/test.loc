<?php

namespace App\Http\Livewire;

use App\Jobs\PaymentSuccessJob;
use App\Models\User;
use App\Services\OrderService;
use App\Services\PaymentServices;
use Illuminate\Http\Request;
use Livewire\Component;

class PaymentWidget extends Component
{

    public $order;

    public function __construct(OrderService $order,$id = null)
    {
        $this->order = $order;
        parent::__construct($id);
    }

    public function render()
    {
        return view('livewire.payment-widget');
    }

    public function save(Request $request)
    {
        $user = User::create($request->all());
        if ($user){
            $service = (new PaymentServices($user))->createPayment();
            if ($service){
                PaymentSuccessJob::dispatch($service);
                $this->order->createOrder($request, $user);
            }
            return redirect($service->url);
        }
        return redirect()->back();
    }
}
