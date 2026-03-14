<?php

namespace App\Http\Controllers;

use App\Models\{
    Asset,
    Department,
    User,
    Ticket
};
use Illuminate\Http\Request;
use App\Models\Location;

class AssetController extends Controller
{

    public function showImport()
    {

        $assets = Asset::where(
            'company_id',
            auth()->user()->company_id
        )->latest()->get();

        return view('assets.import', compact('assets'));
    }
    public function index(Request $request)
    {

        $query = Asset::where(
            'company_id',
            auth()->user()->company_id
        );

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('asset_id', 'like', '%' . $request->search . '%')
                    ->orWhere('model', 'like', '%' . $request->search . '%')
                    ->orWhere('ip', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->department) {

            $query->where('department_id', $request->department);
        }

        if ($request->asset_type) {

            $query->where('asset_type', $request->asset_type);
        }

        $assets = $query->latest()->get();

        $departments = Department::where(
            'company_id',
            auth()->user()->company_id
        )->get();

        return view('assets.index', compact('assets', 'departments'));
    }
    public function create()
    {

        $departments = Department::where(
            'company_id',
            auth()->user()->company_id
        )->get();

        $employees = User::where(
            'company_id',
            auth()->user()->company_id
        )->get();
        $locations = Location::where(
            'company_id',
            auth()->user()->company_id
        )->get();


        return view('assets.create', compact('departments', 'employees', 'locations'));
    }
    public function store(Request $request)
    {

        Asset::create([

            'company_id' => auth()->user()->company_id,

            'department_id' => $request->department_id,

            'location' => $request->location,

            'asset_id' => $request->asset_id,

            'asset_type' => $request->asset_type,

            'ip' => $request->ip,

            'serial_number' => $request->serial_number,

            'model' => $request->model,

            'os' => $request->os,

            'ram' => $request->ram,

            'manufacturing' => $request->manufacturing,

            'storage' => $request->storage,

            'assigned_to' => $request->assigned_to,

            'email' => $request->email,

            'old_user' => $request->old_user

        ]);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset created');
    }
    public function edit($id)
    {
        $asset = Asset::findOrFail($id);

        $departments = Department::where(
            'company_id',
            auth()->user()->company_id
        )->get();

        $employees = User::where(
            'company_id',
            auth()->user()->company_id
        )->get();
        $locations = Location::where(
            'company_id',
            auth()->user()->company_id
        )->get();


        return view(
            'assets.create',
            compact('asset', 'departments', 'employees', 'locations')
        );
    }
    public function importForm()
    {
        return view('assets.import');
    }
    public function import(Request $request)
    {

        $file = fopen($request->file('file'), "r");

        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {

            Asset::create([

                'company_id' => auth()->user()->company_id,

                'location' => $row[0],

                'asset_id' => $row[2],

                'asset_type' => $row[3],

                'ip' => $row[4],

                'serial_number' => $row[5],

                'model' => $row[6],

                'os' => $row[7],

                'ram' => $row[8],

                'manufacturing' => $row[9],

                'storage' => $row[10],

                'email' => $row[13],

                'old_user' => $row[14]

            ]);
        }

        fclose($file);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Assets imported successfully');
    }

    public function update(Request $request, $id)
    {

        $asset = Asset::where(
            'company_id',
            auth()->user()->company_id
        )->findOrFail($id);

        $asset->update([

            'department_id' => $request->department_id,

            'location_id' => $request->location_id,

            'asset_id' => $request->asset_id,

            'asset_type' => $request->asset_type,

            'ip' => $request->ip,

            'serial_number' => $request->serial_number,

            'model' => $request->model,

            'os' => $request->os,

            'ram' => $request->ram,

            'manufacturing' => $request->manufacturing,

            'storage' => $request->storage,

            'assigned_to' => $request->assigned_to,

            'email' => $request->email,

            'old_user' => $request->old_user

        ]);

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset updated successfully');
    }

    public function destroy($id)
    {

        $asset = Asset::where(
            'company_id',
            auth()->user()->company_id
        )->findOrFail($id);

        $asset->delete();

        return redirect()
            ->route('assets.index')
            ->with('success', 'Asset deleted successfully');
    }

    public function show($id)
    {

        $asset = Asset::with(['department', 'user'])
            ->where('company_id', auth()->user()->company_id)
            ->findOrFail($id);

        $tickets = Ticket::where('asset_id', $id)->latest()->get();

        return view('assets.view', compact('asset', 'tickets'));
    }
}
