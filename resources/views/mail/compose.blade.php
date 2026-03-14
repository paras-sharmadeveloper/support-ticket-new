<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">

            <h2 class="text-xl font-bold mb-6 text-center">

                Compose Email

            </h2>

            <form method="POST" action="{{ route('mail.send') }}" enctype="multipart/form-data">

                @csrf

                {{-- Reply Logic --}}

                @if (request('reply'))
                    @php
                        $reply = \App\Models\Email::find(request('reply'));
                    @endphp
                @endif

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">

                        To

                    </label>

                    <input type="email" name="to" value="{{ $reply->from_email ?? '' }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">

                        Subject

                    </label>

                    <input type="text" name="subject" value="{{ isset($reply) ? 'Re: ' . $reply->subject : '' }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">

                        Message

                    </label>

                    <textarea name="message" rows="6" class="border rounded w-full p-2">{{ isset($reply) ? "\n\n----------------\n" . $reply->body : '' }}</textarea>

                </div>

                {{-- Attachments --}}

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">

                        Attachments

                    </label>

                    <input type="file" name="attachments[]" multiple class="border rounded w-full p-2">

                </div>

                {{-- Buttons --}}

                <div class="flex gap-3">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded flex-1">

                        Send Email

                    </button>

                    <a href="{{ route('mail.inbox') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded text-center">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
