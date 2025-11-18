<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Graph') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <div class="flex justify-between w-full">
                        <div class="w-full">
                            <div class="flex">
                                <p class="font-bold">{{ __('Equity Over Graph Line Chart')}}</p>
                            </div>
                            <canvas id="equityChart" height="100"></canvas>
                        </div>
                    </div>

                        <x-button onclick="downloadSampleData()">
                            Download Sample Data
                        </x-button>
                    </div>

                </div>


                <div class="grid grid-cols-2 gap-4 p-6">
                    <div class="shadow-xl border p-4 rounded-lg">
                        <h1>Annual Return</h1>
                        <p>{{ number_format($annualReturn, 4) }}</p>
                    </div>
                    <div class="shadow-xl border p-4 rounded-lg">
                        <h1>Sharpe Ratio</h1>
                        <p>{{ number_format($sharpe, 4) }}</p>
                    </div>
                    <div class="shadow-xl border p-4 rounded-lg">
                        <h1>Maximum Drawdown</h1>
                        <p>{{ number_format($maxDrawdown, 4) }}</p>
                    </div>
                    <div class="shadow-xl border p-4 rounded-lg">
                        <h1>Calmar Ratio</h1>
                        <p>{{ number_format($calmar, 4) }}</p>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function downloadSampleData() {
            window.open('{{ asset("sample_data.csv") }}', "_blank")
        }

        const ctx = document.getElementById('equityChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($dates),
                datasets: [{
                    label: 'Equity Curve',
                    data: @json($values),
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 2,
                    pointRadius: 0,
                    tension: 0.2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Date' }},
                    y: { title: { display: true, text: 'Portfolio Value' }}
                }
            }
        });
    </script>

</x-app-layout>
