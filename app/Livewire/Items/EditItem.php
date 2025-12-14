<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use Filament\Support\RawJs;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;

use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Actions\Contracts\HasActions;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\ToggleButtons;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class EditItem extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public Item $record;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Edit The Item')
                    ->description('Update the item details as you wish!')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Item Name'),
                        TextInput::make('sku')
                            ->unique(),
                        TextInput::make('price')
                            ->prefix('Rp')
                            ->live(onBlur: false)
                            ->formatStateUsing(fn ($state) => $state ? number_format($state, 0, ',', '.') : '')
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state && is_string($state)) {
                                    $cleanValue = preg_replace('/[^\d]/', '', $state);
                                    if ($cleanValue && $cleanValue !== $state) {
                                        $formatted = number_format((int) $cleanValue, 0, ',', '.');
                                        $set('price', $formatted);
                                    }
                                }
                            })
                            ->extraAttributes([
                                'x-data' => "{ formatNum(val) { let str = val.toString(); return str.replace(/\\B(?=(\\d{3})+(?!\\d))/g, '.'); } }",
                                'x-on:input' => "let clean = \$event.target.value.replace(/[^\\d]/g, ''); if(clean) { let formatted = formatNum(parseInt(clean)); \$event.target.value = formatted; \$wire.\$set('data.price', formatted); } else { \$event.target.value = ''; \$wire.\$set('data.price', ''); }",
                                'x-on:keypress' => "if(!/[0-9]/.test(\$event.key) && !['Backspace','Delete','Tab','ArrowLeft','ArrowRight'].includes(\$event.key)) \$event.preventDefault();",
                            ])
                            ->dehydrateStateUsing(fn ($state) => (int) str_replace('.', '', $state ?? ''))
                            ->rules(['required', 'integer', 'min:0']),
                        ToggleButtons::make('status')
                            ->label('Is this item active?')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive'
                            ])
                            ->grouped()
                    ])
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);

        Notification::make()
            ->title('Item Updated')
            ->body("Item {$this->record->name} has been updated successfully")
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('livewire.items.edit-item');
    }
}
