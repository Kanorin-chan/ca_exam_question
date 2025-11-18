<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Investors') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-end mb-4">
                <a href="{{ route('investors.create') }}"
                   class="px-4 py-2 bg-blue-600 text-black rounded shadow">
                    + Create Investor
                </a>
            </div>

            <form method="GET" action="{{ route('investors.index') }}" class="mb-4">
                <div class="flex gap-2 items-center pb-2">

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search investor..."
                        class="border px-3 py-2 rounded w-64">

                    <button class="bg-blue-600 text-black px-4 py-2 rounded">
                        Search
                    </button>

                    @if(request('search'))
                    <a href="{{ route('investors.index') }}"
                       class="ml-2 text-red-500 underline">
                        Clear
                    </a>
                    @endif

                </div>
            </form>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left border">
                    <thead>
                        <tr class="border-b bg-gray-100">
                            <th class="p-3">ID</th>
                            <th class="p-3">Name</th>
                            <th class="p-3">Email</th>
                            <th class="p-3">Contact</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($investors as $inv)
                        <tr class="border-b">
                            <td class="p-3">{{ $inv->id }}</td>
                            <td class="p-3">{{ $inv->name }}</td>
                            <td class="p-3">{{ $inv->email }}</td>
                            <td class="p-3">{{ $inv->contact_number }}</td>
                            <td class="p-3">
                                <a href="{{ route('investors.edit', $inv->id) }}"
                                   class="text-blue-600 hover:underline">
                                   Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $investors->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
