<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDay;
use App\Models\MealPlan;
use App\Models\MealType;
use App\Models\Subscription;
use App\Models\SubscriptionDeliveryDay;
use App\Models\SubscriptionMealType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'plan_selection' => 'required|exists:meal_plans,name|in:Diet Plan,Protein Plan,Royal Plan',
            'meal_types' => 'required|array',
            'meal_types.*.' => 'exists:meal_types,name',
            'delivery_days' => 'required|array',
            'delivery_days.*.' => 'exists:delivery_days,name',
            'allergies' => 'nullable',
            'total_price' => 'required|integer'
        ]);

        if ($validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $user = Auth::user();

        $mealPlan = MealPlan::where('name', $request->plan_selection)
        ->first();

        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(30);

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'meal_plan_id' => $mealPlan->id,
            'allergies' => $request->allergies,
            'total_price' => $request->total_price,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => 'active'
        ]);

        foreach ($request->meal_types as $mealType) {
            $meal = MealType::where('name', $mealType)
            ->first();

            SubscriptionMealType::create([
                'subscription_id' => $subscription->id,
                'meal_type_id' => $meal->id
            ]);
        }

        foreach ($request->delivery_days as $deliveryDay) {
            $delivery = DeliveryDay::where('name', $deliveryDay)
            ->first();

            SubscriptionDeliveryDay::create([
                'subscription_id' => $subscription->id,
                'delivery_day_id' => $delivery->id
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Successful meal plan subscription.',
            'data' => $subscription
        ], 201);
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

    public function getTotalSubscriptions()
    {
        $happyCustomers = Subscription::count();

        return response()->json([
            'status' => true,
            'message' => 'Total subscriptions successfully retrieved.',
            'data' => $happyCustomers
        ], 200);
    }
}
