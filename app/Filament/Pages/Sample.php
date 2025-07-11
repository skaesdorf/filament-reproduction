<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Pages\Page;

class Sample extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.test';

    public ?array $data = [];

    public function mount () : void
    {
        $this->form->fill();
    }

    public function form ( Form $form ) : Form
    {
        return $form
            ->statePath( 'data' )
            ->schema( [
                Select::make( 'datepicker_state' )
                    ->native( false )
                    ->options( [
                        0 => 'Disabled',
                        1 => 'Enabled',
                    ] )
                    ->default( 0 )
                    ->live(),
                DatePicker::make( 'datepicker' )
                    ->native( false )
                    ->placeholder('I will not work after being enabled')
                    ->disabled( function ( Get $get )
                    {
                        return !$get( 'datepicker_state' );
                    } ),
            ] );
    }
}
