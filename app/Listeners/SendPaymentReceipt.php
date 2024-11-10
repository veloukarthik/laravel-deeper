<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class SendPaymentReceipt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function handle(PaymentProcessed $event)
    {
        // Logic to send a receipt for the payment
        Log::info("Receipt sent for payment of $" . $event->amount);
    }
}
