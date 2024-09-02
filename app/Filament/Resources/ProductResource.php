<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Category;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Product Information')->schema([
                    TextInput::make('name')->required()->live(debounce:500)->afterStateUpdated(function ( $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                    MarkdownEditor::make('description')->required(),
                    FileUpload::make('image')->image()->required(),
                    TextInput::make('price')->required(),
                   Hidden::make('user_id')->default(auth()->id()),
                    TextInput::make('stock')->required(),
                    TextInput::make('slug')->required()->readOnly()->unique(ignoreRecord:true),
                    Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->required()->searchable(),
                    CheckboxList::make('tags')
                        ->label('Tags')
                        ->relationship(titleAttribute: 'name')
                        ->required(),
                ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('price')->money('INR'),

                TextColumn::make('user.name'),
                TextColumn::make('description'),
                ImageColumn::make('image'),
                TextColumn::make('category.name')->searchable()->sortable()->label('Category'),
                TextColumn::make('tags.name')->searchable()->label('Tags')->limit(30),
            ])
            ->filters([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
