<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Investments') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="GET" action="{{ route('investments.index') }}" class="mb-4">
                <div class="flex flex-row gap-2 items-center pb-2 pt-4">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search by UID, investor, fund..."
                           class="border px-3 py-2 rounded w-64">

                    <button class="bg-blue-600 text-black px-4 py-2 rounded">
                        Search
                    </button>

                    @if(request('search'))
                    <a href="{{ route('investments.index') }}"
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
                            <th class="p-3">UID</th>
                            <th class="p-3">Investor</th>
                            <th class="p-3">Fund</th>
                            <th class="p-3">Capital Amount</th>
                            <th class="p-3">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($investments as $inv)
                        <tr class="border-b">
                            <td class="p-3">{{ $inv->id }}</td>
                            <td class="p-3">{{ $inv->uid }}</td>
                            <td class="p-3">{{ $inv->investor->name ?? 'N/A' }}</td>
                            <td class="p-3">{{ $inv->fund->name ?? 'N/A' }}</td>
                            <td class="p-3">RM {{ number_format($inv->capital_amount, 2) }}</td>
                            <td class="p-3">{{ ucfirst($inv->status) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $investments->withQueryString()->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
