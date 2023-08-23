<?php

namespace App\Filament\Forms;

use Livewire\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;

class FilterForm extends Component
{
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label('Title'),

            DatePicker::make('date_start')
                ->label('Start Date'),

            DatePicker::make('date_end')
                ->label('End Date')
        ];
    }
}
