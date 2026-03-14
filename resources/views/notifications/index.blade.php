<x-app-layout>

    <div class="max-w-4xl mx-auto mt-10">

        <div class="bg-white shadow rounded p-6">

            <h2 class="text-xl font-bold mb-6">

                Notifications

            </h2>

            @forelse($notifications as $notification)
                <div class="border-b p-4 flex justify-between">

                    <div>

                        <a href="{{ $notification->data['url'] }}" class="text-blue-600">

                            {{ $notification->data['message'] }}

                        </a>

                    </div>

                    <small class="text-gray-500">

                        {{ $notification->created_at->diffForHumans() }}

                    </small>

                </div>

            @empty

                <p>No notifications</p>
            @endforelse

        </div>

    </div>

</x-app-layout>
