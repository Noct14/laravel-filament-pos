<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sale;

class SalesTrendChart extends Component
{
    public function render()
    {
        $sales = Sale::query()
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('livewire.sales-trend-chart', [
            'labels' => $sales->pluck('date')->map(fn ($d) => \Carbon\Carbon::parse($d)->format('d M')),
            'data' => $sales->pluck('total'),
        ]);
    }
}
