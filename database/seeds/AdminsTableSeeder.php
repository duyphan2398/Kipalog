<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            ['name'=>'Admin1',
            'email' =>'admin1@gmail.com',
            'password' => Hash::make('123456a')
            ],
            ['name'=>'Admin2',
                'email' =>'admin2@gmail.com',
                'password' => Hash::make('123456a')
            ],
            ['name'=>'Admin3',
                'email' =>'admin3@gmail.com',
                'password' => Hash::make('123456a')
            ]
        ]);
    }
}
