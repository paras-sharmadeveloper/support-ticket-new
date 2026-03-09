<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketCreatedNotification extends Notification
{
    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Ticket Created')
            ->line('A new support ticket has been created.')
            ->line('Ticket: ' . $this->ticket->title)
            ->action('View Ticket', url('/tickets/' . $this->ticket->id));
    }

    public function toArray($notifiable)
    {
        return [

            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title

        ];
    }
}
