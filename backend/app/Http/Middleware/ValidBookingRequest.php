<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidBookingRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the number of seats from the request
        $seats = $request->input('noOfSeat');

        // Validate the number of seats
        if ($seats <= 0 || $seats > 7) {
            return response()->json([
                'success'=> false,
                'message' => 'Invalid number of seats',
                'error' => 'Invalid number of seats'
            ], 400);
        }

        return $next($request);
    }
}
