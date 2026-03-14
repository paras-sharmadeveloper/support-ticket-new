<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="w-full max-w-6xl grid grid-cols-3 gap-6">

            <!-- LEFT SIDE -->

            <div class="col-span-2 bg-white shadow-lg rounded-lg p-8">

                <h2 class="text-xl font-bold mb-4">
                    Ticket #{{ $ticket->ticket_number }}
                </h2>

                <strong class="mt-4">Ticket Details</strong>

                <div class="bg-gray-50 p-4 rounded mb-6">

                    <strong>{{ $ticket->title }}</strong>

                    <p class="mt-2">{{ $ticket->description }}</p>

                </div>

                <!-- Attachments -->

                @if ($ticket->attachments)

                    <div class="mb-6">

                        <strong>Attachments</strong>

                        <div class="flex gap-3 mt-2">

                            @foreach ($ticket->attachments as $file)
                                <a href="{{ asset('uploads/tickets/' . $file->file) }}" target="_blank">

                                    <img src="{{ asset('uploads/tickets/' . $file->file) }}" width="120"
                                        class="rounded border">

                                </a>
                            @endforeach

                        </div>

                    </div>

                @endif

                <hr class="my-6">

                <h3 class="font-bold mb-3">Conversation</h3>

                @foreach ($messages as $msg)
                    <div class="border p-3 mb-3 rounded shadow-sm">

                        <strong>{{ $msg->user->name }}</strong>

                        <p>{{ $msg->message }}</p>

                        <small class="text-gray-500">
                            {{ $msg->created_at->diffForHumans() }}
                        </small>
                        @if ($msg->attachments->count())
                            <div class="mt-3 flex gap-3 flex-wrap">

                                @foreach ($msg->attachments as $file)
                                    <a href="{{ asset('uploads/ticket_messages/' . $file->file) }}" target="_blank">

                                        <img src="{{ asset('uploads/ticket_messages/' . $file->file) }}" width="100"
                                            class="border rounded">

                                    </a>
                                @endforeach

                            </div>
                        @endif
                    </div>
                @endforeach

                <hr class="my-6">

                @if ($ticket->status == 'open')
                    <h3 class="font-bold mb-3">Reply</h3>

                    <form method="POST" action="{{ route('tickets.reply') }}" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">


                        <textarea name="message" class="border rounded w-full p-3 mb-4"></textarea>
                        <div class="mb-6">
                            <label class="block mb-2 font-semibold">Attachments</label>

                            <input type="file" name="attachments[]" multiple class="border rounded w-full p-2">

                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                            Send Reply

                        </button>

                    </form>
                @endif

                <form method="POST" class="resolved-bb" style="float: right"
                    action="{{ route('tickets.resolve', $ticket->id) }}">

                    @csrf

                    @if ($ticket->status == 'open')
                        <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded float-right">
                            Resolve Ticket

                        </button>
                    @else
                        <button class="bg-gray-600 text-white px-6 py-2 rounded float-right" disabled> Resolved</button>
                    @endif

                </form>

            </div>


            <!-- RIGHT SIDE INFO PANEL -->

            <div class="bg-white shadow-lg rounded-lg p-6 h-fit sticky top-6">

                <h3 class="font-bold mb-4 text-gray-700">
                    Ticket Information
                </h3>

                <div class="space-y-4">

                    <div>

                        <span class="text-gray-500 text-sm">Created By</span>

                        <div class="font-semibold">

                            {{ $ticket->ticketCreator->name ?? 'N/A' }}

                        </div>

                        <div class="text-sm text-gray-500">

                            {{ $ticket->ticketCreator->department->name ?? 'N/A' }}

                        </div>

                    </div>

                    <div>

                        <span class="text-gray-500 text-sm">Status</span>

                        <div class="font-semibold">

                            @if ($ticket->status == 'open')
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded">Open</span>
                            @endif

                            @if ($ticket->status == 'resolved')
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded">Resolved</span>
                            @endif


                        </div>

                    </div>
                    @if ($ticket->status == 'resolved')
                        <div>

                            <span class="text-gray-500 text-sm">Resolved by and at</span>

                            <div class="font-semibold">
                                {{ $ticket->resolver ? $ticket->resolver->name : 'N/A' }} at
                                {{ $ticket->resolved_at ? $ticket->resolved_at : 'N/A' }}
                            </div>
                        </div>
                    @endif

                    <div>

                        <span class="text-gray-500 text-sm">Priority</span>

                        <div class="font-semibold">

                            @if ($ticket->priority == 'high')
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded">High</span>
                            @endif

                            @if ($ticket->priority == 'medium')
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded">Medium</span>
                            @endif

                            @if ($ticket->priority == 'low')
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded">Low</span>
                            @endif

                        </div>

                    </div>

                    <div>

                        <span class="text-gray-500 text-sm">Created</span>

                        <div class="font-semibold">

                            {{ $ticket->created_at->format('d M Y h:i A') }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
