<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Fund') }}
        </h2>
    </x-slot>

    <div class="py-8 max-w-lg mx-auto bg-white shadow p-6 rounded">
        <form action="{{ route('fund.store') }}" method="POST">
            @csrf

            <label class="block mb-1">Fund Name</label>
            <input name="name" class="border px-3 py-2 w-full rounded mb-4" required>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">Create</button>
        </form>
    </div>
</x-app-layout>
