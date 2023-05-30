<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Mitra;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $table->string('name');
        //     $table->string('email')->unique();
        //     $table->string('password');
        $data['name'] = 'Nanda';
        $data['email'] = 'nanda@gmail.com';
        $data['password'] = bcrypt('123123');

        User::create($data);
        $mdata['name'] = 'Eka';
        $mdata['email'] = 'eka@gmail.com';
        $mdata['password'] = bcrypt('123123');

        Mitra::create($mdata);
        $data['name'] = 'Suci';
        $data['email'] = 'suci@gmail.com';
        $data['password'] = bcrypt('123123');

        User::create($data);
        $mdata['name'] = 'Ramadan';
        $mdata['email'] = 'ramadan@gmail.com';
        $mdata['password'] = bcrypt('123123');

        Mitra::create($mdata);

    }
}
