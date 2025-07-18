<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as  BaseRegister;
use Filament\Forms\Components\TextInput;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getLogoFormComponent(),
                        $this->getNameFormComponent(),
                        $this->getUsernameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
                    ),
                ];
    }

    protected function getLogoFormComponent(): Component
    {
        return FileUpload::make('logo')
            ->label('Logo Toko')
            ->image()
            ->required();
    }

    protected function getUsernameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->hint('Minimal 5 karakter, Tidak boleh ada spasi')
            ->required()
            ->minLength(5)
            ->unique($this->getUserModel());
    }

}
