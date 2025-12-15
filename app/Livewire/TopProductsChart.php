<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TopProductsChart extends Component
{
    public function render()
    {
        $products = DB::table('sales_items')
            ->join('items', 'sales_items.item_id', '=', 'items.id')
            ->selectRaw('items.name, SUM(sales_items.quantity) as total_sold')
            ->groupBy('items.name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        return view('livewire.top-products-chart', [
            'labels' => $products->pluck('name'),
            'data'   => $products->pluck('total_sold'),
        ]);
    }
}
