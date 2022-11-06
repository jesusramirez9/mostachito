<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        user::create(
            [
            'name'=>'Jesus ramirez garcia',
            'email'=>'jesus.ramirez9@unmsm.edu.pe',
            'password'=>bcrypt('1234')
            ],

        );

        User::factory(1)->create();
    }
}
