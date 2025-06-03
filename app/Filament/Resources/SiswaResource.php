<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;


use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use App\Imports\SiswaImport;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required()->maxLength(100),
                TextInput::make('nis')->required()->unique(ignoreRecord: true),
                Select::make('gender')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                Textarea::make('alamat')->required(),
                TextInput::make('kontak')
                    ->required()
                    ->maxLength(20)
                    ->beforeStateDehydrated(function ($state, $set) {
                        if (str_starts_with($state, '08')) {
                            $set('kontak', '+62' . substr($state, 1));
                        }
                        return $state;
                    }),
                TextInput::make('email')->required()->email(),
                Select::make('status_pkl')
                    ->options([
                        'True' => 'True',
                        'False' => 'False',
                    ])
                    ->default('False')
                    ->required(),
                FileUpload::make('foto')
                    ->image()
                    ->directory('fotosiswa')
                    ->visibility('public')
                    ->imagePreviewHeight('150')
                    ->loadingIndicatorPosition('left')
                    ->uploadProgressIndicatorPosition('left')
                    ->removeUploadedFileButtonPosition('right')
                    ->downloadable()
                    ->openable()
                    ->required(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('gender')
                    ->label('Jenis Kelamin')
                    ->sortable(),

                Tables\Columns\TextColumn::make('kontak'),

                Tables\Columns\TextColumn::make('email'),

                Tables\Columns\BadgeColumn::make('status_pkl')
                    ->label('Status PKL')
                    ->colors([
                        'warning' => 'True',
                        'success' => 'False',
                    ])
                    ->sortable(),

                Tables\Columns\ImageColumn::make('foto')
                    ->disk('public')
                    ->height(50)
                    ->circular()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
    ->action(function ($records, $data) {
        $pklStudentNames = [];
        $deletedCount = 0;
        
        foreach ($records as $record) {
            // Check if student has PKL records
            if ($record->pkl) {
                $pklStudentNames[] = $record->nama;
                // Skip deletion for students with PKL records
                continue;
            }
            
            // Delete associated user
            $user = User::where('email', $record->email)
                ->first();
                
            if ($user) {
                $user->delete();
            }
            
            // Delete the student record
            $record->delete();
            $deletedCount++;
        }
        
        if (count($pklStudentNames) > 0) {
            \Filament\Notifications\Notification::make()
                ->title("$deletedCount siswa berhasil dihapus")
                ->body('Siswa berikut tidak dapat dihapus karena memiliki data PKL: ' . implode(', ', $pklStudentNames))
                ->warning()
                ->send();
        } else {
            \Filament\Notifications\Notification::make()
                ->title("Berhasil menghapus $deletedCount siswa")
                ->success()
                ->send();
        }
    }),
                ])
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
                        Excel::import(new SiswaImport, $filePath);
                        \Illuminate\Support\Facades\Storage::delete($data['file']);
                        \Filament\Notifications\Notification::make()
                            ->title('Data siswa berhasil diimpor!')
                            ->success()
                            ->send();
                    })
                    ->label('Import CSV'),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
