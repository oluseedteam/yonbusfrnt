<?php

namespace App\Notifications;

use App\Models\TaxReturn;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaxReturnStatusNotification extends Notification
{
    use Queueable;

    public function __construct(public TaxReturn $taxReturn) {}

    public function via(object $notifiable): array
    {
        $channels = ['database'];
        if (!empty($notifiable->email)) {
            $channels[] = 'mail';
        }
        return $channels;
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statusFormatted = ucfirst(str_replace('_', ' ', $this->taxReturn->status));
        $taxYear = $this->taxReturn->year ?? date('Y');

        return (new MailMessage)
            ->subject("Tax Return Update — Year {$taxYear} ({$statusFormatted})")
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line("Your {$taxYear} Canadian Tax Return status has been updated to **{$statusFormatted}**.")
            ->line('**Tax Year:** ' . $taxYear)
            ->line('**Status:** ' . $statusFormatted)
            ->when($this->taxReturn->notes, function ($mail) {
                return $mail->line('**Advisor Notes:** ' . $this->taxReturn->notes);
            })
            ->action('Track Tax Return in Portal', url('/client/tax-returns'))
            ->line('Log in to your portal to review any required documentation or details.');
    }

    public function toDatabase(object $notifiable): array
    {
        $statusFormatted = ucfirst(str_replace('_', ' ', $this->taxReturn->status));
        $taxYear = $this->taxReturn->year ?? date('Y');

        return [
            'title'         => "Tax Return ({$taxYear}) Updated",
            'message'       => "Your {$taxYear} tax return status changed to {$statusFormatted}.",
            'type'          => 'tax_return_status',
            'url'           => '/client/tax-returns',
            'tax_return_id' => $this->taxReturn->id,
        ];
    }
}
