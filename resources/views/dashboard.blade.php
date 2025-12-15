<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        @livewire(\App\Livewire\ApplicationStats::class)

        @livewire('sales-trend-chart')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @livewire('top-products-chart')
            @livewire('payment-method-chart')
            @livewire('yearly-customer-chart')
        </div>

        <div>

            @livewire(\App\Livewire\LatestSales::class)
        </div>
    </div>
</x-layouts.app>
