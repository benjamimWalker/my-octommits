@once
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    @endpush
@endonce

@props(['data'])

<div x-data="{labels: {{ json_encode($data->pluck('date')->toArray()) }}, commits: {{ json_encode($data->pluck('commits')->toArray()) }}}"
     x-init="
        data = {
            labels: labels,
            datasets: [{
                label: 'Number of commits per day | Total of ' + commits.reduce((a, b) => a + b, 0),
                backgroundColor: 'rgb(185,202,255)',
                borderColor: 'rgb(1,102,229)',
                data: commits,
                color: 'rgb(255,255,255)'
            }]
        };

        new Chart(
            $refs.historyChart,
            {
                type: 'line',
                data: data,
                options: {
                    color: 'rgb(255,255,255)',
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            },
                            grid: {
                                color: 'rgb(77, 89, 110)'
                            },
                            title: {
                                display: true,
                                text: 'Number of commits',
                                color: 'rgb(255,255,255)'
                            }
                        },
                        x: {
                            ticks: {
                                autoSkip: true
                            },
                            borderColor: 'rgb(255,255,255)',
                            grid: {
                                color: 'rgb(77, 89, 110)'
                            },
                            title: {
                                display: true,
                                text: 'Days',
                                color: 'rgb(255,255,255)'
                            }
                        }
                    },
                     plugins: {
                        subtitle: {
                                color: 'rgb(255,255,255)'
                        },
                        legend: {
                            title: {
                                color: 'rgb(255,255,255)'
                            },
                            labels: {
                            color: 'rgb(255,255,255)',
                                font: {
                                    size: 18
                                }
                            }
                        }
                    }
                }
            }
        );
     "
>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid md:grid-cols-2 gap-6">
            <canvas id="historyChart" width="400" height="200" x-ref="historyChart" class="bg-chart-color rounded-lg text-white"></canvas>
        </div>
    </div>
</div>
