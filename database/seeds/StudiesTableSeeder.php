<?php

use Illuminate\Database\Seeder;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Study::class, 20)->create()->each(function ($study) {
            $lessonId = App\Models\Lesson::all()->random()->id;
            $study->lessons()->attach($lessonId, [
                'is_finish' => (bool)rand(0, 1),
            ]);
        });
    }
}
