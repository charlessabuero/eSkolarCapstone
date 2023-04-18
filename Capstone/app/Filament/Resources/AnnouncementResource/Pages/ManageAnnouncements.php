<?php

namespace App\Filament\Resources\AnnouncementResource\Pages;

use App\Filament\Resources\AnnouncementResource;
use App\Models\Program;
use App\Models\Requirement;
use App\Models\Role;
use App\Models\Scholar;
use App\Models\ScholarshipOrganization;
use App\Models\ScholarshipProgram;
use App\Models\User;
use App\Services\SMSService;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Closure;

class ManageAnnouncements extends ManageRecords
{
    protected static string $resource = AnnouncementResource::class;
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->hidden(User::checkScholar(auth()->id()))
                ->steps([
                    Step::make('Announcement')
                        ->schema([
                            TextInput::make('title')
                                ->required(),
                            RichEditor::make('body')
                                ->required(),
                        ]),
                    Step::make('Recipients')
                        ->schema([
                            Section::make('Filter by Scholarship')
                                ->schema([
                                    Select::make('sponsors')
                                        ->label('Sponsor')
                                        ->placeholder('All')
                                        ->options(Cache::get('sponsors')->pluck('sponsor','id'))
                                        ->multiple(),
                                    Select::make('scholarship_organizations')
                                        ->label('Scholarship Organization')
                                        ->multiple(fn () => !auth()->user()->role_id === Cache::get('role:Organization')->id)
                                        ->placeholder('All')
                                        ->options(function ($get) {
                                            $user = auth()->user();
                                            // if($user->role_id === Role::firstWhere('role', 'Organization')->id){
                                            //     ScholarshipOrganization::where('')->pluck('name','id');
                                            // }
                                            return $get('sponsors') ?
                                                ScholarshipOrganization::whereRelation('sponsors', function (Builder $query) use ($get) {
                                                    return $query->whereIn('sponsor_id', $get('sponsors'));
                                                })->pluck('name', 'id') : ScholarshipOrganization::pluck('name', 'id');
                                        }),
                                    Select::make('scholarship_programs')
                                        ->label('Scholarship Program')
                                        ->placeholder('All')
                                        ->options(fn ($get) => ScholarshipProgram::whereIn('sponsor_id', $get('sponsors'))->pluck('name', 'id'))
                                        ->multiple(),
                                ]),
                            Section::make('Filter by Curriculum')
                                ->schema([
                                    Select::make('colleges')
                                        ->label('College')
                                        ->placeholder('All')
                                        ->options(Cache::get('colleges')->pluck('name','id'))
                                        ->multiple(),
                                    Select::make('programs')
                                        ->label('Program')
                                        ->placeholder('All')
                                        ->options(fn ($get) => $get('colleges') ? Cache::get('programs')->whereIn('college_id', $get('colleges'))->pluck('name', 'id') : Cache::get('programs')->pluck('name','id'))
                                        ->multiple(),
                                ]),
                            Section::make('Filter by Scholar')
                                ->schema([
                                    Select::make('baranggays')
                                        ->label('Barangay')
                                        ->placeholder('All')
                                        ->options(Cache::get('baranggays')->pluck('name',"id"))
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
                    $users_query = User::with(['scholarship_program', 'program', 'baranggay'])->whereHas('scholar');
                    // Check if there is scholarship programs
                    $users_query = $data['scholarship_programs'] ? $users_query->{'whereRelation'}('scholarship_program', 'scholarship_programs.id', $data['scholarship_programs']) : $users_query;
                    // Check if there is scholarship organization
                    $users_query = $data['scholarship_organizations'] ? $users_query->{'whereRelation'}('scholarship_organization', 'scholarship_organizations.id', $data['scholarship_organizations']) : $users_query;

                    // Check if there is programs
                    $users_query = $data['programs'] ? $users_query->{'whereRelation'}('program', 'programs.id', $data['programs']) : $users_query;
                    // Check if there is baranggay
                    $users_query = $data['baranggays'] ? $users_query->{'whereRelation'}('baranggay', 'baranggays.id', $data['baranggay']) : $users_query;
                    // Check if there is status
                    $users_query = $data['status'] ? $users_query->{'whereRelation'}('scholar', 'scholars.status', $data['status']) : $users_query;

                    $announcement = static::getModel()::create($data);

                    foreach ($data['requirements'] ?? [] as $value) {
                        $requirement = new Requirement();
                        $requirement->description = $value['description'];
                        $requirement->filetypes = $value['filetypes'];
                        $requirement->announcement_id = $announcement->id;
                        $requirement->save();
                        $requirement->users()->saveMany($users_query->get());
                    }
                    Notification::make()
                        ->title($data['title'])
                        ->body($data['body'])
                        ->actions([
                            Action::make('view')
                                ->button()
                                ->url(
                                    url: route('filament.resources.announcements.view', $announcement)
                                )
                        ])
                        ->sendToDatabase($users_query->get());
                    $announcement->recipients()->saveMany($users_query->get());

                    return $announcement;
                })
        ];
    }
}
