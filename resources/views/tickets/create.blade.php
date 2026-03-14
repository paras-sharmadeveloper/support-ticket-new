<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-2xl">

            <h2 class="text-2xl font-bold mb-6 text-center">
                Create Ticket
            </h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 p-3 mb-6 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Title -->

                <div class="mb-5">
                    <label class="block mb-2 font-semibold">Title</label>
                    <input type="text" name="title"
                        class="border rounded w-full p-2 focus:ring focus:ring-blue-200">
                </div>

                <!-- Description -->

                <div class="mb-5">
                    <label class="block mb-2 font-semibold">Description</label>
                    <textarea name="description" rows="4" class="border rounded w-full p-2 focus:ring focus:ring-blue-200"></textarea>
                </div>

                <!-- Department -->

                <div class="mb-5">
                    <label class="block mb-2 font-semibold">Department</label>

                    <select name="department_id" class="border rounded w-full p-2 focus:ring focus:ring-blue-200">

                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach

                    </select>
                </div>
                <select name="asset_id" class="border rounded w-full p-2">

                    <option value="">Select Asset</option>

                    @foreach ($assets as $asset)
                        <option value="{{ $asset->id }}">

                            {{ $asset->asset_id }}

                        </option>
                    @endforeach

                </select>
                <!-- Priority -->

                <div class="mb-5">
                    <label class="block mb-2 font-semibold">Priority</label>

                    <select name="priority" class="border rounded w-full p-2 focus:ring focus:ring-blue-200">

                        <option value="low">Low</option>
                        <option value="medium">Medium</option>
                        <option value="high">High</option>

                    </select>
                </div>

                <!-- Tag Departments -->

                <div class="mb-5">
                    <label class="block mb-2 font-semibold">Tag Departments</label>

                    <select name="tags[]" multiple class="border rounded w-full p-2 focus:ring focus:ring-blue-200">

                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach

                    </select>

                    <p class="text-sm text-gray-500 mt-1">
                        Hold Ctrl (Windows) / Cmd (Mac) to select multiple
                    </p>

                </div>

                <!-- Attachments -->

                <div class="mb-6">
                    <label class="block mb-2 font-semibold">Attachments</label>

                    <input type="file" name="attachments[]" multiple class="border rounded w-full p-2">

                </div>

                <!-- Buttons -->

                <div class="flex gap-3">

                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">

                        Create Ticket

                    </button>

                    <a href="{{ route('tickets.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-2 rounded">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
