<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PklResource\Pages;
use App\Filament\Resources\PklResource\RelationManagers;
use App\Models\Pkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class PklResource extends Resource
{
    protected static ?string $model = Pkl::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('siswa_id')
                    ->label('Nama Siswa')
                    ->relationship('siswa', 'nama') //ngambil field dari tabel siswa, dropdown = field name siswa
                                                                            //model utama (pkl) punya relasi ke model siswa. relasinya App\Models\Pkl
                    ->preload()
                    ->options(function ($record)
                    { $query = \App\Models\Siswa::query ();
                    // Saat create: hanya tampilkan siswa yang belum punya PKL
                    // Saat edit: tetap tampilkan siswa yang sedang dipilih
                    if ($record) {
                        $query->where(function ($q) use ($record) {
                            $q->doesntHave('pkl')
                            ->orWhere('id', $record->siswa_id);
                        });
                    } else {
                        $query->doesntHave('pkl');
                    }

                    return $query->pluck('nama', 'id');
                    })
                    ->required()
                    ->disabledOn('edit'),

                Select::make('industri_id')
                    ->label('Nama Industri')
                    ->relationship('industri', 'nama') //mengambil field name dari tabel industri, dropdown = field name industri 
                    ->preload()
                    ->required(),

                Select::make('guru_id')
                    ->label('Guru Pembimbing')
                    ->relationship('guru', 'nama')
                    ->required(),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->maxDate(now()->addYears(5)) // input maks tanggal hari ini sampai 5 tahun dari hari ini
                    ->required(),

                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->maxDate(now()->addYears(5)) // input maks tanggal hari ini sampai 5 tahun dari hari ini
                    ->after('tanggal_mulai') //tanggal selesai adalah setelah tanggal mulai
                    ->required(),

                Select::make('status_pkl')
                    ->label('Status PKL')
                    ->options([
                        'berlangsung' => 'Berlangsung',
                         'selesai' => 'Selesai'])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('siswa.nama')->label('Siswa')->sortable(),
                TextColumn::make('industri.nama')->label('Industri')->sortable(),
                TextColumn::make('guru.nama_guru')->label('Guru')->sortable(),
                TextColumn::make('tanggal_mulai')->date(),
                TextColumn::make('tanggal_selesai')->date(),
                TextColumn::make('status_pkl')->badge(),
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
            'index' => Pages\ListPkls::route('/'),
            'create' => Pages\CreatePkl::route('/create'),
            'edit' => Pages\EditPkl::route('/{record}/edit'),
        ];
    }
}
