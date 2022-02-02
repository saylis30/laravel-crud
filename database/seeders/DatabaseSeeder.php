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
        //To create dummy users data
        #\App\Models\User::factory(5)->create();

        // To create status table records
        $statusData = [['status' => 'Active'], ['status' => 'Inactive']];
        foreach($statusData as $status){
            \App\Models\Status::create($status);
        }
    }
}
