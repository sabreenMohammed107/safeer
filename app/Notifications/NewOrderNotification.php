<?php

namespace App\Notifications;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Tells the admins that a site user placed a new order.
 *
 * Like AddedToFavoritesNotification, the message content is resolved in the
 * constructor (right after the order is committed) and kept as plain values,
 * so the queued job doesn't depend on re-loading the order and its details.
 */
class NewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /** OrderDetails::detail_type => label */
    private const DETAIL_TYPES = [0 => 'Hotel room', 1 => 'Tour', 2 => 'Transfer', 3 => 'Visa'];

    public int $orderId;
    public float $total;
    public string $customerName;
    public ?string $customerEmail;
    public ?string $customerPhone;
    /** @var array<string,int> e.g. ['Tour' => 2, 'Visa' => 1] */
    public array $items = [];
    public string $url;

    public function __construct(Orders $order, float $total)
    {
        $order->loadMissing(['user', 'order_details']);
        $customer = $order->user;

        $this->orderId = $order->id;
        $this->total = $total;
        $this->customerName = optional($customer)->display_name ?: 'A visitor';
        $this->customerEmail = optional($customer)->email;
        $this->customerPhone = optional($customer)->phone;

        foreach ($order->order_details as $detail) {
            $label = self::DETAIL_TYPES[$detail->detail_type] ?? 'Item';
            $this->items[$label] = ($this->items[$label] ?? 0) + 1;
        }

        // The admin "show" page is per order-detail, not per order. Link
        // straight to it when the order has a single item, else to the list.
        $this->url = $order->order_details->count() === 1
            ? route('users-orders.show', $order->order_details->first()->id)
            : route('users-orders.index');
    }

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Bell entry written right away; mail queued on the `database` connection
     * (see AddedToFavoritesNotification::viaConnections).
     */
    public function viaConnections(): array
    {
        return ['database' => 'sync', 'mail' => 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $total = number_format($this->total, 2);

        return (new MailMessage)
            ->subject("New order #{$this->orderId} from {$this->customerName}")
            ->greeting("Hello {$notifiable->name},")
            ->line("A new order has just been placed on the website by **{$this->customerName}**.")
            ->line("**Order number:** #{$this->orderId}")
            ->line("**Items:** {$this->itemsSummary()}")
            ->line("**Total:** {$total}")
            ->line('**Customer email:** ' . ($this->customerEmail ?? '—'))
            ->line('**Customer phone:** ' . ($this->customerPhone ?? '—'))
            ->line('**Date:** ' . now()->format('d M Y, h:i A'))
            ->action('View Order in Dashboard', $this->url)
            ->line('Please review and confirm the order as soon as possible.')
            ->salutation('Regards, ' . config('mail.from.name'));
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => "New order #{$this->orderId}",
            'message' => "{$this->customerName} placed an order ({$this->itemsSummary()}) — total " . number_format($this->total, 2) . '.',
            'icon' => 'bi bi-bag-check-fill',
            'color' => 'success',
            'url' => $this->url,
            'url_label' => 'Open order',
            'order_id' => $this->orderId,
            // Shown on the notification details page (admin.notifications.show).
            'customer' => [
                'name' => $this->customerName,
                'email' => $this->customerEmail,
                'phone' => $this->customerPhone,
            ],
            'details' => [
                'Action' => 'Placed a new order',
                'Order number' => "#{$this->orderId}",
                'Items' => $this->itemsSummary(),
                'Total' => number_format($this->total, 2),
            ],
        ];
    }

    private function itemsSummary(): string
    {
        if (!$this->items) {
            return 'no items';
        }

        return collect($this->items)
            ->map(fn ($count, $label) => $count . ' × ' . $label)
            ->implode(', ');
    }
}
