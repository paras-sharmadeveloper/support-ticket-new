<h2>New Ticket Assigned</h2>

<p>
    Ticket : {{ $ticket->title }}
</p>

<p>
    <a href="{{ route('tickets.show', $ticket->id) }}">
        View Ticket
    </a>
</p>
