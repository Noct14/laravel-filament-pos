<div
    class="rounded-xl shadow-sm border p-4"
    style="background-color: var(--gray-900); border-color: var(--gray-700);"
>
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-gray-100">
            Sales Trend
        </h2>
    </div>

    <div class="relative h-72">
        <canvas id="salesTrendChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', initSalesChart);
    document.addEventListener('livewire:navigated', initSalesChart);

    let salesChart;

    function cssVar(name) {
        return getComputedStyle(document.documentElement)
            .getPropertyValue(name)
            .trim();
    }

    function initSalesChart() {
        const ctx = document.getElementById('salesTrendChart');
        if (!ctx) return;

        if (salesChart) {
            salesChart.destroy();
        }

        const gray300 = cssVar('--gray-300');
        const gray700 = cssVar('--gray-700');
        const indigo = '#6366f1';

        salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @js($labels),
                datasets: [{
                    label: 'Total Sales',
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
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                'Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: gray300 },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: gray300,
                            callback: value =>
                                'Rp ' + value.toLocaleString('id-ID')
                        },
                        grid: {
                            color: gray700
                        }
                    }
                }
            }
        });
    }
</script>
