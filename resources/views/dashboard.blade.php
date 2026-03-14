<x-app-layout>

    <div class="p-6">

        <h2 class="text-xl font-bold mb-6">Dashboard</h2>

        <div class="grid grid-cols-3 gap-6">

            <!-- Open Tickets -->

            <a href="/tickets?status=open">

                <div class="bg-red-500 text-white p-6 rounded">

                    <h3 class="text-lg">Open Tickets</h3>

                    <p class="text-3xl font-bold">

                        {{ $openTickets }}

                    </p>

                </div>

            </a>


            <!-- Resolved Tickets -->

            <a href="/tickets?status=resolved">

                <div class="bg-green-500 text-white p-6 rounded">

                    <h3 class="text-lg">Resolved Tickets</h3>

                    <p class="text-3xl font-bold">

                        {{ $resolvedTickets }}

                    </p>

                </div>

            </a>


            <!-- My Tickets -->

            <a href="/tickets?mine=1">

                <div class="bg-blue-500 text-white p-6 rounded">

                    <h3 class="text-lg">My Created Tickets</h3>

                    <p class="text-3xl font-bold">

                        {{ $myTickets }}

                    </p>

                </div>

            </a>

            <a href="/renewals">

                <div class="bg-blue-500 text-white p-6 rounded">

                    <h3 class="text-lg">My Reminders</h3>

                    <p class="text-3xl font-bold">

                        {{ $reminders->count() }}

                    </p>

                </div>

            </a>



        </div>

    </div>

</x-app-layout>
