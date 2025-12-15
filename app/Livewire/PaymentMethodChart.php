<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PaymentMethodChart extends Component
{
    public function render()
    {
        $methods = DB::table('sales')
            ->join('payment_methods', 'sales.payment_method_id', '=', 'payment_methods.id')
            ->selectRaw('payment_methods.name, COUNT(sales.id) as total')
            ->groupBy('payment_methods.name')
            ->orderByDesc('total')
            ->get();

        return view('livewire.payment-method-chart', [
            'labels' => $methods->pluck('name'),
            'data'   => $methods->pluck('total'),
        ]);
    }
}
