<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArsipResource\Pages;
use App\Filament\Resources\ArsipResource\RelationManagers;
use App\Models\Arsip;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArsipResource extends Resource
{
    protected static ?string $model = Arsip::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form

        ->schema([

            Forms\Components\Card::make()
            ->schema([

            Forms\Components\TextInput::make('nama')
            ->required(),

            Forms\Components\FileUpload::make('image')
            ->acceptedFileTypes(['image/*'])
            ->required()
            ->disk('public')
            ->directory('images'),

            ]),

            Forms\Components\Grid::make()
            ->schema([



            Forms\Components\Select::make('barang_id')
            ->label('Nama Barang')
            ->Relationship('barang', 'barang')
                ->required(),
            Forms\Components\DatePicker::make('tanggal_pengambilan')
                ->required(),
            Forms\Components\DatePicker::make('tanggal_pengembalian')
                ->required(),

            
            Forms\Components\Select::make('keterangan')
            ->label('Keterangan')
                ->options([
                    1 => 'Sudah Dikembalikan',
                    2 => 'Belum Dikembalikan',
                ])
                ->required(),
                ])
                ]);
            }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([

            Tables\Columns\TextColumn::make('nama')
            ->label('Nama Siswa')
            ->sortable()
            ->searchable(),

            Tables\Columns\TextColumn::make('barang')
                ->label('Nama Barang')
                ->sortable()
                ->searchable(),
            Tables\Columns\TextColumn::make('tanggal_pengambilan')
                ->label('Tanggal Pengambilan')
                ->sortable(),
            Tables\Columns\TextColumn::make('tanggal_pengembalian')
                ->label('Tanggal Pengembalian')
                ->sortable(),
            Tables\Columns\ImageColumn::make('image')
                ->label('Bukti Foto')
                ->disk('public') // Pastikan disk yang digunakan sesuai dengan konfigurasi
                ->url(fn ($record) => $record->image ? Storage::url($record->image) : null) // Menampilkan URL gambar
                ->sortable(),

                Tables\Columns\TextColumn::make('keterangan') // Menampilkan nilai keterangan
                    ->label('Keterangan')
                    ->getStateUsing(function ($record) {
                        return $record->keterangan == 1 ? 'Sudah Dikembalikan' : 'Belum Dikembalikan';
                    })

                
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

    public static function getTitle(): string
    {
        return 'Arsip'; 
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
            'index' => Pages\ListArsips::route('/'),
            'create' => Pages\CreateArsip::route('/create'),
            'edit' => Pages\EditArsip::route('/{record}/edit'),
        ];
    }
}
