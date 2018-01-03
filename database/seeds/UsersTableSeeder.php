<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 1)->create([
            'name' => 'admin',
            'password' => 'admin',
            'email' => 'admin@gmail.com',
            'is_admin' => true,
        ]);

        factory(App\Models\User::class, 10)->create()->each(function ($user) {
            $user->follows()->saveMany(
                factory(App\Models\Follow::class, 1)->create([
                    'user_id' => $user->id,
                    'user_follow_id' => App\Models\User::where('id', '<>', $user->id)->get()->random()->id,
                ])
            );
        });
    }
}
