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

        // Must be set here, not in build(): Mailable::render()/send() read
        // $this->locale to decide the active locale *before* build() runs,
        // so calling ->locale() inside build() is always one step too late.
        $this->locale(app()->getLocale());
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('emails.order_subject', ['id' => $this->order->id]))
            ->view('emails.order')
            ->with([
                'order' => $this->order,
                'cost' => $this->cost,
                'customer' => $this->order->user,
            ]);
    }
}
