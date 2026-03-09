<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">
                Add Department
            </h2>

            <form method="POST" action="{{ route('departments.store') }}">

                @csrf

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">
                        Department Name
                    </label>

                    <input type="text" name="name" class="border rounded w-full p-2">

                </div>

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">
                        Description
                    </label>

                    <textarea name="description" class="border rounded w-full p-2"></textarea>

                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full">

                    Save Department

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
