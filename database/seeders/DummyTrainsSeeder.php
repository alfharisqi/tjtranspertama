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
            ['name' => 'Sonic Train', 'class' => 'BISNIS'],
            ['name' => 'Surya Kencana', 'class' => 'BISNIS'],
            ['name' => 'Surya Kencana', 'class' => 'EKSEKUTIF'],
            ['name' => 'Surya Kencana', 'class' => 'VIP'],
            ['name' => 'Sribilah Jaya', 'class' => 'EKONOMI'],
            ['name' => 'Sribilah Jaya', 'class' => 'EKSEKUTIF'],
            ['name' => 'Fast Train', 'class' => 'EKSEKUTIF'],
            ['name' => 'Speed Train', 'class' => 'EKONOMI'],
        ];

            foreach($TrainData as $key => $val){
                Train::create($val);
            }
    }
}