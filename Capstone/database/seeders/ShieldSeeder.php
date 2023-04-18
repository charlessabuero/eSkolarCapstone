<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ShieldSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_academic","view_any_academic","create_academic","update_academic","restore_academic","restore_any_academic","replicate_academic","reorder_academic","delete_academic","delete_any_academic","force_delete_academic","force_delete_any_academic","view_activity","view_any_activity","create_activity","update_activity","restore_activity","restore_any_activity","replicate_activity","reorder_activity","delete_activity","delete_any_activity","force_delete_activity","force_delete_any_activity","view_announcement","view_any_announcement","create_announcement","update_announcement","restore_announcement","restore_any_announcement","replicate_announcement","reorder_announcement","delete_announcement","delete_any_announcement","force_delete_announcement","force_delete_any_announcement","view_college","view_any_college","create_college","update_college","restore_college","restore_any_college","replicate_college","reorder_college","delete_college","delete_any_college","force_delete_college","force_delete_any_college","view_program","view_any_program","create_program","update_program","restore_program","restore_any_program","replicate_program","reorder_program","delete_program","delete_any_program","force_delete_program","force_delete_any_program","view_requirement","view_any_requirement","create_requirement","update_requirement","restore_requirement","restore_any_requirement","replicate_requirement","reorder_requirement","delete_requirement","delete_any_requirement","force_delete_requirement","force_delete_any_requirement","view_scholar","view_any_scholar","create_scholar","update_scholar","restore_scholar","restore_any_scholar","replicate_scholar","reorder_scholar","delete_scholar","delete_any_scholar","force_delete_scholar","force_delete_any_scholar","view_scholarship::organization","view_any_scholarship::organization","create_scholarship::organization","update_scholarship::organization","restore_scholarship::organization","restore_any_scholarship::organization","replicate_scholarship::organization","reorder_scholarship::organization","delete_scholarship::organization","delete_any_scholarship::organization","force_delete_scholarship::organization","force_delete_any_scholarship::organization","view_scholarship::program","view_any_scholarship::program","create_scholarship::program","update_scholarship::program","restore_scholarship::program","restore_any_scholarship::program","replicate_scholarship::program","reorder_scholarship::program","delete_scholarship::program","delete_any_scholarship::program","force_delete_scholarship::program","force_delete_any_scholarship::program","view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_sponsor","view_any_sponsor","create_sponsor","update_sponsor","restore_sponsor","restore_any_sponsor","replicate_sponsor","reorder_sponsor","delete_sponsor","delete_any_sponsor","force_delete_sponsor","force_delete_any_sponsor","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","page_Profile","widget_RequirementProgress","widget_ScholarsOverview","widget_LatestAnnouncements","widget_ScholarshipProgramsOverview"]},{"name":"filament_user","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {

                $role = Role::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $role->givePermissionTo($rolePlusPermission['permissions']);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Permission::whereName($permission)->doesntExist()) {
                    Permission::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
