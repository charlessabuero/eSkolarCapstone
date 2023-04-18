<?php

namespace App\Filament\AcademicWidgets\Academic;

use App\Filament\Resources\AcademicResource;
use App\Models\Academic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Item extends Component
{
    public $year;
    public $semester;
    public $semesterTitle;
    public function render()
    {
        return view('filament.widgets.academic.item');
    }
    public function mount()
    {
        $academic = Academic::currentYear()->first();
        $this->year = $academic ? ((Carbon::parse($academic->year->year)->year) .' - '. (Carbon::parse($academic->year->year)->addYear()->year)) : 'No Semester';
        $this->semester = $academic->semester->semester ?? '';
        $this->semesterTitle = $academic ? 'Sem' : 'Found';
    }
    public function openAcademic() {
        return Redirect::to(config('filament.path').'/'.AcademicResource::getSlug());
    }
}
