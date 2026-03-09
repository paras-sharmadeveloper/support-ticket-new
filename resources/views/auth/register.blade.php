<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Company Name -->
        <div>
            <x-input-label for="company_name" :value="__('Company Name')" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" required />
        </div>

        <!-- Plan -->
        <div class="mt-4">
            <x-input-label for="plan_id" :value="__('Select Plan')" />

            <select name="plan_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">
                        {{ $plan->name }} (${{ $plan->price }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required />
        </div>

        <div class="flex items-center justify-end mt-4">

            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>
