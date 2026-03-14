<x-app-layout>

    <div class="max-w-6xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <h2 class="text-xl font-bold mb-4">Sent Emails</h2>

            <table class="w-full">

                <thead>

                    <tr class="border-b">

                        <th class="p-3 text-left">To</th>
                        <th class="p-3 text-left">Subject</th>
                        <th class="p-3 text-left">Date</th>
                        <th class="p-3 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($emails as $email)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">
                                {{ $email->to_email }}
                            </td>

                            <td class="p-3">
                                {{ $email->subject }}
                            </td>

                            <td class="p-3">
                                {{ $email->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="p-3">
                                <a href="{{ route('mail.compose') }}?reply={{ $email->id }}">
                                    Reply
                                </a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
