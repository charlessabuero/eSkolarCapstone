<?php

namespace Database\Seeders;

use App\Models\ModuleRole;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ModuleRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        foreach (Module::all() as $module) {
            foreach (Role::all() as $role) {
                $value = ['role_id' => $role->id, 'module_id' => $module->id, 'level' => 0];
                if ($role->role == 'Admin') {
                    $value['level'] = 2;
                } else if ($role->role == 'Staff') {
                    if ($module->module == Str::plural('Scholar')) {
                        $value['level'] = 2;
                    }
                } else if ($role->role == 'Scholar') {
                    if ($module->module == Str::plural('Announcement'))
                        $value['level'] = 1;
                    if ($module->module == Str::plural('Requirement'))
                        $value['level'] = 1;
                } else if ($role->role == 'Organization') {
                    if ($module->module == Str::plural('Announcement'))
                        $value['level'] = 2;
                    if ($module->module == Str::plural('Scholar'))
                        $value['level'] = 1;
                }
                $data[] = $value;
            }
        }
        ModuleRole::insert($data);
    }
}
