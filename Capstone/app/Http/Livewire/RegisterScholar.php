<?php

namespace App\Http\Livewire;

use App\Models\Scholar;
use Filament\Forms;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class RegisterScholar extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Group::make([
                Section::make('Personal Details')
                    ->schema([
                        Group::make([
                            TextInput::make('fname')
                                ->label('First Name')
                                ->required(),
                            TextInput::make('lname')
                                ->label('Last Name')
                                ->required(),
                            TextInput::make('email')
                                ->label('Email')
                                ->unique(User::class, 'email')
                                ->email()
                                ->required(),
                            PhoneInput::make('contact_number')
                                ->required()
                                ->initialCountry('ph')
                                ->disallowDropdown()
                                ->separateDialCode(true)
                        ])->columns(2),
                        Select::make('baranggay_id')
                            ->relationship('baranggay', 'name')
                            ->required()
                            ->label('Barangay'),
                    ]),
                Section::make('Curriculum Details')
                    ->schema([
                        Select::make('program_id')
                            ->relationship('program', 'name')
                            ->required()
                    ]),
                Section::make('Scholarship Program')
                    ->schema([
                        Select::make('scholarship_program_id')
                            ->relationship('scholarship_program', 'name')
                            ->label('Scholarship Program')
                            ->required()
                    ])
            ]),
        ];
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = Scholar::create($data);

        $this->form->model($record)->saveRelationships();
    }

    protected function getFormModel(): string
    {
        return Scholar::class;
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    public function render(): View
    {
        return view('livewire.register-scholar');
    }
}
