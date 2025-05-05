<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel= 'Manajemen User';

    public static function canViewAny(): bool
    {
        return Auth::user()->role=== 'admin';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('logo')
                    ->label('logo')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('name')
                    ->required(),
                Forms\Components\TextInput::make('username')
                    ->label('username')
                    ->hint('Minimum 5 characters, no spaces')
                    ->minlength(5)
                    ->unique(ignoreRecord:true)
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->label('email')
                    ->email()
                    ->unique(ignoreRecord:true)
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->label('password')
                    ->password()
                    ->required(),
                Forms\Components\Select::make('role')
                    ->label('role')
                    ->options([
                        'admin' => 'Admin',
                        'store' => 'Toko'
                    ])
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo Toko'),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name Toko'),
                Tables\Columns\TextColumn::make('username')
                    ->label('Username'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Peran'),
                Tables\Columns\TextColumn::make('create_at')
                    ->label('Tanggal Mendaftar'),  
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
