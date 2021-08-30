<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class PaymentTableWidget extends Component
{
    public function render()
    {
        $users = User::with('orders')->paginate();
        return view('livewire.payment-table-widget', [
            'users' => $users
        ]);
    }

}
