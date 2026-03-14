<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-6xl">

            <div class="flex justify-between mb-6">

                <h2 class="text-xl font-bold">
                    Companies
                </h2>

                <a href="{{ route('companies.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">

                    Add Company

                </a>

            </div>

            <table class="w-full border rounded">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="p-3 text-left">ID</th>
                        <th class="p-3 text-left">Company</th>
                        <th class="p-3 text-left">Email</th>
                        <th class="p-3 text-left">Phone</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Action</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach ($companies as $company)
                        <tr class="border-t">

                            <td class="p-3">
                                {{ $company->id }}
                            </td>

                            <td class="p-3">
                                {{ $company->name }}
                            </td>

                            <td class="p-3">
                                {{ $company->email }}
                            </td>

                            <td class="p-3">
                                {{ $company->phone }}
                            </td>

                            <td class="p-3">

                                @if ($company->status == 'active')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            <td class="p-3 d-flex flex-col">

                                <form method="POST" action="{{ route('companies.status', $company->id) }}">

                                    @csrf

                                    @if ($company->status == 'active')
                                        <button class="bg-red-500 text-white px-3 py-1 rounded">

                                            Deactivate

                                        </button>
                                    @else
                                        <button class="bg-green-500 text-white px-3 py-1 rounded">

                                            Activate

                                        </button>
                                    @endif

                                </form>
                                <a href="{{ route('companies.edit', $company->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded mt-2 inline-block">

                                    Edit   
                                 </a>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</x-app-layout>
