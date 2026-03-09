<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-5xl">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">
                    Departments
                </h2>

                <a href="{{ route('departments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Add Department

                </a>

            </div>

            <table class="w-full border rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Department</th>
                        <th class="p-3 text-left">Description</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($departments as $department)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $department->id }}
                            </td>

                            <td class="p-3">
                                {{ $department->name }}
                            </td>

                            <td class="p-3">
                                {{ $department->description }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
