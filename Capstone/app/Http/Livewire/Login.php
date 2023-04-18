<?php

namespace App\Http\Livewire;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class Login extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use WithRateLimiting;

    public $email;
    public $password;
    public $remember = false;

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill();
    }
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('email')
                ->required(),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required(),
            Checkbox::make('remember')
                ->label(__('filament::login.fields.remember.label')),
        ];
    }
    public function submit(): ?LoginResponse
    {
        $data = $this->form->getState();

        if (!Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], $data['remember'])) {
            throw ValidationException::withMessages([
                'email' => __('filament::login.messages.failed'),
            ]);
        }
        session()->regenerate();
        return app(LoginResponse::class);
    }
    public function render()
    {
        return view('livewire.login');
    }
}
