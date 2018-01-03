<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Category::class, 3)->create()->each(function ($cateParent) {
            factory(App\Models\Category::class, 2)->create([
                'parent_id' => $cateParent->id,
            ]);
        });
    }
}
