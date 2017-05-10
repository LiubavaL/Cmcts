<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $this->createUser('LuviiiLove', 'luviiilove@gmail.com', 'Elhieloelhielo', 'admin');
        $this->createUser('test', 'test@gmail.com', 'test');

       /* $faker = Faker::create('ru_RU');
        foreach (range(1,10) as $index) {
            $this->createUser($faker->name, $faker->email, 'secret');
        }*/
    }

    private function createUser($name, $email, $password, $role = 'user'){
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $userRole = Role::whereName($role)->first();
        $user->assignRole($userRole);
    }
}
