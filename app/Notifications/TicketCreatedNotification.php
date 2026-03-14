<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class TicketCreatedNotification extends Notification
{
    public $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [

            'title' => 'New Ticket Assigned',

            'message' => 'Ticket #' . $this->ticket->ticket_number . ' assigned to you',

            'url' => route('tickets.show', $this->ticket->id)

        ];
    }

    public function toMail($notifiable)
    {

        return (new MailMessage)

            ->subject('New Ticket Assigned')

            ->line('A new ticket has been assigned to you.')

            ->line('Ticket: ' . $this->ticket->title)

            ->action('View Ticket', route('tickets.show', $this->ticket->id));
    }
}
