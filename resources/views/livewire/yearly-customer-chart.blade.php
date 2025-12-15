<div
    class="rounded-xl shadow-sm border p-4"
    style="background-color: var(--gray-900); border-color: var(--gray-700);"
>
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-gray-100">
            Customers in {{ $year }}
        </h2>
    </div>

    <div class="relative h-72">
        <canvas id="yearlyCustomerChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', initYearlyCustomerChart);
    document.addEventListener('livewire:navigated', initYearlyCustomerChart);

    let yearlyCustomerChart;

    function cssVar(name) {
        return getComputedStyle(document.documentElement)
            .getPropertyValue(name)
            .trim();
    }

    function initYearlyCustomerChart() {
        const ctx = document.getElementById('yearlyCustomerChart');
        if (!ctx) return;

        if (yearlyCustomerChart) {
            yearlyCustomerChart.destroy();
        }

        const gray300 = cssVar('--gray-300');
        const gray700 = cssVar('--gray-700');
        const indigo = '#6366f1';

        yearlyCustomerChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @js($labels),
                datasets: [{
                    label: 'Customers',
                    data: @js($data),
                    borderColor: indigo,
                    backgroundColor: indigo + '33',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                `${ctx.raw} customers`
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: gray300 },
                        grid: { display: false }
                    },
                    y: {
                        ticks: {
                            color: gray300,
                            precision: 0
                        },
                        grid: {
                            color: gray700
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
