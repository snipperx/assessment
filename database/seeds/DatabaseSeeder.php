<?php

use Illuminate\Database\Seeder;
use App\User;
use App\persons;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        //insert default user
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        $user->isAdmin = 0; // 0 for admin && 1 for normal user
        $user->status = 1;
        $user->save();

        $persons = new persons();
        $persons->first_name = 'Admin';
        $persons->surname = 'Senator';
        $persons->email = 'admin@admin.com';
        $persons->status = 1;
        $persons->isAdmin = 0; // 0 for admin && 1 for normal user
        $user->addPerson($persons);

        $user = new User;
        $user->name = 'Optimise Prime';
        $user->email = 'prime@gmail.com';
        $user->password = bcrypt('secret');
        $user->status = 1;
        $user->isAdmin = 1; // 0 for admin && 1 for normal user
        $user->save();

        $persons = new persons();
        $persons->first_name = 'Optimise ';
        $persons->surname = 'Prime';
        $persons->email = 'prime@gmail.com';
        $persons->status = 1;
        $persons->isAdmin = 1; // 0 for admin && 1 for normal user
        $user->addPerson($persons);

    }
}
