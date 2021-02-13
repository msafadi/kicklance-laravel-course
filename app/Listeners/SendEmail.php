<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\NewOrderMessage;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        // Send Email
        $order = $event->order;
        $users = User::where('type', 'super-admin')->get();
        if (!$users) {
            return;
        }
        Mail::to($users)->send(new NewOrderMessage($order));
    }
}
