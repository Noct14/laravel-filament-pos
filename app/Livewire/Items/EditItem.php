<?php

namespace App\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
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
                            ->prefix('IDR')
                            ->numeric(),
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
