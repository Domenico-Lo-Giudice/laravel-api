<?php

namespace Database\Seeders;

use App\Models\Tech;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $labels = ["VUE", "React", "Tailwind", "Angular", "Bootstrap"];

        foreach($labels as $label) {
            $type = new Tech();
            $type->label = $label;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
    }
