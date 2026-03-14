<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">

                Import Assets CSV

            </h2>

            <form method="POST" action="{{ route('assets.import.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">

                        Upload CSV File

                    </label>

                    <input type="file" name="file" accept=".csv" class="border rounded w-full p-2">

                </div>

                <p class="text-sm text-gray-500 mb-4">

                    CSV Columns Required:

                    Location, Department, Asset ID, Asset Type, IP, Serial Number, Model,
                    OS, RAM, Manufacturing, Storage, User, Mail ID, Old User

                </p>

                <button class="bg-green-600 text-white px-6 py-2 rounded w-full">

                    Import Assets

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
