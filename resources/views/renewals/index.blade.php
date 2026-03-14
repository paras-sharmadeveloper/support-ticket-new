<x-app-layout>

    <div class="max-w-7xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">
                    Renewal Reminders
                </h2>

                <a href="{{ route('renewals.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Add Reminder
                </a>

            </div>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <table class="w-full">

                <thead>
                    <tr class="border-b">

                        <th class="p-3 text-left">Title</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Renewal Date</th>
                        <th class="p-3 text-left">Cycle</th>
                        <th class="p-3 text-left">Vendor</th>
                        <th class="p-3 text-left">Actions</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($renewals as $renewal)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $renewal->title }}</td>

                            <td class="p-3">{{ ucfirst($renewal->type) }}</td>

                            <td class="p-3">{{ $renewal->renewal_date }}</td>

                            <td class="p-3">{{ ucfirst($renewal->cycle) }}</td>

                            <td class="p-3">{{ $renewal->vendor }}</td>

                            <td class="p-3 flex gap-3">

                                <a href="{{ route('renewals.edit', $renewal->id) }}"
                                    class="text-blue-600 hover:underline">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('renewals.destroy', $renewal->id) }}"
                                    onsubmit="return confirm('Delete reminder?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="text-red-600 hover:underline">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
