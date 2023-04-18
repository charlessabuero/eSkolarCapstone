<?php

namespace Database\Seeders;

use App\Models\Academic;
use App\Models\Announcement;
use App\Models\College;
use App\Models\Module;
use App\Models\Program;
use App\Models\Requirement;
use App\Models\Role;
use App\Models\Scholar;
use App\Models\ScholarshipOrganization;
use App\Models\ScholarshipProgram;
use App\Models\Sponsor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::insert([
            ['module' => Str::plural(Str::afterLast(Role::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Module::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Scholar::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(User::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Academic::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(College::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Program::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Announcement::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Requirement::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(ScholarshipOrganization::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(ScholarshipProgram::class,'\\')), 'default' => true],
            ['module' => Str::plural(Str::afterLast(Sponsor::class,'\\')), 'default' => true],
        ]);
    }
}
