<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::create([							//creo mi usuario
			'name'     => 'Julian Andres Vitale',
			'email'    => 'jvitale27@gmail.com',
			'password' => bcrypt('password')
    	])->assignRole('Admin');               //le asigno el rol

        User::factory(9)->create();			//creo 9 usuarios mas
    }
}
