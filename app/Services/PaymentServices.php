<?php


namespace App\Services;

use App\Models\User;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class PaymentServices
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createPayment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = $this->user->createAsStripeCustomer();
        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $customer,
            'success_url' => "http://localhost:8000/payment-widget",
            'cancel_url' => 'https://example.com/cancel',
        ]);
        return $session;
    }

    public function retrieveSession($sessionId = null)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        return !is_null($sessionId) ? Session::retrieve($sessionId) : false;
    }
}
