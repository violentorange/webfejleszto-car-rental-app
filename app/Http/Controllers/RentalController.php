<?php

namespace App\Http\Controllers;

use App\Http\Resources\RentalResource;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Car $car)
    {
        return RentalResource::collection($car->rentals);
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
        ]);
        return new RentalResource($rental);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car, Rental $rental)
    {
        return new RentalResource($rental);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car, Rental $rental)
    {
        //
    }
}
