<?php

namespace App\Http\Controllers;
use App\Events\PaymentProcessed;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function makePayment($amount)
    {
        // Payment processing logic...
        Log::channel('single')->info("Initiating payment of: " . $amount); 

        // Trigger the event
        event(new PaymentProcessed($amount));
        return $amount;
    }
}
