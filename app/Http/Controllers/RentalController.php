<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalResource;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Car $car)
    {
        $rentals = $car->rentals;
        $user = Auth::user();

        $rentals = $rentals->filter(function ($rental) use ($user) {
            return $rental->user_id == $user->id;
        });
        return RentalResource::collection($rentals);

        // $rentals = DB::table('rentals')
        //             ->where('car_id', $car->id)
        //             ->where('user_id', Auth::user()->id)
        //             ->get();

        // return $rentals;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Car $car, Request $request)
    {
        $rental = Rental::create([
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $request->user()->id,
        ]);
        return new RentalResource($rental);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        if ($rental->user_id != Auth::user()->id) {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        return new RentalResource($rental);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rental $rental)
    {

        if ($rental->user_id != Auth::user()->id) {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $rental->update($request->all());
        return new RentalResource($rental);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {

        if ($rental->user_id != Auth::user()->id) {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $rental->delete();
        return response()->noContent();
    }
}
