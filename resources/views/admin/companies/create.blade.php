<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">

                {{ isset($company) ? 'Edit Company' : 'Add Company' }}

            </h2>

            <form method="POST"
                action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}">

                @csrf

                @if (isset($company))
                    @method('PUT')
                @endif

                <!-- Company Info -->

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Company Name</label>

                    <input type="text" name="company_name" value="{{ old('company_name', $company->name ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Company Email</label>

                    <input type="email" name="company_email" value="{{ old('company_email', $company->email ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Phone</label>

                    <input type="text" name="phone" value="{{ old('phone', $company->phone ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">Status</label>

                    <select name="status" class="border rounded w-full p-2">

                        <option value="active"
                            {{ old('status', $company->status ?? '') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="inactive"
                            {{ old('status', $company->status ?? '') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>

                <hr class="my-6">

                <h3 class="font-bold mb-4 text-center">

                    Company Admin

                </h3>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Admin Name</label>

                    <input type="text" name="admin_name" value="{{ old('admin_name', $admin->name ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Admin Email</label>

                    <input type="email" name="admin_email" value="{{ old('admin_email', $admin->email ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">Password</label>

                    <input type="password" name="password" class="border rounded w-full p-2">

                    @if (isset($company))
                        <small class="text-gray-500">
                            Leave blank if you don't want to change password
                        </small>
                    @endif

                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full">

                    {{ isset($company) ? 'Update Company' : 'Create Company' }}

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
