<?php

namespace App\Http\Controllers;

use App\Models\Renewal;
use Illuminate\Http\Request;


class RenewalController extends Controller
{
    public function index()
    {

        $renewals = Renewal::where(
            'company_id',
            auth()->user()->company_id
        )->latest()->get();

        return view('renewals.index', compact('renewals'));
    }
    public function create()
    {
        return view('renewals.create');
    }
    public function store(Request $request)
    {

        Renewal::create([

            'company_id' => auth()->user()->company_id,

            'title' => $request->title,

            'type' => $request->type,

            'start_date' => $request->start_date,

            'renewal_date' => $request->renewal_date,

            'cycle' => $request->cycle,

            'reminder_days' => $request->reminder_days,

            'vendor' => $request->vendor,

            'amount' => $request->amount,

            'notes' => $request->notes

        ]);

        return redirect()
            ->route('renewals.index')
            ->with('success', 'Reminder created');
    }

    public function edit($id)
    {
        $renewal = Renewal::findOrFail($id);

        return view('renewals.create', compact('renewal'));
    }
    public function update(Request $request, $id)
    {

        $renewal = Renewal::findOrFail($id);

        $renewal->update($request->all());

        return redirect()
            ->route('renewals.index')
            ->with('success', 'Reminder updated');
    }
}
