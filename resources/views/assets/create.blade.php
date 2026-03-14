<x-app-layout>

    <div class="max-w-5xl mx-auto mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-3xl">

            <h2 class="text-xl font-bold mb-6 text-center">

                {{ isset($asset) ? 'Edit Asset' : 'Add Asset' }}

            </h2>

            <form method="POST"
                action="{{ isset($asset) ? route('assets.update', $asset->id) : route('assets.store') }}">

                @csrf
                @if (isset($asset))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-2 gap-4">

                    <div>
                        <label>Location</label>
                        <div class="flex gap-2">
                            <select name="location_id" id="locationSelect" class="border rounded w-full p-2">
                                <option value="">Select Location</option>
                                @foreach ($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->name }}</option>
                                @endforeach
                            </select>

                            <button type="button" onclick="openLocationModal()"
                                class="bg-blue-600 text-white px-3 rounded">
                                +
                            </button>
                        </div>
                    </div>

                    <div>
                        <label>Department</label>
                        <select name="department_id" class="border rounded w-full p-2">
                            <option value="">Select</option>
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}"
                                    {{ isset($asset) && $asset->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Asset ID</label>
                        <input type="text" name="asset_id" value="{{ old('asset_id', $asset->asset_id ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Asset Type</label>
                        <select name="asset_type" class="border rounded w-full p-2">
                            <option value="Software">Software</option>
                            <option value="Desktop">Desktop</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Other Hardware">Other Hardware</option>
                            <option value="Subscriptions">Subscriptions</option>
                        </select>
                    </div>

                    <div>
                        <label>IP Address</label>
                        <input type="text" name="ip" value="{{ old('ip', $asset->ip ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Serial Number</label>
                        <input type="text" name="serial_number"
                            value="{{ old('serial_number', $asset->serial_number ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Model</label>
                        <input type="text" name="model" value="{{ old('model', $asset->model ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>OS</label>
                        <input type="text" name="os" value="{{ old('os', $asset->os ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>RAM</label>
                        <input type="text" name="ram" value="{{ old('ram', $asset->ram ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Storage</label>
                        <input type="text" name="storage" value="{{ old('storage', $asset->storage ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Manufacturing</label>
                        <input type="text" name="manufacturing"
                            value="{{ old('manufacturing', $asset->manufacturing ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Assign User</label>
                        <select name="assigned_to" class="border rounded w-full p-2">
                            <option value="">Select User</option>
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->id }}"
                                    {{ isset($asset) && $asset->assigned_to == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label>Email</label>
                        <input type="text" name="email" value="{{ old('email', $asset->email ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                    <div>
                        <label>Old User</label>
                        <input type="text" name="old_user" value="{{ old('old_user', $asset->old_user ?? '') }}"
                            class="border rounded w-full p-2">
                    </div>

                </div>

                <div class="mt-6 flex gap-3">
                    <button class="bg-blue-600 text-white px-6 py-2 rounded">
                        {{ isset($asset) ? 'Update Asset' : 'Create Asset' }}
                    </button>

                    <a href="{{ route('assets.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded">
                        Cancel
                    </a>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
<div id="locationModal"
    class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center max-w-4xl mx-auto mt-10">

    <div class="bg-white p-6 rounded shadow-lg w-96">

        <h3 class="text-lg font-bold mb-4">

            Add Location

        </h3>

        <input type="text" id="locationName" class="border w-full p-2 mb-4" placeholder="Location Name">

        <div class="flex justify-end gap-2">

            <button onclick="closeLocationModal()" class="bg-gray-500 text-white px-4 py-2 rounded">

                Cancel

            </button>

            <button onclick="saveLocation()" class="bg-blue-600 text-white px-4 py-2 rounded">

                Save

            </button>

        </div>

    </div>

</div>
<script>
    function openLocationModal() {
        document.getElementById('locationModal').classList.remove('hidden');
    }

    function closeLocationModal() {
        document.getElementById('locationModal').classList.add('hidden');
    }

    function saveLocation() {

        let name = document.getElementById('locationName').value;

        fetch("{{ route('locations.store') }}", {

                method: "POST",

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

                body: JSON.stringify({
                    name: name
                })

            })

            .then(res => res.json())
            .then(data => {

                let select = document.getElementById('locationSelect');

                let option = document.createElement("option");

                option.value = data.id;

                option.text = data.name;

                select.add(option);

                select.value = data.id;

                closeLocationModal();

            });

    }
</script>
