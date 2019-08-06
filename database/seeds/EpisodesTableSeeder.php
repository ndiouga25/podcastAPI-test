<?php

use Illuminate\Database\Seeder;
Use App\Episode;

class EpisodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Let's truncate our existing records to start from scratch.
        Episode::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Episode::create([
                'url' => $faker->url,
                'title' => $faker->text,
                'description' => $faker->text(200),
                'numepisode' => $faker->numberBetween(0,100),
                'datecreate' => $faker->dateTime(),
                'dateupdate' => $faker->dateTime(),
            ]);
        }
    }

}
