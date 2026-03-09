<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">

            <h2 class="text-xl font-bold mb-4">

                Ticket #{{ $ticket->ticket_number }}

            </h2>

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

                                <img src="{{ asset('uploads/tickets/' . $file->file) }}" width="120">

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

                </div>
            @endforeach

            <hr class="my-6">

            <h3 class="font-bold mb-3">Reply</h3>

            <form method="POST" action="{{ route('tickets.reply') }}">

                @csrf

                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                <textarea name="message" class="border rounded w-full p-3 mb-4"></textarea>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                    Send Reply

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
