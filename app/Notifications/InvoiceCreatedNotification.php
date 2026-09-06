<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceCreatedNotification extends Notification
{
    use Queueable;

    public function __construct(public Invoice $invoice) {}

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
        $totalFormatted = '$' . number_format($this->invoice->total_amount ?? $this->invoice->amount, 2);
        $dueDateStr     = $this->invoice->due_date ? date('F j, Y', strtotime($this->invoice->due_date)) : 'Upon receipt';

        return (new MailMessage)
            ->subject("New Invoice Issued — #{$this->invoice->invoice_number} ({$totalFormatted})")
            ->greeting('Hello ' . ($notifiable->first_name ?? $notifiable->name ?? 'Valued Client') . ',')
            ->line('A new invoice has been generated for your account at **YONBUS Tax & Accounting Services**.')
            ->line('**Invoice Number:** ' . $this->invoice->invoice_number)
            ->line('**Total Amount Due:** ' . $totalFormatted)
            ->line('**Due Date:** ' . $dueDateStr)
            ->when($this->invoice->notes, function ($mail) {
                return $mail->line('**Notes:** ' . $this->invoice->notes);
            })
            ->action('View Invoice in Portal', url('/client/dashboard'))
            ->line('Thank you for your business.');
    }

    public function toDatabase(object $notifiable): array
    {
        $totalFormatted = '$' . number_format($this->invoice->total_amount ?? $this->invoice->amount, 2);

        return [
            'title'      => "Invoice #{$this->invoice->invoice_number} Issued",
            'message'    => "New invoice for {$totalFormatted} has been issued to your account.",
            'type'       => 'invoice_created',
            'url'        => '/client/dashboard',
            'invoice_id' => $this->invoice->id,
        ];
    }
}
