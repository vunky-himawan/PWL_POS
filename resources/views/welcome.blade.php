@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title font-weight-bold">Dashboard</h1>
        </div>
        <div class="card-body">

            {{-- Card --}}
            <div class="row bg-light py-3 justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="card bg-light border border-primary">
                        <div class="card-header">
                            <h5 class="font-weight-bold text-md">Total Transaksi {{ $year }}</h5>
                        </div>
                        <div class="card-body py-4">
                            <div>
                                <h1 class="font-weight-bold d-inline text-lg">{{ $totalTransaction }}</h1>
                                <small>Transaksi</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border border-success ">
                        <div class="card-header">
                            <h5 class="font-weight-bold text-md">Jumlah Pendapatan {{ $year }}</h5>
                        </div>
                        <div class="card-body py-4">
                            <h1 class="font-weight-bold text-lg">Rp. {{ number_format($revenue, 2, ',', '.') }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-light border border-dark">
                        <div class="card-header">
                            <h5 class="font-weight-bold text-md">Total Pengeluaran {{ $year }}</h5>
                        </div>
                        <div class="card-body py-4">
                            <h4 class="font-weight-bold text-lg">Rp. {{ number_format($expense, 2, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chart --}}
            <div class="row mt-3">
                <div id="chart" class="card col bg-light p-md-3">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Pendapatan dan Pengeluaran tahun {{ $year }}</h5>
                    </div>
                    <div class="card-body overflow-auto">
                        <div class="chart-container">
                            <canvas id="financialSummary"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 col-lg-3 bg-light ml-md-3 p-3" style="height: 36rem">
                    <div class="card-header border-0">
                        <h5 class="font-weight-bold">Transaksi Terakhir</h5>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table table-unbordered table-striped">
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>
                                            <div>
                                                <h5 class="font-weight-bold text-md">{{ $transaction->pembeli }}</h5>
                                                <small>{{ DateTime::createFromFormat('Y-m-d H:i:s', $transaction->penjualan_tanggal)->format('Y-m-d') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div>

                                                <h5 class="font-weight-bold text-md">Rp.
                                                    {{ number_format($transaction->total_harga, 2, ',', '.') }}</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Chart --}}
            <div class="row mt-3">
                <div id="popular-products-chart-container" class="card col bg-light p-3">
                    <div class="card-header">
                        <h5 class="font-weight-bold">Produk Terlaris bulan {{ $month }}</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="popularProducts"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        #chart,
        #popular-products-chart-container,
        {
        height: 30rem
        }

        .chart-container {
            height: 30rem;
            width: 30rem;
        }


        @media (min-width: 768px) {

            #chart,
            #popular-products-chart-container {
                height: 36rem
            }

            .chart-container {
                height: 100%;
                width: auto;
            }
        }
    </style>
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('financialSummary');

        const expenses = @json($expenses);
        const expenses_array = Object.keys(expenses).map(key => expenses[key]);

        const incomes = @json($incomes);
        const incomes_array = Object.keys(incomes).map(key => incomes[key]);

        const minY = Math.min(Math.min(...incomes_array), Math.min(...expenses_array));
        const maxY = Math.max(Math.max(...incomes_array), Math.max(...expenses_array));

        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        let financialSummary = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                        label: 'Pendapatan',
                        data: incomes_array,
                        borderWidth: 5,
                        fill: false,
                        pointRadius: 10,
                        pointBorderColor: 'rgba(13, 110, 253, 0.5)',
                        pointBackgroundColor: 'rgba(13, 110, 253, 0.5)',
                        borderColor: 'rgba(13, 110, 253, 0.2)',
                    },
                    {
                        label: "Pengeluaran",
                        data: expenses_array,
                        borderWidth: 5,
                        fill: false,
                        pointRadius: 10,
                        pointBorderColor: 'rgba(220, 53, 69, 0.5)',
                        pointBackgroundColor: 'rgba(220, 53, 69, 0.5)',
                        borderColor: 'rgba(220, 53, 69, 0.3)',
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                tension: 0.2,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            suggestedMin: minY - 100000,
                            suggestedMax: maxY + 1000000,
                            callback: function(value, index, values) {
                                let formatedValue = value.toLocaleString('id-ID', {
                                    'style': 'currency',
                                    'currency': 'IDR'
                                });
                                return formatedValue.substring(0, 7) + ' jt';
                            }
                        },
                    },
                },
            },
        });
    </script>

    <script>
        const ctx2 = document.getElementById('popularProducts');

        const product_labels = @json($popularProducts);
        const product_array = Object.keys(product_labels).map(key => product_labels[key]);

        let popularProducts = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: product_array[0],
                datasets: [{
                    label: 'Terjual',
                    data: product_array[1],
                    borderWidth: 5,
                    fill: false,
                    backgroundColor: 'rgba(13, 110, 253, 0.5)',
                    hoverBackgroundColor: 'rgba(13, 110, 253, 0.7)',
                    borderColor: 'rgba(13, 110, 253, 0.2)',
                }, ]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                tension: 0.3,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                },
            },
        });
    </script>
@endpush
