<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuruResource\Pages;
use App\Filament\Resources\GuruResource\RelationManagers;
use App\Models\Guru;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use League\Csv\Reader;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;

class GuruResource extends Resource
{
    protected static ?string $model = Guru::class;

     protected static ?string $navigationLabel = 'Data Guru';

     protected static ?string $pluralLabel = 'Daftar Data Guru';

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama')
                    ->placeholder('Nama Guru')
                    ->required()
                    ->maxLength(255),

               Forms\Components\TextInput::make('nip')
                    ->label('NIP')
                    ->placeholder('NIP Guru')
                    ->required()
                    ->maxLength(18)
                    ->validationMessages(['unique'=> 'NIP sudah digunakan'])
                    ->rules(fn ($record) => [
                        'digits_between:1,18',
                        Rule::unique('gurus', 'nip')->ignore($record?->id),
                    ]),                

                Forms\Components\Select::make('gender')
                    ->label('Gender')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->native(false)
                    ->columnSpan(2)
                    ->required(),

                Forms\Components\TextInput::make('email')
                ->required()
                ->label('Email')
                ->placeholder('Email Guru')
                ->helperText('Gunakan format: <nama>@gurusija.com')
                ->rules(fn ($record) => [
                    'regex:/^[a-zA-Z0-9._%+-]+@gurusija\.com$/',
                    Rule::unique('gurus', 'email')->ignore($record?->id),
                ])
                ->validationMessages([
                    'regex' => 'Email harus menggunakan domain @gurusija.com dan format <nama>@gurusija.com.',
                ]),

                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat')
                    ->placeholder('Alamat Guru')
                    ->columnSpan(2)
                    ->required()
                    ->maxLength(255),

                    TextInput::make('kontak')
                    ->label('Kontak')
                    ->placeholder('Kontak Guru')
                    ->required()
                    ->maxLength(20)
                    ->tel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')->sortable()->searchable(),
                TextColumn::make('nip')->sortable(),
                TextColumn::make('gender'),
                TextColumn::make('alamat'),
                TextColumn::make('kontak'),
                TextColumn::make('email')->searchable(),
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
            ])
            ->headerActions([
                Action::make('Import CSV')
                    ->form([
                        FileUpload::make('file')
                            ->label('Pilih CSV')
                            ->acceptedFileTypes(['text/csv', 'text/plain', 'application/vnd.ms-excel'])
                            ->disk('public') // pastikan disk 'public' digunakan
                            ->directory('uploads') // simpan di folder 'storage/app/public/uploads'
                            ->required(),
                    ])
                    ->action(function (array $data) {
                        $filePath = storage_path('app/public/' . $data['file']);
                        Excel::import(new GuruImport, $filePath);
                        \Illuminate\Support\Facades\Storage::delete($data['file']);
                        \Filament\Notifications\Notification::make()
                            ->title('Data guru berhasil diimpor!')
                            ->success()
                            ->send();
                    })
                    ->label('Import CSV'),
                    ]);
    }

    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGurus::route('/'),
            'create' => Pages\CreateGuru::route('/create'),
            'edit' => Pages\EditGuru::route('/{record}/edit'),
        ];
    }
}
