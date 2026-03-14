<x-app-layout>

    <div class="max-w-7xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-6">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">Assets Filters</h2>
                <form method="GET" class="mb-6 bg-gray-50 p-4 rounded shadow flex gap-4">

                    <input type="text" name="search" placeholder="Search Asset ID, Model, IP"
                        value="{{ request('search') }}" class="border p-2 rounded w-1/3">

                    <select name="department" class="border p-2 rounded">

                        <option value="">Department</option>

                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}"
                                {{ request('department') == $dept->id ? 'selected' : '' }}>

                                {{ $dept->name }}

                            </option>
                        @endforeach

                    </select>

                    <select name="asset_type" class="border p-2 rounded">

                        <option value="">Asset Type</option>

                        <option value="Desktop">Desktop</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Software">Software</option>
                        <option value="Other Hardware">Other Hardware</option>
                        <option value="Subscriptions">Subscriptions</option>

                    </select>

                    <button class="bg-blue-600 text-white px-4 rounded">

                        Search

                    </button>

                    <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">

                        Reset

                    </a>

                </form>
            </div>

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
                                <a href="{{ route('assets.view', $asset->id) }}" class="text-green-600 hover:underline">
                                    View
                                </a>

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
