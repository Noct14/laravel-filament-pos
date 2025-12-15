<div
    class="rounded-xl shadow-sm border p-4"
    style="background-color: var(--gray-900); border-color: var(--gray-700);"
>
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-gray-100">
            Top Selling Products
        </h2>
    </div>

    <div class="relative h-72">
        <canvas id="topProductsChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', initTopProductsChart);
    document.addEventListener('livewire:navigated', initTopProductsChart);

    let topProductsChart;

    function cssVar(name) {
        return getComputedStyle(document.documentElement)
            .getPropertyValue(name)
            .trim();
    }

    function initTopProductsChart() {
        const ctx = document.getElementById('topProductsChart');
        if (!ctx) return;

        if (topProductsChart) {
            topProductsChart.destroy();
        }

        const gray300 = cssVar('--gray-300');
        const gray700 = cssVar('--gray-700');
        const indigo  = '#6366f1';

        topProductsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @js($labels),
                datasets: [{
                    label: 'Qty Sold',
                    data: @js($data),
                    backgroundColor: indigo + 'cc',
                    borderRadius: 6,
                    maxBarThickness: 36,
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
                                `${ctx.raw} items sold`
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
                            precision: 0
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
