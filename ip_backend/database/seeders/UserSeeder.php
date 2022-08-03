<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Exception;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            ['name' => 'John Doe', 'login_name' => 'administrator', 'email'=>'john@gmail.com'],
            ['name' => 'Jane Doe', 'login_name' => 'jane2', 'email'=>'jane@gmail.com'],
        ];

        foreach ($users as $key => $value) {
            try{       
                $user = User::create([
                    'name' => $value['name'],
                    'username' => $value['login_name'],
                    'email' => $value['email'],
                    'password' => bcrypt('admin1234'),
                ]);
            }catch(Exception $e) {
                dump($e);
                dump('New user: '. $value['login_name']);
            }   
        }
    }

}
