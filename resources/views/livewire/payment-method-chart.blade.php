<div
    class="rounded-xl shadow-sm border p-4"
    style="background-color: var(--gray-900); border-color: var(--gray-700);"
>
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-semibold text-gray-100">
            Payment Method Breakdown
        </h2>
    </div>

    <div class="relative h-72">
        <canvas id="paymentMethodChart"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', initPaymentMethodChart);
    document.addEventListener('livewire:navigated', initPaymentMethodChart);

    let paymentMethodChart;

    function cssVar(name) {
        return getComputedStyle(document.documentElement)
            .getPropertyValue(name)
            .trim();
    }

    function initPaymentMethodChart() {
        const ctx = document.getElementById('paymentMethodChart');
        if (!ctx) return;

        if (paymentMethodChart) {
            paymentMethodChart.destroy();
        }

        const gray300 = cssVar('--gray-300');
        const gray700 = cssVar('--gray-700');
        const gray900 = cssVar('--gray-900');

        paymentMethodChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @js($labels),
                datasets: [{
                    data: @js($data),
                    backgroundColor: [
                        '#6366f1',
                        '#22c55e',
                        '#f59e0b',
                        '#06b6d4',
                        '#ec4899',
                    ],
                    borderColor: gray900,
                    borderWidth: 3,
                    spacing: 6,
                    borderRadius: 8,
                    hoverOffset: 14,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: gray300,
                            padding: 14,
                            usePointStyle: true,
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx =>
                                `${ctx.label}: ${ctx.raw} transactions`
                        }
                    }
                }
            }
        });
    }
</script>
