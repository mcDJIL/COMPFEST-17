<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mealPlans = MealPlan::orderBy('created_at')
        ->get();

        return response()->json([
            'status' => true,
            'message' => 'Meal Plans successfully retrieved.',
            'data' => $mealPlans
        ], 200);
    }
}
