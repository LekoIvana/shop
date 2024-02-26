<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gender1 = new Gender();
        $gender1->name="Muškarci";
        $gender1->save();

        $gender2 = new Gender();
        $gender2->name="Žene";
        $gender2->save();

        $gender3 = new Gender();
        $gender3->name="Djeca";
        $gender3->save();
    }
}
