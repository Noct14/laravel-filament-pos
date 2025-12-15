<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;
use Illuminate\Support\Carbon;

class YearlyCustomerChart extends Component
{
    public function render()
    {
        $year = now()->year;

        $rawData = Sale::query()
            ->selectRaw('MONTH(created_at) as month, COUNT(DISTINCT customer_id) as total')
            ->whereYear('created_at', $year)
            ->whereNotNull('customer_id')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $labels = [];
        $data = [];

        for ($m = 1; $m <= 12; $m++) {
            $labels[] = Carbon::create()->month($m)->format('M');
            $data[] = $rawData[$m]->total ?? 0;
        }

        return view('livewire.yearly-customer-chart', [
            'labels' => $labels,
            'data' => $data,
            'year' => $year,
        ]);
    }
}
