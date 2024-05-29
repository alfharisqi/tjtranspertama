<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyTrainsSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $TrainData = [
            [   'id' => 1,
                'name'=>'Sonic Train',
                'class'=>'EKONOMI'
            ]
            ];

            foreach($TrainData as $key => $val){
                Train::create($val);
            }
    }
}