<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\TicketTag;
use App\Models\TicketMessage;
use App\Models\TicketAttachment;

class TicketController extends Controller
{
    public function index(Request $request)
    {

        $user = auth()->user();
        $departmentId = $user->department_id;

        $query = Ticket::query();

        $query->where(function ($q) use ($departmentId, $user) {

            $q->where('created_by', $user->id)

                ->orWhere('department_id', $departmentId)

                ->orWhereHas('tags', function ($tag) use ($departmentId) {

                    $tag->where('department_id', $departmentId);
                });
        });

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->mine) {
            $query->where('created_by', $user->id);
        }

        $tickets = $query->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $departments = Department::all();

        return view('tickets.create', compact('departments'));
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
            'created_by' => auth()->id()
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

        return redirect()->route('tickets.index')->with('success','Ticket created successfully');;
    }

    public function show($id)
    {

        $ticket = Ticket::findOrFail($id);

        $messages = TicketMessage::where('ticket_id', $id)->get();

        return view('tickets.show', compact('ticket', 'messages'));
    }

    public function reply(Request $request)
    {

        TicketMessage::create([

            'ticket_id' => $request->ticket_id,

            'user_id' => auth()->id(),

            'message' => $request->message

        ]);

        return redirect()->back()->with('success','Message added successfully');;
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
