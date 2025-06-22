<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function totalRevenue()
    {
        $subscriptions = Subscription::get();

        $totalRevenue = $subscriptions->sum('total_price');

        $thisMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $totalRevenueThisMonth = Subscription::whereMonth('start_date', $thisMonth)
            ->sum('total_price');
        $totalRevenueLastMonth = Subscription::whereMonth('start_date', $lastMonth)
            ->sum('total_price');

        if ($totalRevenueLastMonth != 0) {
            $growth = ($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth * 100;
        } else {
            $growth = 0;
        }

        $data = [
            'total_revenue' => $totalRevenue,
            'growth' => $growth
        ];

        return response()->json([
            'status' => true,
            'message' => 'Get data sucessfully.',
            'data' => $data
        ], 200);
    }

    public function activeSubscriptionsRevenue()
    {
        $activeSubscriptions = Subscription::where('status', 'active')
            ->get();

        $totalRevenue = $activeSubscriptions->sum('total_price');

        $thisMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $totalRevenueThisMonth = Subscription::whereMonth('start_date', $thisMonth)
            ->sum('total_price');
        $totalRevenueLastMonth = Subscription::whereMonth('start_date', $lastMonth)
            ->sum('total_price');

        if ($totalRevenueLastMonth != 0) {
            $growth = ($totalRevenueThisMonth - $totalRevenueLastMonth) / $totalRevenueLastMonth * 100;
        } else {
            $growth = 0;
        }

        $data = [
            'total_revenue' => $totalRevenue,
            'growth' => $growth
        ];

        return response()->json([
            'status' => true,
            'message' => 'Get data sucessfully.',
            'data' => $data
        ], 200);
    }

    public function activeSubscriptions()
    {
        $activeSubscriptions = Subscription::where('status', 'active')
            ->get();

        $totalActiveSubs = $activeSubscriptions->count();

        $thisMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $totalActiveSubsThisMonth = Subscription::whereMonth('start_date', $thisMonth)
            ->count();
        $totalActiveSubsLastMonth = Subscription::whereMonth('start_date', $lastMonth)
            ->count();

        if ($totalActiveSubsLastMonth != 0) {
            $growth = ($totalActiveSubsThisMonth - $totalActiveSubsLastMonth) / $totalActiveSubsLastMonth * 100;
        } else {
            $growth = 0;
        }

        $data = [
            'total_active_subscriptions' => $totalActiveSubs,
            'growth' => $growth
        ];

        return response()->json([
            'status' => true,
            'message' => 'Get data sucessfully.',
            'data' => $data
        ], 200);
    }
}
