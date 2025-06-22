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
    public function index(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $query = Subscription::with(['user:id,name', 'mealPlan:id,name']);

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $subscriptions = $query->get();

        return response()->json([
            'status' => true,
            'message' => 'Get data subscriptions successfully.',
            'data' => $subscriptions
        ], 200);
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

        if ($validator->fails()) {
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

    public function pauseSubscription(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        if (!$validator->fails())
        {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data' => null
            ], 422);
        }

        $user = Auth::user();

        $subscription = Subscription::where('user_id', $user->id)->where('id', $id)->first();

        if (!$subscription) {
            return response()->json([
                'status' => false, 
                'message' => 'Subscription not found.'
            ], 404);
        }

        $subscription->status = 'pause';
        $subscription->pause_start = $request->start_date;
        $subscription->pause_end = $request->end_date;
        $subscription->save();

        return response()->json([
            'status' => true,
            'message' => 'Subscription successfully paused.',
            'data' => null,
        ], 201);
    }

    public function continueSubscription($id)
    {
        $user = Auth::user();

        $subscription = Subscription::where('user_id', $user->id)->where('id', $id)->first();

        if (!$subscription) {
            return response()->json([
                'status' => false, 
                'message' => 'Subscription not found.'
            ], 404);
        }

        $subscription->status = 'active';
        $subscription->pause_start = null;
        $subscription->pause_end = null;
        $subscription->save();

        return response()->json([
            'status' => true,
            'message' => 'Subscription continued.',
            'data' => null,
        ], 201);
    }

    public function cancelSubscription($id)
    {
        $user = Auth::user();

        $subscription = Subscription::where('user_id', $user->id)
            ->where('id', $id)
            ->first();

        if (!$subscription) {
            return response()->json([
                'status' => false, 
                'message' => 'Subscription not found.'
            ], 404);
        }

        $subscription->status = 'cancel';
        $subscription->save();

        return response()->json([
            'status' => true,
            'message' => 'Successfully updated the subscription status to cancel.',
            'data' => null
        ], 201);
    }

    public function getActiveSubscription()
    {
        $user = Auth::user();

        $subscription = Subscription::with(['user', 'mealPlan', 'mealTypes', 'deliveryDays'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['active', 'pause'])
            ->first();

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => "You don't have an active subscription yet. Let's start a subscription now!",
                'data' => null
            ], 404);
        }

        $activeSubscription = [
            'id' => $subscription->id,
            'name' => $subscription->user->name,
            'plan_name' => $subscription->mealPlan->name,
            'total_price' => $subscription->total_price,
            'start_date' => $subscription->start_date,
            'end_date' => $subscription->end_date,
            'status' => $subscription->status,
            'mealTypes' => $subscription->mealTypes->map(function ($mealType) {
                return ['name' => $mealType->name];
            }),
            'deliveryDays' => $subscription->deliveryDays->map(function ($deliveryDay) {
                return ['name' => $deliveryDay->name];
            }),
        ];

        return response()->json([
            'status' => true,
            'message' => 'Successfully retrieve active subscription.',
            'data' => $activeSubscription,
        ], 200);
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
