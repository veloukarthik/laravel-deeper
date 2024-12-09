<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPaymentReceipt implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $amount;

    public function __construct($amount)
    {
        $this->amount = $amount;
    }

    public function handle()
    {
        // Logic to send a payment receipt
        \Log::info("Queued: Sending receipt for payment of $" . $this->amount);
    }
}
