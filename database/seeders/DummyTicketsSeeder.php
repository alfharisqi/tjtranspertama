<?php

namespace Database\Seeders;

use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyTicketsSeeder extends Seeder
{
    /** 
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticket = [
            [   'id' => 1,
                'track_id' => '1',
                'train_id' => '1',
                'departure_time'=> '15:00',
                'arrival_time'=> '17:30'

            ]
            ];

            foreach($ticket as $key => $val){
                Ticket::create($val);
            }
    }
}