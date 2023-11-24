<?php

namespace App\Http\Controllers;

use App\Models\seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SeatController extends Controller
{
    public function remainingSeats(){ 
        try {   
            // Count the number of available seats that are not booked
            $seatLeft = seat::where('is_booked', 0)->count();

            // Return a JSON response with success status, message, and data (remaining seats count)
            return response()->json([
                'success' => true,
                'message' => 'Seats retrieved successfully',
                'data' => $seatLeft,
            ], 200);
        } catch (\Exception $e) {
            // Return a JSON response with failure status, error message, and details if an exception occurs
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving seats',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function allSeats(){
        try {

            $allSeats = seat::all();
            // Return a JSON response with success status, message, and data (all seats information {})
            return response()->json([
                'success'=> true,
                'message'=> 'All Seats retrived',
                'data' => $allSeats
            ],200);

        } catch(\Exception $e){
            // Return a JSON response with failure status, error message, and details if an exception occurs
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving all seats',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function seatBooking(Request $request){
        try{
            // no of seats received from the frontend in POST request
            $ids = $this->getSeats($request->input('noOfSeat'));

            // if we pass the customer id else default value is 1
            $customerId = $request->input('customer_id') ?? 1; 

            $booking = seat::whereIn('seat_id',$ids)->update(['is_booked'=>1,'booked_by'=>$customerId]);

            if($booking){
                $seatId = seat::select('seat_id','seat_number','row_number','coach_id')->whereIn('seat_id',$ids)->get();
                // Return a JSON response with success status, message, and data (all booked seats information {seat_number, row_number, coach_id})
                return response()->json([
                    'success'=> true,
                    'message'=> 'Seats Booked Successfully',
                    'data'=> $seatId
                ],200);
            }else{ 
                // Return a JSON response with failure status, error message and data
                return response()->json([
                    'success'=> false,
                    'message'=> 'Please try again',
                    'data'=> $booking
                ],200);
            }
        }catch(\Exception $e){
            // Return a JSON response with failure status, error message, and details if an exception occurs
            return response()->json([
                'success' => false,
                'message' => 'Error during booking',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * this function get the seat ids which is not booked yet
     */
    private function getSeats($no_of_seats){
        try {
            $seatId = seat::select('seat_id')->where('is_booked',0)->limit($no_of_seats)->get();
            if($seatId->isEmpty()){
                return response()->json([
                    'success' => false,
                    'message' => 'Seats are not available',
                    'data' => $seatId,
                ], 204);
            }else{
                return $seatId;
            }
        } catch(\Exception $e){
            // Return a JSON response with failure status, error message, and details if an exception occurs
            return response()->json([
                'success'=> false,
                'message'=> 'Error during booking',
                'error' => $e->getMessage(),
            ],500);
        }
    }
}
