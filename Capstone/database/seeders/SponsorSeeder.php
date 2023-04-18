<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'Commission on Higher Education'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'CHED State'],
            ['name' => 'CHED Half Merit'],
            ['name' => 'CHED Tulong Dunong'],
            ['name' => 'CHED Partial'],
            ['name' => 'CHED TDP-TES'],
            ['name' => 'CHED TAP'],
            ['name' => 'CHED Tertiary Education Subsidy'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'Cagayan Electric Power & Light Company (CEPALCO)'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'Cagayan Electric Power & Light Company (CEPALCO) Scholarship Program'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'City Scholarship'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'City College Scholarship Program (CCSP)'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'Department of Science & Technology (DOST)'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'Department of Science & Technology (DOST) Scholarship Program'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'Development Bank of the Philippines-Resource for Inclusive Sustainable Educatiom (DBP RISE)'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'Development Bank of the Philippines-Resource for Inclusive Sustainable Educatiom (DBP RISE) Scholarship Program'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'ARCU Scholarship'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'Sanghimig Chorale'],
            ['name' => 'Circulo de Entablado'],
        ]);

        $sponsor = Sponsor::firstOrCreate([
            'sponsor' => 'NSTP-ROTC Scholarship'
        ]);
        $sponsor->scholarship_programs()->createMany([
            ['name' => 'Marching Band'],
            ['name' => 'ROTC Officer'],
        ]);


    }
}
