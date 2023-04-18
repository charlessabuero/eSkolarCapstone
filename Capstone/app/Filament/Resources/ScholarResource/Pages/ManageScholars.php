<?php

namespace App\Filament\Resources\ScholarResource\Pages;

use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use App\Filament\Resources\ScholarResource;
use App\Models\Baranggay;
use App\Models\Program;
use App\Models\Requirement;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\Scholar;
use App\Models\ScholarshipProgram;
use App\Models\User;
use Carbon\Carbon;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Hash;
use Konnco\FilamentImport\Actions\ImportAction;
use Konnco\FilamentImport\Actions\ImportField;
use Ysfkaya\FilamentPhoneInput\PhoneInput;
use Illuminate\Support\Str;

class ManageScholars extends ManageRecords
{
    protected static string $resource = ScholarResource::class;

    protected function getTableHeaderActions(): array
    {
        return [
            FilamentExportHeaderAction::make('export')
                ->button()
                ->disablePreview()
        ];
    }
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function ($data) {
                    $user = User::create([
                        'avatar_url' => 'pngtree-blue-default-avatar-png-image_2813123.jpg',
                        'email' => $data['email'],
                        'name' => $data['fname'] . ' ' . $data['lname'],
                        'password' => Hash::make(Carbon::now()->year . '-' . $data['lname']),
                        'contact_number' => $data['contact_number']
                    ]);
                    $scholar_role = Role::firstWhere('name', 'Scholar');

                    RoleUser::insert([
                        'model_type' => User::class,
                        'model_id' => $user->id,
                        'role_id' => $scholar_role->id
                    ]);
                    $scholar = Scholar::create([
                        'scholar_id' => $data['scholar_id'],
                        'fname' => $data['fname'],
                        'lname' => $data['lname'],
                        'status' => 3,
                        'user_id' => $user->id,
                        'baranggay_id' => $data['baranggay_id'],
                        'program_id' => $data['program_id'],
                        'scholarship_program_id' => $data['scholarship_program_id'],
                    ]);
                    return $scholar;
                })
                ->steps([
                    Step::make('Scholar Information')
                        ->schema([
                            Section::make('Personal Details')
                                ->schema([
                                    Group::make([
                                        TextInput::make('fname')
                                            ->label('First Name')
                                            ->required(),
                                        TextInput::make('lname')
                                            ->label('Last Name')
                                            ->required(),

                                        TextInput::make('email')
                                            ->label('Email')
                                            ->unique(User::class, 'email')
                                            ->email()
                                            ->required(),
                                        PhoneInput::make('contact_number')
                                            ->required()
                                            ->initialCountry('ph')
                                            ->disallowDropdown()
                                            ->separateDialCode(true),
                                    ])->columns(2),
                                    Select::make('baranggay_id')
                                        ->relationship('baranggay', 'name')
                                        ->required()
                                        ->label('Barangay'),
                                ]),

                        ]),
                    Step::make('Curriculum Details')
                        ->schema([
                            Section::make('Curriculum Details')
                                ->schema([
                                    TextInput::make('scholar_id')
                                        ->required()
                                        ->label('ID #'),
                                    Select::make('program_id')
                                        ->relationship('program', 'name')
                                        ->required()
                                ]),
                        ]),
                    Step::make('Scholarship Program')
                        ->schema([
                            Section::make('Scholarship Program')
                                ->schema([
                                    Select::make('scholarship_program_id')
                                        ->relationship('scholarship_program', 'name')
                                        ->label('Scholarship Program')
                                        ->required()
                                ])
                        ])
                ]),
            ImportAction::make()

                ->uniqueField('id')
                ->mutateBeforeCreate(function ($data) {
                    $data['name'] = $data['lname'] . ', ' . $data['fname'];
                    $data['status'] = 3;
                    $data['role_id'] = Role::firstWhere('role', 'Scholar')->id;
                    $data['password'] = Hash::make($data['fname'] . '-' . $data['lname']);
                    $user = User::create($data);
                    $data['user_id'] = $user->id;
                    return $data;
                })
                ->fields([
                    ImportField::make('id')
                        ->label('ID #')
                        ->required(),
                    ImportField::make('fname')
                        ->label('First Name')
                        ->required(),
                    ImportField::make('lname')
                        ->label('Last Name')
                        ->required(),
                    ImportField::make('email')
                        ->label('Email')
                        ->required(),
                    ImportField::make('contact_number')
                        ->label('Contact Number')
                        ->required(),
                    ImportField::make('program_id')
                        ->mutateBeforeCreate(function ($data) {

                            return Program::firstWhere('abbre', 'LIKE', '%' . Str::lower($data) .  '%')->id;
                        })
                        ->label('Course')
                        ->required(),
                    ImportField::make('scholarship_program_id')
                        ->mutateBeforeCreate(function ($data) {
                            return ScholarshipProgram::firstWhere('name', $data)->id;
                        })
                        ->label('Scholarship Program')
                        ->required(),

                    ImportField::make('baranggay_id')
                        ->mutateBeforeCreate(function ($data) {
                            return Baranggay::firstWhere('name', $data)->id;
                        })
                        ->label('Barangay'),
                    ImportField::make('year')
                        ->label('Year Level'),
                ], 3),
        ];
    }
}
