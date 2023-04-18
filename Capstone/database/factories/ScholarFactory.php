<?php

namespace Database\Factories;

use App\Models\Baranggay;
use App\Models\Program;
use App\Models\Role;
use App\Models\ScholarshipProgram;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Scholar>
 */
class ScholarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fname = fake()->firstName();
        $lname = fake()->lastName();
        $name = $fname . ' ' . $lname;
        $user = User::factory()->create(['name' => $name]);
        DB::table('model_has_roles')->insert([
            'role_id' => Role::firstWhere('name','Scholar')->id,
            'model_id' => $user->id,
            'model_type' => User::class
        ]);

        return [
            'id' => (Carbon::create(fake()->numberBetween(2016, 2020))->year) . fake()->bothify('######'),
            'fname' => $fname,
            'lname' => $lname,
            'user_id' => $user,
            'baranggay_id' => Baranggay::inRandomOrder()->first(),
            'status' => fake()->numberBetween(1, 4),
            'scholarship_program_id' => ScholarshipProgram::inRandomOrder()->first(),
            'program_id' => Program::inRandomOrder()->first()
        ];
    }
}
