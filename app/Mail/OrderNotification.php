<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected Orders $order;
    protected float $cost;

    public function __construct(Orders $order, float $cost)
    {
        $this->order = $order->loadMissing([
            'user',
            'order_details.room_details',
            'order_details.tours_details',
            'order_details.transfer_details',
            'order_details.visa_details',
        ]);
        $this->cost = $cost;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Order Confirmation - Order #' . $this->order->id)
            ->view('emails.order')
            ->with([
                'order' => $this->order,
                'cost' => $this->cost,
                'customer' => $this->order->user,
            ]);
    }
}
