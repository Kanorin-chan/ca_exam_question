<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Investor') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">

                <form method="POST" action="{{ route('investors.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium">Name</label>
                        <input class="w-full border p-2 rounded"
                               type="text"
                               name="name"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Email</label>
                        <input class="w-full border p-2 rounded"
                               type="email"
                               name="email"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium">Contact Number</label>
                        <input class="w-full border p-2 rounded"
                               type="text"
                               name="contact_number"
                               required>
                    </div>

                    <button class="px-4 py-2 bg-blue-600 text-black rounded shadow">
                        Create
                    </button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
