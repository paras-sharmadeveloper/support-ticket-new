<?php

namespace App\Http\Controllers;

use App\Models\{Ticket, User};
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\TicketTag;
use App\Models\TicketMessage;
use App\Models\{TicketAttachment, TicketMessageAttachment, Asset};
use App\Notifications\TicketCreatedNotification;
use App\Services\MailService;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $departmentId = $user->department_id;
        $companyId = $user->company_id;

        // Base query → company tickets only
        $query = Ticket::where('company_id', $companyId);

        // Employee restriction
        if ($user->role != 'admin') {

            $query->where(function ($q) use ($departmentId, $user) {

                $q->where('created_by', $user->id)

                    ->orWhere('department_id', $departmentId)

                    ->orWhereHas('tags', function ($tag) use ($departmentId) {

                        $tag->where('department_id', $departmentId);
                    });
            });
        }

        // Filters

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->mine) {
            $query->where('created_by', $user->id);
        }

        $tickets = $query->with('ticketCreator')->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)->get();
        $assets = Asset::where('company_id', auth()->user()->company_id)->get();

        return view('tickets.create', compact('departments', 'assets'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'department_id' => 'required',
            'priority' => 'required'
        ]);

        $ticketNumber = 'TKT' . rand(1000, 9999);

        $ticket = Ticket::create([
            'ticket_number' => $ticketNumber,
            'title' => $request->title,
            'description' => $request->description,
            'department_id' => $request->department_id,
            'priority' => $request->priority,
            'created_by' => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'asset_id' => $request->asset_id
        ]);

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $filename = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/tickets'), $filename);

                TicketAttachment::create([

                    'ticket_id' => $ticket->id,
                    'file' => $filename

                ]);
            }
        }

        if ($request->tags) {

            foreach ($request->tags as $tag) {

                TicketTag::create([
                    'ticket_id' => $ticket->id,
                    'department_id' => $tag
                ]);
            }
        }

        $users = User::where('company_id', auth()->user()->company_id)
            ->where('department_id', $ticket->department_id)->get();

        foreach ($users as $user) {

            // Internal Notification
            $user->notify(
                new TicketCreatedNotification($ticket)
            );

            // Email Notification
            MailService::send(
                $user->email,
                'New Ticket Assigned',
                'email.ticket_assigned',
                ['ticket' => $ticket],
                auth()->user()->company_id
            );
        }
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully');;
    }

    public function show($id)
    {

        $ticket = Ticket::with('ticketCreator')->where('id', $id)->firstOrFail();

        $messages = TicketMessage::where('ticket_id', $id)->get();


        return view('tickets.show', compact('ticket', 'messages'));
    }

    public function reply(Request $request)
    {

        $message =  TicketMessage::create([

            'ticket_id' => $request->ticket_id,

            'user_id' => auth()->id(),

            'message' => $request->message

        ]);

        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {

                $name = time() . '_' . $file->getClientOriginalName();

                $file->move(public_path('uploads/ticket_messages'), $name);

                TicketMessageAttachment::create([

                    'ticket_message_id' => $message->id,

                    'file' => $name

                ]);
            }
        }

        return redirect()->back()->with('success', 'Message added successfully');;
    }
    public function resolve($id)
    {

        $ticket = Ticket::findOrFail($id);

        $ticket->status = 'resolved';

        $ticket->resolved_by = auth()->id();

        $ticket->resolved_at = now();

        $ticket->save();

        return redirect()->back();
    }
}
