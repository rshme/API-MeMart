<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        \App\Models\User::factory(20)->create();
        $this->call(ProfileSeeder::class);
        $this->call(ParentCompletnessSeeder::class);
        $this->call(ParentIncomeSeeder::class);
        $this->call(OtherCriteriaSeeder::class);
        $this->call(ClassroomSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(ProfitSeeder::class);
    }
}
