<?php

namespace App\Listeners;

use App\Events\MadePayment;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class UpdateOrder implements ShouldQueue
{

    /**
     * Create the event listener.
     */

    public int $delay = 5;


    /**
     * Handle the event.
     */
    public function handle(MadePayment $event): void
    {
        $order = Order::where('transaction_id',$event->payment->transaction_id)->where('status','pending')->first();
        $order->amount_paid += $event->payment->amount;
        $order->save();
    }
}
