<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const ALLOWED_ENVIRONMENTS = [
        'local',
        'testing'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (in_array(app()->environment(), self::ALLOWED_ENVIRONMENTS)) {
            $this->call(BooksSeeder::class);
            $this->call(UsersSeeder::class);
        }
    }
}
