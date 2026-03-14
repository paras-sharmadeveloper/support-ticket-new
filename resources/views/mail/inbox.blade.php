<x-app-layout>

    <div class="max-w-6xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between mb-4">

                <h2 class="text-xl font-bold">Inbox</h2>

                <a href="{{ route('mail.compose') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Compose

                </a>

            </div>

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="p-3 text-left">From</th>
                        <th class="p-3 text-left">Subject</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($emails as $email)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">
                                {{ $email->from_email }}
                            </td>

                            <td class="p-3">
                                {{ $email->subject }}
                            </td>

                            <td class="p-3">
                                {{ $email->created_at->format('d M Y H:i') }}
                            </td>
                            <td? class="p-3">
                                <a href="{{ route('mail.view', $email->id) }}"
                                    class="text-blue-600 hover:underline">View</a>
                                </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
