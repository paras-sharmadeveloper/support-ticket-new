<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">
                Email Configuration
            </h2>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('email.settings.store') }}">

                @csrf

                <div class="mb-4">
                    <label>SMTP Host</label>
                    <input type="text" name="host" value="{{ $setting->host ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>SMTP Port</label>
                    <input type="text" name="port" value="{{ $setting->port ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>Email Username</label>
                    <input type="text" name="username" value="{{ $setting->username ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>Email Password</label>
                    <input type="password" name="password" value="{{ $setting->password ?? '' }}" class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">

                    <label>Encryption</label>

                    <select name="encryption" class="border w-full p-2 rounded">

                        <option value="">None</option>

                        <option value="ssl" {{ isset($setting) && $setting->encryption == 'ssl' ? 'selected' : '' }}>
                            SSL
                        </option>

                        <option value="tls" {{ isset($setting) && $setting->encryption == 'tls' ? 'selected' : '' }}>
                            TLS
                        </option>

                    </select>

                </div>

                <div class="mb-4">
                    <label>From Email</label>
                    <input type="text" name="from_address" value="{{ $setting->from_address ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-6">
                    <label>From Name</label>
                    <input type="text" name="from_name" value="{{ $setting->from_name ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <h3 class="font-bold mt-6 mb-3">Incoming Mail (IMAP)</h3>

                <div class="mb-4">
                    <label>IMAP Host</label>
                    <input type="text" name="imap_host" value="{{ $setting->imap_host ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>IMAP Port</label>
                    <input type="text" name="imap_port" value="{{ $setting->imap_port ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>Email Username</label>
                    <input type="text" name="imap_username" value="{{ $setting->imap_username ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <div class="mb-4">
                    <label>Email Password</label>
                    <input type="password" name="imap_password" value="{{ $setting->imap_password ?? '' }}"
                        class="border w-full p-2 rounded">
                </div>

                <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                    Save Settings
                </button>

            </form>

            <hr class="my-6">

            <h3 class="font-bold mb-3">
                Send Test Email
            </h3>

            <form method="POST" action="{{ route('email.settings.test') }}">

                @csrf

                <input type="email" name="email" placeholder="Enter email to test"
                    class="border w-full p-2 rounded mb-3">

                <button class="bg-green-600 text-white px-4 py-2 rounded w-full">
                    Send Test Email
                </button>

            </form>

        </div>

    </div>

</x-app-layout>
