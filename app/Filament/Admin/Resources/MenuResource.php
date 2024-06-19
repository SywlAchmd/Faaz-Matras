<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MenuResource\Pages;
use App\Filament\Admin\Resources\MenuResource\RelationManagers;
use App\Models\Discount;
use App\Models\Menu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'phosphor-bowl-food';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\Select::make('categories_id')
                                    ->label('Category')
                                    ->relationship('category', 'name')
                                    ->native(false)
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')
                                    ->numeric()
                                    ->visible(fn(\Filament\Forms\Get $get):bool => $get('manage_stock')),
                                Forms\Components\MarkdownEditor::make('description')
                                    ->disableAllToolbarButtons()
                                    ->required()
                                    ->columnSpan('full'),
                            ])
                            ->columns(2),

                        Forms\Components\Section::make('Image')
                            ->schema([
                                SpatieMediaLibraryFileUpload::make('image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageResizeMode('contain')
                                    ->imageCropAspectRatio('16:10')
                                    ->collection('menu-images')
                                    ->hiddenLabel()
                            ])
                            ->collapsible(),
                    ])
                    ->columnSpan(2),

                    Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Additional Information')
                            ->schema([
                                Forms\Components\Toggle::make('status')
                                    ->label('Ready')
                                    ->default(true),
                                Forms\Components\Toggle::make('manage_stock')
                                    ->label('Check Stock')
                                    ->live(),
                                Forms\Components\Select::make('discount_id')
                                    ->label('Discount')
                                    ->native(false)
                                    ->options(Discount::all()->pluck('name', 'id'))
                                    ->relationship('discount', 'name')
                                    // ->relationship('discount', 'name', fn($query) => dd($query))
                                    // ->getOptionLabelsUsing(fn($record) => $record->name . ' - ' . $record->percentage)
                                    ->multiple()
                                    // ->getOptionLabelFromRecordUsing(fn($record) => $record->name . ' - ' . $record->percentage)
                            ])
                            ->columns(1),
                    ])
                    ->columnSpan(1),
                ])
                ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('menu-images'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('discount')
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        $discountList = $record->discount->map(function ($discount) {
                            return '- ' . $discount->name;
                        })->implode('<br>');

                        return $discountList;
                    })
                    ->html(),
                    // ->formatStateUsing(fn ($record) => dd($record->discount->first())),
                    // ->formatStateUsing(fn ($state) => $state->name . ' - ' . $state->percentage),
                Tables\Columns\TextColumn::make('price')
                    ->searchable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => $state === '0' ? 'Not Ready' : 'Ready')
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'gray',
                        '1' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(60)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
