<x-app-layout>

    <div class="max-w-7xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">Assets</h2>

                <a href="{{ route('assets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Add Asset

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

                        <th class="p-3 text-left">Asset ID</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Model</th>
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Department</th>
                        <th class="p-3 text-left">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($assets as $asset)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="p-3">{{ $asset->asset_id }}</td>

                            <td class="p-3">{{ $asset->asset_type }}</td>

                            <td class="p-3">{{ $asset->model }}</td>

                            <td class="p-3">{{ $asset->user->name ?? '-' }}</td>

                            <td class="p-3">{{ $asset->department->name ?? '-' }}</td>

                            <td class="p-3 flex gap-2">

                                <a href="{{ route('assets.edit', $asset->id) }}" class="text-blue-600 hover:underline">

                                    Edit

                                </a>

                                <form method="POST" action="{{ route('assets.destroy', $asset->id) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Delete asset?')"
                                        class="text-red-600 hover:underline">

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
