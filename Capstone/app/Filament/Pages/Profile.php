<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Facades\Filament;
use Filament\Forms\Components\FileUpload;
use App\Models\User;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Hash;
use RyanChandler\FilamentProfile\Pages\Profile as BaseProfile;
use Ysfkaya\FilamentPhoneInput\PhoneInput;

class Profile extends BaseProfile
{
    protected static string $view = 'filament.pages.profile';

    public $avatar_url;
    public $contact_number;
    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'contact_number' => auth()->user()->contact_number,
            'avatar_url' => auth()->user()->avatar_url
        ]);
    }
    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    FileUpload::make('avatar_url')
                        ->hint('<span class="text-sm font-medium leading-4 text-gray-700 dark:text-gray-300">Avatar
                                    <sup class="font-medium text-danger-700 dark:text-danger-400">*</sup></span>')
                        ->avatar(),
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->required(),
                    PhoneInput::make('contact_number')
                        ->initialCountry('ph')
                        ->disallowDropdown()
                        ->separateDialCode(true),
                ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }

    public function submit()
    {
        $this->form->getState();

        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
            'contact_number' => $this->contact_number,
            'avatar_url' => array_values($this->avatar_url)[0],
        ]);
        $user = auth()->user();

        $user->update($state);

        if ($this->new_password) {
            $this->updateSessionPassword($user);
        }

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->notify('success', 'Your profile has been updated.');
    }
    // public function submit()
    // {
    //     if ($this->edittable) {
    //         parent::submit();
    //         $this->edittable = false;
    //     } else {
    //         $this->edittable = true;
    //         $this->form->getState();
    //     }
    // }
}
