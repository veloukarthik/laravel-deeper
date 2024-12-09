<?php

namespace App\Http\Controllers;
use App\Events\PaymentProcessed;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendPaymentReceipt;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function makePayment($amount)
    {
        // Payment processing logic...
        Log::channel('single')->info("Initiating payment of: " . $amount); 

        // Dispatch the job
        dispatch(new SendPaymentReceipt($amount));
        // Trigger the event
        event(new PaymentProcessed($amount));
        return $amount;
    }
}
