<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $techs = ['JS', 'PHP', 'Python'];

        foreach($techs as $tech){
            $newTech = new Technology();

            $newTech->name = $tech;
            $newTech->slug = Str::slug($tech, '-');

            $newTech->save();
        }
    }
}
