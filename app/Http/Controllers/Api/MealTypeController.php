<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MealType;
use Illuminate\Http\Request;

class MealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mealTypes = MealType::orderBy('created_at')
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Meal Types successfully retrieved.',
            'data' => $mealTypes
        ], 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
