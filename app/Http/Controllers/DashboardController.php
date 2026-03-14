<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $openTickets = Ticket::where('status', 'open')->count();

        $resolvedTickets = Ticket::where('status', 'resolved')->count();

        $myTickets = Ticket::where('created_by', $userId)->count();
        $reminders = Renewal::where('company_id', auth()->user()->company_id)
            ->whereDate(
                'renewal_date',
                '<=',
                now()->addDays(7)
            )->get();

        return view('dashboard', compact(
            'openTickets',
            'resolvedTickets',
            'myTickets',
            'reminders'
        ));
    }
}
