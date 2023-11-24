<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $row = 1;
        for ($coach = 1; $coach <= 1; $coach++) {
            for ($i = 0; $i < 80; $i++) { 
                if($i !=0 && $i % 7== 0) { 
                    $row++;
                }
    
                seat::create([
                    "seat_number"=> $i+1,
                    "row_number"=> $row,  
                    "coach_id" => $coach  
                ]);
            }
        }

        seat::where('seat_id',[1,10,25,78])->update(['is_booked'=>1,'booked_by'=> 14]);

        
    }
}
