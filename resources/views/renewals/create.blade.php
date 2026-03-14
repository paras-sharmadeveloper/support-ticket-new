<x-app-layout>

    <div class="flex justify-center mt-10">

        <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-xl">

            <h2 class="text-xl font-bold mb-6 text-center">

                {{ isset($renewal) ? 'Edit Reminder' : 'Add Reminder' }}

            </h2>

            <form method="POST"
                action="{{ isset($renewal) ? route('renewals.update', $renewal->id) : route('renewals.store') }}">

                @csrf

                @if (isset($renewal))
                    @method('PUT')
                @endif

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Title</label>

                    <input type="text" name="title" value="{{ old('title', $renewal->title ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Type</label>

                    <select name="type" class="border rounded w-full p-2">

                        <option value="subscription"
                            {{ old('type', $renewal->type ?? '') == 'subscription' ? 'selected' : '' }}>
                            Subscription
                        </option>

                        <option value="warranty" {{ old('type', $renewal->type ?? '') == 'warranty' ? 'selected' : '' }}>
                            Warranty
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Start Date</label>

                    <input type="date" name="start_date" value="{{ old('start_date', $renewal->start_date ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Renewal Date</label>

                    <input type="date" name="renewal_date"
                        value="{{ old('renewal_date', $renewal->renewal_date ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Cycle</label>

                    <select name="cycle" class="border rounded w-full p-2">

                        <option value="monthly" {{ old('cycle', $renewal->cycle ?? '') == 'monthly' ? 'selected' : '' }}>
                            Monthly
                        </option>

                        <option value="yearly" {{ old('cycle', $renewal->cycle ?? '') == 'yearly' ? 'selected' : '' }}>
                            Yearly
                        </option>

                        <option value="custom" {{ old('cycle', $renewal->cycle ?? '') == 'custom' ? 'selected' : '' }}>
                            Custom
                        </option>

                    </select>

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Reminder Before (Days)</label>

                    <input type="number" name="reminder_days"
                        value="{{ old('reminder_days', $renewal->reminder_days ?? 7) }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Vendor</label>

                    <input type="text" name="vendor" value="{{ old('vendor', $renewal->vendor ?? '') }}"
                        class="border rounded w-full p-2">

                </div>

                <div class="mb-4">

                    <label class="block mb-1 font-semibold">Amount</label>

                    <input type="number" step="0.01" name="amount"
                        value="{{ old('amount', $renewal->amount ?? '') }}" class="border rounded w-full p-2">

                </div>

                <div class="mb-6">

                    <label class="block mb-1 font-semibold">Notes</label>

                    <textarea name="notes" class="border rounded w-full p-2">{{ old('notes', $renewal->notes ?? '') }}</textarea>

                </div>

                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded w-full">

                    {{ isset($renewal) ? 'Update Reminder' : 'Create Reminder' }}

                </button>

            </form>

        </div>

    </div>

</x-app-layout>
