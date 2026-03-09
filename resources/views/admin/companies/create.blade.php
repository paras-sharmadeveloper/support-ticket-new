<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">
                Add Company
            </h2>

            <form method="POST" action="{{ route('companies.store') }}">

                @csrf

                <!-- Company Info -->

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Company Name</label>
                    <input type="text" name="company_name" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Company Email</label>
                    <input type="email" name="company_email" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Phone</label>
                    <input type="text" name="phone" class="border rounded w-full p-2">
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-semibold">Status</label>

                    <select name="status" class="border rounded w-full p-2">

                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>

                    </select>

                </div>

                <hr class="my-6">

                <h3 class="font-bold mb-4 text-center">
                    Company Admin
                </h3>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Admin Name</label>
                    <input type="text" name="admin_name" class="border rounded w-full p-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Admin Email</label>
                    <input type="email" name="admin_email" class="border rounded w-full p-2">
                </div>

                <div class="mb-6">
                    <label class="block mb-1 font-semibold">Password</label>
                    <input type="password" name="password" class="border rounded w-full p-2">
                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full">

                    Create Company

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
