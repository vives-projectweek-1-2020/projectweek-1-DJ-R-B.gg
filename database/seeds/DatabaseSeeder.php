<?php

use Illuminate\Database\Seeder;
use IssueSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([IssueSeeder::class,
        ]);
        // $this->call(UserSeeder::class);
    }
}
