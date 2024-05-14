<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CarResource::collection(Car::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        if (Auth::user()->is_admin != true)
        {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $car = Car::create($request->all());
        return new CarResource($car);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return new CarResource($car);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {

        if (Auth::user()->is_admin != true)
        {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $car->update($request->all());
        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {

        if (Auth::user()->is_admin != true)
        {
            return response()->json([
               'message' => 'You are not authorized to perform this action'
            ], 403);
        }

        $car->delete();
        return response()->noContent();
    }
}
