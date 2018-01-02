<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(WordListsTableSeeder::class);
        $this->call(TestsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StudiesTableSeeder::class);
    }
}
