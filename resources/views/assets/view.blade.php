<x-app-layout>

    <div class="max-w-7xl mx-auto mt-10">

        <div class="grid grid-cols-3 gap-6">

            <!-- LEFT SIDE -->

            <div class="col-span-2">

                <div class="bg-white shadow rounded p-6 mb-6">

                    <h2 class="text-xl font-bold mb-4">

                        Asset # {{ $asset->asset_id }}

                    </h2>

                    <table class="w-full">

                        <tr>
                            <td class="font-semibold p-2">Asset Type</td>
                            <td>{{ $asset->asset_type }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">Model</td>
                            <td>{{ $asset->model }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">IP Address</td>
                            <td>{{ $asset->ip }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">Serial Number</td>
                            <td>{{ $asset->serial_number }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">Operating System</td>
                            <td>{{ $asset->os }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">RAM</td>
                            <td>{{ $asset->ram }}</td>
                        </tr>

                        <tr>
                            <td class="font-semibold p-2">Storage</td>
                            <td>{{ $asset->storage }}</td>
                        </tr>

                    </table>

                </div>

                <!-- TICKETS -->

                <div class="bg-white shadow rounded p-6">

                    <h3 class="font-bold mb-4">

                        Tickets Created on this Asset

                    </h3>

                    <table class="w-full">

                        <tr class="border-b">

                            <th class="p-2 text-left">Ticket</th>
                            <th class="p-2 text-left">Status</th>
                            <th class="p-2 text-left">Created</th>

                        </tr>
                        @if ($tickets->isEmpty())
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-500">
                                    No tickets associated with this asset.
                                </td>
                            </tr>
                        @else
                            @foreach ($tickets as $ticket)
                                <tr class="border-b">

                                    <td class="p-2">

                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600">

                                            #{{ $ticket->ticket_number }}

                                        </a>

                                    </td>

                                    <td class="p-2">

                                        {{ ucfirst($ticket->status) }}

                                    </td>

                                    <td class="p-2">

                                        {{ $ticket->created_at->diffForHumans() }}

                                    </td>

                                </tr>
                            @endforeach
                        @endif

                    </table>

                </div>

            </div>

            <!-- RIGHT SIDE -->

            <div>

                <div class="bg-white shadow rounded p-6">

                    <h3 class="font-bold mb-4">

                        Assigned User

                    </h3>

                    <p>

                        <strong>Name:</strong>
                        {{ $asset->user->name ?? '-' }}

                    </p>

                    <p>

                        <strong>Email:</strong>
                        {{ $asset->email }}

                    </p>

                    <p>

                        <strong>Department:</strong>
                        {{ $asset->department->name ?? '-' }}

                    </p>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
