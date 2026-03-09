<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">
                Add Employee
            </h2>

            <form method="POST" action="{{ route('employees.store') }}">

                @csrf

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">
                        Name
                    </label>

                    <input type="text" name="name" class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">
                        Email
                    </label>

                    <input type="email" name="email" class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">
                        Password
                    </label>

                    <input type="password" name="password" class="border rounded w-full p-2">

                </div>

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">
                        Department
                    </label>

                    <select name="department_id" class="border rounded w-full p-2">

                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">
                                {{ $department->name }}
                            </option>
                        @endforeach

                    </select>

                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full">

                    Create Employee

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
