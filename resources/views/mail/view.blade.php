<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">

            <h2 class="text-xl font-bold mb-4">

                {{ $email->subject }}

            </h2>

            <div class="mb-4">

                <strong>From:</strong> {{ $email->from_email }}

            </div>

            <div class="mb-4">

                <strong>To:</strong> {{ $email->to_email }}

            </div>

            <div class="mb-4 text-gray-500">

                {{ $email->created_at->format('d M Y H:i') }}

            </div>

            <hr class="my-6">

            <div class="prose">

                {!! $email->body !!}

            </div>

        </div>

    </div>

</x-app-layout>
