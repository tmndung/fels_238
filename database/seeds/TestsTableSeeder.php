<?php

use Illuminate\Database\Seeder;

class TestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Test::class, 10)->create()->each(function ($test) {
            $test->questions()->saveMany(
                factory(App\Models\Question::class, $test->time)->create([
                    'test_id' => $test->id,
                ])->each(function ($question) {
                    $question->answers()->saveMany(
                        factory(App\Models\Answer::class, $question->number_of_answer - 1)->create([
                            'question_id' => $question->id,
                        ])
                    );
                    $question->answers()->saveMany(
                        factory(App\Models\Answer::class, 1)->create([
                            'question_id' => $question->id,
                            'is_correct' => true,
                        ])
                    );
                })
            );
        });
    }
}
