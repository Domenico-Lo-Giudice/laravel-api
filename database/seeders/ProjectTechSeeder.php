<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Tech;

use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $teches = Tech::all()->pluck('id');

        for($i = 1; $i < 40; $i++) {
            $project = Project::find($i);
            $project->teches()->attach($faker->randomElements($teches, 3));
        }
    }
}
