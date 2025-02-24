<?php

namespace App\Filament\Resources;


use DateTime;
use KelasIdSelect;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Kelas;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Departement;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use App\Forms\Components\DepartmentIdSelect;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\UserResource\Pages;
use App\Forms\Components\ProgramStageIdSelect;
use phpDocumentor\Reflection\DocBlock\Tags\Since;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Split as ComponentsSplit;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Forms\Components\ClasspitIdSelect;
use App\Forms\Components\KelasSantriIdSelect;
use App\Models\KelasSantri;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard\Step;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Data Santri')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->completedIcon('heroicon-m-clipboard-document-check')
                    ->columns(4)
                    ->schema([
                        Section::make()
                            ->description('Santri Information')
                            ->schema([
                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])->schema([
                                    ToggleButtons::make('gender')
                                        ->inline()
                                        ->columnSpanFull()
                                        ->grouped()
                                        ->options([
                                            'pria' => 'Laki-laki',
                                            'wanita' => 'Perempuan',
                                        ])
                                        ->icons([
                                            'pria' => 'heroicon-o-user',
                                            'wanita' => 'heroicon-o-user-circle',
                                        ])

                                        ->colors([
                                            'pria' => 'primary',
                                            'wanita' => 'primary',
                                        ]),
                                    TextInput::make('name')
                                        ->placeholder('Enter your Name')
                                        ->reactive()
                                        ->required()
                                        ->prefixIcon('heroicon-o-user')
                                        ->prefixIconColor('primary'),
                                    TextInput::make('email')
                                        ->email()
                                        ->reactive()
                                        ->required()
                                        ->placeholder('Enter your Active Email')
                                        ->prefixIcon('heroicon-o-envelope')
                                        ->prefixIconColor('primary'),
                                    TextInput::make('password')
                                        ->placeholder('Password')
                                        ->password()
                                        ->required()
                                        ->prefixIcon('heroicon-o-lock-closed')
                                        ->prefixIconColor('primary'),
                                    TextInput::make('phone')
                                        ->placeholder('Enter your active WA number')
                                        ->tel()
                                        ->prefixIcon('heroicon-o-phone')
                                        ->prefixIconColor('primary'),
                                ]),



                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([

                                        TextInput::make('nisn')
                                            ->numeric()
                                            ->columnSpan(1)
                                            ->placeholder('Masukan No NISN sekolah mu')
                                            ->label('NISN')
                                            ->prefixIcon('heroicon-o-credit-card')
                                            ->prefixIconColor('primary'),
                                        TextInput::make('no_ktp')
                                            ->numeric()
                                            ->columnSpan(1)
                                            ->placeholder('Masukan No NIK KTP')
                                            ->label('NIK')
                                            ->prefixIcon('heroicon-o-credit-card')
                                            ->prefixIconColor('primary'),


                                        DatePicker::make('date_of_birth')
                                            ->date()
                                            ->placeholder('Enter your birth date')
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-cake')
                                            ->prefixIconColor('primary'),
                                        Select::make('role')
                                            ->placeholder('Pilih role kamu')
                                            ->options([
                                                'Admin' => 'Admin',
                                                'Santri' => 'Santri',
                                                'Mentor' => 'Mentor',
                                                'Leader' => 'Leader',
                                            ])
                                            ->prefixIcon('heroicon-o-tag')
                                            ->prefixIconColor('primary'),

                                    ]),

                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([
                                        TextInput::make('generation')
                                            ->numeric()
                                            ->placeholder('Which generation are you in?')
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->prefixIconColor('primary'),

                                        KelassantriIdSelect::make('kelas_id'),
                                        DepartmentIdSelect::make('department_id'),
                                        ProgramStageIdSelect::make('program_stage_id'),

                                    ]),

                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([
                                        Select::make('status_graduate')
                                            ->native(false)
                                            ->options([
                                                'Lulus' => 'Lulus',
                                                'Belum Lulus' => 'Belum Lulus',
                                                'Dropout' => 'Dropout',

                                            ])
                                            ->prefixIcon('heroicon-o-academic-cap')
                                            ->prefixIconColor('primary'),

                                        DatePicker::make('entry_date')
                                            ->label('Tanggal awal masuk pondok')
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-calendar-date-range')
                                            ->prefixIconColor('primary'),


                                        DatePicker::make('graduate_date')
                                            ->native(false)
                                            ->label('Tanggal akihr keluar pondok')
                                            ->prefixIcon('heroicon-o-calendar-days')
                                            ->prefixIconColor('primary'),

                                    ]),
                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([
                                        Textarea::make('address')
                                            ->columnSpan(3),
                                    ])
                            ]),
                    ]),
                Wizard\Step::make('Data Ortu Santri')
                    ->icon('heroicon-o-clipboard-document-list')
                    ->completedIcon('heroicon-m-clipboard-document-check')
                    ->columns(4)
                    ->schema([
                        Grid::make()
                            ->relationship('santri_family')
                            ->schema([
                        Section::make()
                            ->description("Santri's Family Information")
                            ->schema([
                                TextInput::make('no_kk')
                                    ->label('Nomor Kartu Keluarga')
                                    ->placeholder('Enter Family Card Number')
                                    ->prefixIcon('heroicon-o-identification')
                                    ->prefixIconColor('primary'),


                            ]),

                        Section::make()
                            ->description("Father Information")
                            ->schema([
                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([

                                        TextInput::make('father_name')
                                            ->label("Father's Name")
                                            ->placeholder('Enter Father Name')
                                            ->prefixIcon('heroicon-o-user')
                                            ->prefixIconColor('primary'),
                                        TextInput::make('father_job')
                                            ->label("Father's Job")
                                            ->placeholder('Enter Father Job')
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->prefixIconColor('primary'),
                                        DatePicker::make('father_birth')
                                            ->label("Father's Birth Date")
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-calendar')
                                            ->prefixIconColor('primary'),
                                        TextInput::make('father_phone')
                                            ->label("Father's Phone")
                                            ->placeholder('Enter Father Phone Number')
                                            ->tel()
                                            ->prefixIcon('heroicon-o-phone')
                                            ->prefixIconColor('primary'),

                                    ])
                            ]),

                        Section::make()
                            ->description("Mother Information")
                            ->schema([
                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])
                                    ->schema([
                                        TextInput::make('mother_name')
                                            ->label("Mother's Name")
                                            ->placeholder('Enter Mother Name')
                                            ->prefixIcon('heroicon-o-user')
                                            ->prefixIconColor('primary'),
                                        TextInput::make('mother_job')
                                            ->label("Mother's Job")
                                            ->placeholder('Enter Mother Job')
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->prefixIconColor('primary'),
                                        DatePicker::make('mother_birth')
                                            ->label("Mother's Birth Date")
                                            ->native(false)
                                            ->prefixIcon('heroicon-o-calendar')
                                            ->prefixIconColor('primary'),
                                        TextInput::make('mother_phone')
                                            ->label("Mother's Phone")
                                            ->placeholder('Enter Mother Phone Number')
                                            ->tel()
                                            ->prefixIcon('heroicon-o-phone')
                                            ->prefixIconColor('primary')
                                    ]),

                            ])
                        ]),
                    ]),
            ])
                // ->skippable()
                ->columnSpanFull()
                ->contained(false),


        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable() //agar bisa di sarch
                    ->icon('heroicon-m-user') //tambah icon mengguanakan heroicon
                    ->iconColor('primary') //warna dari icon tersebut
                    ->description(fn(User $record): string => "" . $record->email)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('email', $direction);
                    }),
                TextColumn::make('role')
                    ->searchable()
                    ->badge()
                    ->color(function ($record) {
                        $role = $record->role;
                        if ($role == 'admin') {
                            return 'success';
                        }
                        if ($role == 'santri') {
                            return 'rose';
                        }
                        if ($role == 'mentor') {
                            return 'sky';
                        }
                        if ($role == 'leader') {
                            return 'fuchsia';
                        }
                    }),

                TextColumn::make('department.name')
                    ->label('Amanah Departement')
                    ->icon('heroicon-o-briefcase')
                    ->iconColor('primary')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            $id = Departement::where('name', 'like', '%' . $search . '%')->first()->id ?? null;
                            if ($id) {
                                return $query->where('department_id', 'like', '%' . $id . '%');
                            }
                            return $query;
                        }
                    ),

                TextColumn::make('kelas.major')
                    ->iconColor('primary')
                    ->icon('heroicon-o-academic-cap')
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            $id = KelasSantri::where('major', 'like', '%' . $search . '%')->first()->id ?? null;
                            if ($id) {
                                return $query->where('kelas_id', 'like', '%' . $id . '%');
                            }
                            return $query;
                        }
                    ),


                TextColumn::make('entry_date')
                    ->sortable()
                    ->tooltip(function ($record) {
                        return $record->entry_date . ' -> ' . $record->graduation_date;
                    })
                    ->getStateUsing(function ($record) {
                        $tanggalMasuk = new DateTime($record->entry_date);
                        $tanggalKeluar = new DateTime($record->graduation_date);

                        $totalBulan =
                            $tanggalMasuk->diff($tanggalKeluar)->m +
                            ($tanggalKeluar->format('Y') - $tanggalMasuk->format('Y')) * 12;

                        $tahun = floor($totalBulan / 12);
                        $sisaBulan = $totalBulan % 12;

                        if ($tahun > 0) {
                            if ($sisaBulan > 0) {
                                return $tahun . ' Tahun ' . $sisaBulan . ' Bulan';
                            }
                            return $tahun . ' Tahun';
                        }

                        return $totalBulan . ' Bulan';
                    })

                    ->label('Masa Santri')
                    ->icon('heroicon-o-calendar-date-range')
                    ->iconColor('primary')
                    ->description(fn(User $record): string => "Angkatan " . $record->generation)
                    ->sortable(query: function (Builder $query, string $direction): Builder {
                        return $query->orderBy('generation', $direction);
                    }),
                TextColumn::make('created_at')
                    ->date('Y-m-d')
                    ->sortable()
                    ->label('Created At')
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                SelectFilter::make('role')
                    ->label("Role")
                    ->options([
                        'admin' => 'admin',
                        'teacher' => 'teacher',
                        'student' => 'student',
                    ]),
                SelectFilter::make('department_id')
                    ->label("Department")
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->options(Departement::all()->pluck('name', 'id')),

                // TernaryFilter::make('email_verified_at')
                //         ->nullable(),

                Filter::make('entry_and_graduation_date')
                    ->form([
                        DatePicker::make('entry_from')
                            ->label('Filter tanggal masuk dari')
                            ->native(false),
                        DatePicker::make('entry_until')
                            ->native(false)
                            ->label('sampai'),
                        DatePicker::make('graduate_from')
                            ->label('Filter tanggal lulus dari')
                            ->native(false),
                        DatePicker::make('graduate_until')
                            ->native(false)
                            ->label('sampai'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['entry_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('entry_date', '>=', $date),
                            )
                            ->when(
                                $data['entry_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('entry_date', '<=', $date),
                            )
                            ->when(
                                $data['graduate_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('graduation_date', '>=', $date),
                            )
                            ->when(
                                $data['graduate_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('graduation_date', '<=', $date),
                            );
                    })
            ])
            ->groups([
                Group::make('entry_date')
                    ->label('Masa Santri')
                    ->date()
                    ->collapsible(),
                Group::make('department.name')
                    ->label('Department')
                    ->collapsible(),

            ])

            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->tooltip('Edit'),
                    Tables\Actions\ViewAction::make()->tooltip('View'),
                    Tables\Actions\DeleteAction::make()->tooltip('Delete'),
                ])
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
