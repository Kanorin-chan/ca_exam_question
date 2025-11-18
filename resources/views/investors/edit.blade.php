<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Investor') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form action="{{ route('investors.update', $investor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block font-medium">Name</label>
                        <input type="text" name="name"
                            value="{{ $investor->name }}"
                            class="w-full border p-2 rounded"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input type="email" name="email"
                            value="{{ $investor->email }}"
                            class="w-full border p-2 rounded"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Contact Number</label>
                        <input type="text" name="contact_number"
                            value="{{ $investor->contact_number }}"
                            class="w-full border p-2 rounded"
                            required>
                    </div>

                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-black rounded shadow">
                        Update
                    </button>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
