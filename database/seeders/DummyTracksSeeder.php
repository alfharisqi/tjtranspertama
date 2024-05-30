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
            [ 'from_route' => 'Medan', 'to_route' => 'Siantar', 'travel_time' => '02:30' ],
            [ 'from_route' => 'Jakarta', 'to_route' => 'Bandung', 'travel_time' => '03:15' ],
            [ 'from_route' => 'Surabaya', 'to_route' => 'Malang', 'travel_time' => '02:00' ],
            [ 'from_route' => 'Yogyakarta', 'to_route' => 'Semarang', 'travel_time' => '01:45' ],
            [ 'from_route' => 'Denpasar', 'to_route' => 'Mataram', 'travel_time' => '04:00' ],
            ];

            foreach($trackData as $key => $val){
                Track::create($val);
            }
    }
}