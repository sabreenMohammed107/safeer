<?php

namespace App\Notifications;

use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\VisaLead;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

/**
 * Tells the admins that a visitor submitted one of the public website forms:
 * Contact Us, newsletter signup, or the guest visa request.
 *
 * Build it with one of the named constructors (forContact, forNewsletter,
 * forVisaLead). As with the other admin notifications, everything is resolved
 * up front into plain values so the queued mail job never re-queries.
 */
class WebsiteFormNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $title,
        public string $message,
        public string $icon,
        public string $color,
        public string $url,
        public string $urlLabel,
        /** @var array{name:?string, email:?string, phone:?string} */
        public array $customer,
        /** @var array<string,string> label => value */
        public array $details,
    ) {
    }

    public static function forContact(Contact $contact): self
    {
        return new self(
            title: 'New contact message',
            message: "{$contact->name} sent a message: \"" . Str::limit($contact->message, 80) . '"',
            icon: 'bi bi-chat-left-text-fill',
            color: 'primary',
            url: route('contact'),
            urlLabel: 'Open contact messages',
            customer: ['name' => $contact->name, 'email' => $contact->email, 'phone' => $contact->phone],
            details: [
                'Action' => 'Sent a Contact Us message',
                'Message' => $contact->message,
            ],
        );
    }

    public static function forNewsletter(Newsletter $subscription): self
    {
        return new self(
            title: 'New newsletter subscriber',
            message: "{$subscription->email} subscribed to the newsletter.",
            icon: 'bi bi-envelope-paper-fill',
            color: 'info',
            url: route('newsletterEmails'),
            urlLabel: 'Open newsletter list',
            customer: ['name' => null, 'email' => $subscription->email, 'phone' => null],
            details: ['Action' => 'Subscribed to the newsletter'],
        );
    }

    public static function forVisaLead(VisaLead $lead): self
    {
        $lead->loadMissing(['country', 'visaType', 'nationality']);
        $country = optional($lead->country)->en_country ?? '—';
        $visaType = optional($lead->visaType)->en_type ?? '—';

        return new self(
            title: 'New guest visa request',
            message: "{$lead->passenger_name} submitted a visa request: {$visaType} ({$country}).",
            icon: 'bi bi-file-earmark-person-fill',
            color: 'warning',
            url: route('visa-leads.show', $lead->id),
            urlLabel: 'Open visa request',
            customer: ['name' => $lead->passenger_name, 'email' => $lead->email, 'phone' => $lead->mobile_number],
            details: [
                'Action' => 'Submitted a visa request (guest)',
                'Country' => $country,
                'Visa type' => $visaType,
                'Nationality' => optional($lead->nationality)->en_nationality ?? '—',
                'Personal photo' => $lead->personal_image ? 'Uploaded' : 'Not uploaded',
            ],
        );
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
        $mail = (new MailMessage)
            ->subject($this->title . ($this->customer['name'] ? " from {$this->customer['name']}" : ''))
            ->greeting("Hello {$notifiable->name},")
            ->line($this->message);

        foreach (['Name' => 'name', 'Email' => 'email', 'Phone' => 'phone'] as $label => $key) {
            if (!empty($this->customer[$key])) {
                $mail->line("**{$label}:** {$this->customer[$key]}");
            }
        }
        foreach ($this->details as $label => $value) {
            $mail->line("**{$label}:** {$value}");
        }

        return $mail
            ->line('**Date:** ' . now()->format('d M Y, h:i A'))
            ->action($this->urlLabel, $this->url)
            ->salutation('Regards, ' . config('mail.from.name'));
    }

    public function toArray($notifiable): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'icon' => $this->icon,
            'color' => $this->color,
            'url' => $this->url,
            'url_label' => $this->urlLabel,
            'customer' => $this->customer,
            'details' => $this->details,
        ];
    }
}
