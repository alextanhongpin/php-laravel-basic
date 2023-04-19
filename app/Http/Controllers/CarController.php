<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Requests\CreateCarRequest;
use App\Http\Resources\CarResource;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CarResource(Car::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCarRequest $request)
    {
        Car::create($request->only('make', 'model', 'year'));
        return response()->json(null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new CarResource(Car::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::findOrFail($id);
        $car->update($request->only('make', 'model', 'year'));
        return new CarResource($car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Car::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
