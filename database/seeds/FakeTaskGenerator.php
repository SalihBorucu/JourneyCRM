<?php

use Illuminate\Database\Seeder;

class FakeTaskGenerator extends Seeder
{

    public function run()
    {

        foreach (range(1, 20000) as $index) {

            // factory(App\Task::class, 1)->create([
            //  'description' => 'Email',
            //  'notes' => 'ajsdhf',
            //  'lead_id' => 1,
            //      ]);

            DB::table('tasks')->insert([
                'description' => 'Social Media 1',
                'lead_id' => $index,
                'outcome' => 0,
                'notes' => '',

            ]);

        }
    }
}
