<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-6xl">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">
                    Employees
                </h2>

                <a href="{{ route('employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Add Employee

                </a>

            </div>

            <table class="w-full border rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Name</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Department</th>
                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($employees as $employee)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $employee->id }}
                            </td>

                            <td class="p-3">
                                {{ $employee->name }}
                            </td>

                            <td class="p-3">
                                {{ $employee->email }}
                            </td>

                            <td class="p-3">
                                {{ $employee->department->name ?? '' }}
                            </td>
                            <td>
                                <form method="POST" action="{{ route('employees.resend.email', $employee->id) }}"
                                    class="inline">

                                    @csrf

                                    <button class="bg-blue-600 text-white px-3 py-1 rounded">

                                        Resend Email

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
