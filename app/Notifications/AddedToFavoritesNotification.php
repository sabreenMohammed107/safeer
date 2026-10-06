<?php

namespace App\Notifications;

use App\Models\Hotel;
use App\Models\Offer;
use App\Models\SiteUser;
use App\Models\Tour;
use App\Models\Transfer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Tells the admins that a site user added a Hotel / Tour / Offer / Transfer
 * to their favourites.
 *
 * Everything the message needs (names, links) is resolved here in the
 * constructor and kept as plain values, so the queued job never has to
 * re-query the item — the user may have un-favourited it, or the admin may
 * have deleted it, by the time the queue worker runs.
 */
class AddedToFavoritesNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Per item type: label, admin edit route and the column holding its name.
     */
    private const TYPES = [
        Tour::class => ['label' => 'Tour', 'route' => 'tours.edit', 'name' => 'en_name'],
        Offer::class => ['label' => 'Offer', 'route' => 'offers.edit', 'name' => 'subtitle_en'],
        Hotel::class => ['label' => 'Hotel', 'route' => 'hotels.edit', 'name' => 'hotel_enname'],
        Transfer::class => ['label' => 'Transfer', 'route' => 'transfer.edit', 'name' => null],
    ];

    public string $itemType;
    public int $itemId;
    public string $itemName;
    public string $userName;
    public ?string $userEmail;
    public ?string $userPhone;
    public string $url;

    public function __construct(Model $item, ?SiteUser $user)
    {
        $type = self::TYPES[get_class($item)] ?? ['label' => class_basename($item), 'route' => null, 'name' => null];

        $this->itemType = $type['label'];
        $this->itemId = $item->getKey();
        $this->itemName = $this->resolveItemName($item, $type['name']);
        $this->userName = optional($user)->display_name ?: 'A visitor';
        $this->userEmail = $user->email ?? null;
        $this->userPhone = $user->phone ?? null;
        $this->url = $type['route'] ? route($type['route'], $this->itemId) : route('admin.home');
    }

    private function resolveItemName(Model $item, ?string $column): string
    {
        if ($item instanceof Transfer) {
            $from = optional($item->locationFrom)->location_enname;
            $to = optional($item->locationTo)->location_enname;

            if ($from && $to) {
                return "{$from} → {$to}";
            }
        }

        return ($column ? $item->{$column} : null) ?: "{$this->itemType} #{$this->itemId}";
    }

    public function via($notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * The bell entry is a quick insert, so it's written during the request.
     * Mail goes to the `database` queue (jobs table) for `queue:work` to send:
     * SMTP takes seconds per admin, which would freeze the favourite button.
     */
    public function viaConnections(): array
    {
        return ['database' => 'sync', 'mail' => 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New favourite: {$this->itemType} \"{$this->itemName}\"")
            ->greeting("Hello {$notifiable->name},")
            ->line("**{$this->userName}** just added a **{$this->itemType}** to their favourites list.")
            ->line("**{$this->itemType}:** {$this->itemName}")
            ->line('**Customer email:** ' . ($this->userEmail ?? '—'))
            ->line('**Date:** ' . now()->format('d M Y, h:i A'))
            ->action("View {$this->itemType} in Dashboard", $this->url)
            ->line('This may be a good moment to follow up with the customer.')
            ->salutation('Regards, ' . config('mail.from.name'));
    }

    /**
     * Stored as JSON in notifications.data and rendered by the admin bell.
     */
    public function toArray($notifiable): array
    {
        return [
            'title' => "New favourite {$this->itemType}",
            'message' => "{$this->userName} added {$this->itemType} \"{$this->itemName}\" to favourites.",
            'icon' => 'bi bi-heart-fill',
            'color' => 'danger',
            'url' => $this->url,
            'url_label' => "Open {$this->itemType}",
            'item_type' => $this->itemType,
            'item_id' => $this->itemId,
            // Shown on the notification details page (admin.notifications.show).
            'customer' => [
                'name' => $this->userName,
                'email' => $this->userEmail,
                'phone' => $this->userPhone,
            ],
            'details' => [
                'Action' => 'Added to favourites',
                'Item type' => $this->itemType,
                'Item' => $this->itemName,
            ],
        ];
    }
}
