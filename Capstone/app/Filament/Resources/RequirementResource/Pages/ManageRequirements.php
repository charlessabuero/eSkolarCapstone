<?php

namespace App\Filament\Resources\RequirementResource\Pages;

use App\Filament\Resources\RequirementResource;
use App\Models\Academic;
use App\Models\Filter;
use App\Models\Program;
use App\Models\Requirement;
use App\Models\Role;
use App\Models\Scholar;
use App\Models\ScholarshipOrganization;
use App\Models\ScholarshipProgram;
use App\Models\User;
use Closure;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class ManageRequirements extends ManageRecords
{
    protected static string $resource = RequirementResource::class;

    protected function getActions(): array
    {
        $scholarship_programs = [];
        $scholarship_programs_total = [];
        foreach (DB::table('scholarship_programs')->get() as $value) {
            $scholarship_programs[$value->id] = $value->name;
            $scholarship_programs_total[$value->id] = $value->sponsor_id;
        }
        $programs = [];
        foreach (DB::table('programs')->get() as $value) {
            $programs[$value->id] = $value->name;
        }
        $colleges = [];
        foreach (DB::table('colleges')->get() as $value) {
            $colleges[$value->id] = $value->name;
        }
        $barangays = [];
        foreach (DB::table('baranggays')->get() as $value) {
            $barangays[$value->id] = $value->name;
        }
        $sponsors = [];
        foreach (DB::table('sponsors')->get() as $value) {
            $sponsors[$value->id] = $value->sponsor;
        }
        return [
            Actions\CreateAction::make()
                ->steps([
                    Step::make('Requirement')
                        ->schema([
                            TextInput::make('description')
                                ->unique()
                                ->label('Description'),
                            Select::make('filetypes')
                                ->label('File Types')
                                ->multiple()
                                ->options([
                                    'application/pdf' => 'Portable Document Format/PDF',
                                    'application/vnd.ms-powerpoint' => 'Microsoft PowerPoint',
                                    'application/vnd.ms-excel' => 'Microsoft Excel',
                                    'text/csv' => 'Comma-separated values (CSV)',
                                    'image/jpeg' => 'JPEG images',
                                    'image/png' => 'PNG images',
                                ]),
                        ]),
                    Step::make('Recipients')
                        ->schema([
                            Section::make('Filter by Scholarship')
                                ->schema([
                                    Select::make('sponsors')
                                        ->label('Sponsor')
                                        ->placeholder('All')
                                        ->options($sponsors)
                                        ->multiple(),
                                    Select::make('scholarship_organizations')
                                        ->label('Scholarship Organization')
                                        ->multiple()
                                        ->placeholder('All')
                                        ->options(function ($get) {
                                            return $get('sponsors') ?
                                                ScholarshipOrganization::whereRelation('sponsors', function (Builder $query) use ($get) {
                                                    return $query->whereIn('sponsor_id', $get('sponsors'));
                                                })->pluck('name', 'id') : ScholarshipOrganization::pluck('name', 'id');
                                        }),
                                    Select::make('scholarship_programs')
                                        ->label('Scholarship Program')
                                        ->placeholder('All')
                                        ->options(fn ($get) => $get('sponsors') ? ScholarshipProgram::whereIn('sponsor_id', $get('sponsors'))->pluck('name', 'id') : ScholarshipProgram::pluck('name', 'id'))
                                        ->multiple(),
                                ]),
                            Section::make('Filter by Curriculum')
                                ->schema([
                                    Select::make('colleges')
                                        ->label('College')
                                        ->placeholder('All')
                                        ->options($colleges)
                                        ->multiple(),
                                    Select::make('programs')
                                        ->label('Program')
                                        ->placeholder('All')
                                        ->options(fn ($get) => $get('colleges') ? Program::whereIn('college_id', $get('colleges'))->pluck('name', 'id') : $programs)
                                        ->multiple(),
                                ]),
                            Section::make('Filter by Scholar')
                                ->schema([
                                    Select::make('barangays')
                                        ->label('Barangay')
                                        ->placeholder('All')
                                        ->options($barangays)
                                        ->multiple(),
                                    Select::make('status')
                                        ->label('Scholarship Status')
                                        ->placeholder('All')
                                        ->options([
                                            '1' => 'Pending',
                                            '2' => 'Inactive',
                                            '3' => 'Active',
                                            '4' => 'Deactivated',
                                        ])
                                        ->multiple()
                                ])
                        ])
                ])
                ->using(function ($data) {
                    $data['user_id'] = auth()->user()->id;
                    $query = User::filterScholars($data);

                    $requirement = Requirement::createRequirement(
                        description: $data['description'],
                        filetypes: $data['filetypes'],
                        deadline: null,
                        academic_id: Academic::currentYear()->first()->id,
                        users: $query
                    );
                    Filter::createFilter($data, $requirement, Requirement::class);
                    return $requirement;
                })
        ];
    }
}
