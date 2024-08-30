<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')->schema([
                    TextInput::make('name')->required(),

                TextInput::make('email')->email()->required(),

                TextInput::make('password')->password()->required()->hiddenOn('edit'),
                ]),

                Section::make('Role')->schema([
                    Select::make('role')->options([
                        'admin' => 'Admin',
                        'customer' => 'Customer',
                        'vendor' => 'Vendor',
                    ])->required(),

                    ]),
                Section::make('Profile')->schema([
                    FileUpload::make('image')
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('email')->searchable()->sortable(),
                TextColumn::make('role'),
                TextColumn::make('created_at')->dateTime()->sortable()->label('Joined At')->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('role')->options(
                    ['admin' => 'Admin', 'customer' => 'Customer', 'vendor' => 'Vendor']
                )->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
