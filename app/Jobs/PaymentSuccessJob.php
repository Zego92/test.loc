<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PaymentSuccessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function handle()
    {
        Redis::throttle('payment_success')->allow('2')->every('2')->then(function () {
            Log::channel('payment_info')->info($this->service);
        }, function () {
            $this->release(2);
        });
    }
}
