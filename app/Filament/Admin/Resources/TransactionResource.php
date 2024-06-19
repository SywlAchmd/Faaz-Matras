<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Filament\Admin\Resources\TransactionResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\Layout;

class TransactionResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'phosphor-receipt';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Riwayat Transaksi';
    protected static ?string $pluralModelLabel = 'Riwayat Transaksi';



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->formatStateUsing(fn ($state) => $state->format('d M Y H:i'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('order_type')
                    ->label('Keterangan')
                    ->formatStateUsing(function ($record) {
                        if($record->order_type == 'dine_in') {
                            return 'Meja ' . $record->table_number;
                        } else {
                            return 'Take Away';
                        }
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gross_amount')
                    ->label('Total')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                    ->searchable(),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
            ->filters([
                Filter::make('created_at')
                    ->form([DatePicker::make('date')])
                    ->query(function (Builder $query, array $data): Builder {
                        if (! $data['date']) {
                            return $query;
                        }
                
                        return $query->whereDate('created_at', Carbon::parse($data['date']));
                    })
                    ->indicateUsing(function (array $data): ?string {
                        if (! $data['date']) {
                            return null;
                        }
                
                        return 'Created at ' . Carbon::parse($data['date'])->toFormattedDateString();
                    })
                ])
                ->actions([
                    // 
                ])
                ->bulkActions([
                    // 
                ])
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed'));
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
            'index' => Pages\ListTransactions::route('/'),
            // 'create' => Pages\CreateTransaction::route('/create'),
            // 'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
