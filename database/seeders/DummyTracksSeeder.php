<?php

namespace Database\Seeders;

use App\Models\Track;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyTracksSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $trackData = [
            [   'id' => 1,
                'from_route'=>'Medan',
                'to_route'=>'Siantar',
                'travel_time'=> '02:30'
            ]
            ];

            foreach($trackData as $key => $val){
                Track::create($val);
            }
    }
}