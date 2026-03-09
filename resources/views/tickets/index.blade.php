<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">
                    My Tickets
                </h2>

                <a href="{{ route('tickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Create Ticket

                </a>

            </div>

            <table class="w-full border rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">Ticket</th>
                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Priority</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($tickets as $ticket)
                        <tr class="border-t">

                            <td class="p-3">{{ $ticket->ticket_number }}</td>

                            <td class="p-3">{{ $ticket->title }}</td>

                            <td class="p-3">

                                @if ($ticket->priority == 'high')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded">High</span>
                                @endif

                                @if ($ticket->priority == 'medium')
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Medium</span>
                                @endif

                                @if ($ticket->priority == 'low')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded">Low</span>
                                @endif

                            </td>

                            <td class="p-3">

                                @if ($ticket->status == 'open')
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded">Open</span>
                                @endif

                                @if ($ticket->status == 'resolved')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded">Resolved</span>
                                @endif

                            </td>

                            <td class="p-3">

                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 underline">

                                    View

                                </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
