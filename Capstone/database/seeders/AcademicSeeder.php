<?php

namespace Database\Seeders;

use App\Models\Academic;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::create(2022);
        $semester = 'First';
        $start = Carbon::create(2022, 9, 2);
        $end = Carbon::create(2023, 1, 25);

        Academic::createAcademic(year: $date, semester: $semester, start: $start, end: $end, default: true);

        $semester = 'Second';
        $start = Carbon::create(2023, 2, 6);
        $end = Carbon::create(2023, 6, 21);

        Academic::createAcademic(year: $date, semester: $semester, start: $start, end: $end);

        $semester = 'Mid-Year';
        $start = Carbon::create(2023, 7, 3);
        $end = Carbon::create(2023, 8, 12);

        Academic::createAcademic(year: $date, semester: $semester, start: $start, end: $end);
    }
}
