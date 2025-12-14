<?php

namespace App\Livewire\Sales;

use App\Models\Sale;
use Filament\Tables\Columns\TextColumn;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Contracts\HasTable;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Illuminate\Support\Carbon;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;


class ListSales extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithTable;
    use InteractsWithSchemas;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Sale::query()->with(['customer','saleItems']))
            ->columns([
                TextColumn::make('customer.name')
                    ->sortable(),
                TextColumn::make('saleItems.item.name')
                    ->label('Sold Items')
                    ->bulleted()
                    ->limitList(2)
                    ->expandableLimitedList(),
                TextColumn::make('total')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('discount')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('paid_amount')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                TextColumn::make('paymentMethod.name'),
                TextColumn::make('created_at')
                    ->label('Transaction Time')
                    ->dateTime('d M Y H:i')
                    ->description(fn ($record) => $record->created_at->diffForHumans())
                    ->sortable(),
            ])
            ->filters([
                Filter::make('transaction_time')
                    ->label('Transaction Time')
                    ->form([
                        DatePicker::make('from')
                            ->label('From')
                            ->native(false),
                        DatePicker::make('until')
                            ->label('To')
                            ->native(false),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($q) => $q->whereDate('created_at', '>=', $data['from'])
                            )
                            ->when(
                                $data['until'],
                                fn ($q) => $q->whereDate('created_at', '<=', $data['until'])
                            );
                    })
                    ->indicateUsing(function (array $data) {
                        if (! $data['from'] && ! $data['until']) {
                            return null;
                        }

                        return 'Transaction Time: ' .
                            ($data['from'] ?? 'Any') .
                            ' → ' .
                            ($data['until'] ?? 'Any');
                    }),

                Filter::make('today')
                    ->label('Today')
                    ->query(fn ($query) =>
                        $query->whereDate('created_at', today())
                    ),


                Filter::make('this_month')
                    ->label('This Month')
                    ->query(fn ($query) =>
                        $query->whereBetween('created_at', [
                            now()->startOfMonth(),
                            now()->endOfMonth(),
                        ])
                    ),
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                Action::make('delete')
                    ->requiresConfirmation()
                    ->color('danger')
                    ->action(fn (Sale $record) => $record->delete())
                    ->successNotification(
                        Notification::make()
                            ->title('Sale Deleted successfully')
                            ->success()
                    )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.sales.list-sales');
    }
}
