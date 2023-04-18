<?php

namespace App\Console\Commands;

use App\Models\Role;
use Illuminate\Console\Command;

class DatabaseSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        Role::create(
            ['role' => 'Deactivated', 'default' => true],
            ['role' => 'Admin', 'default' => true],
            ['role' => 'Staff', 'default' => true],
            ['role' => 'Scholar', 'default' => true],
            ['role' => 'Organization', 'default' => true],
        );
        return Command::SUCCESS;
    }
}
