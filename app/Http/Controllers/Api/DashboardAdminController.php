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
            ->where('status', 'active')
            ->count();
        $totalActiveSubsLastMonth = Subscription::whereMonth('start_date', $lastMonth)
            ->where('status', 'active')
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

    public function monthlyRecurringRevenue(Request $request)
    {
        $startDate = Carbon::parse($request->query('start_date', now()->startOfYear()));
        $endDate = Carbon::parse($request->query('end_date', now()->endOfYear()));

        $subscriptions = Subscription::where('status', 'active')
            ->whereBetween('start_date', [$startDate, $endDate])
            ->get();

        $subscriptionsByMonth = $subscriptions->groupBy(function ($subscription) {
            return Carbon::parse($subscription->start_date)->format('Y-m');
        });

        $mrrData = $this->generateMonthlyRevenueData($subscriptionsByMonth, $startDate, $endDate);

        return response()->json([
            'status' => true,
            'message' => 'Monthly Recurring Revenue retrieved successfully.',
            'data' => $mrrData,
        ]);
    }

    public function subscriptionsGrowth()
    {
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();

        $subscriptionGrowth = $totalSubscriptions > 0
            ? ($activeSubscriptions / $totalSubscriptions) * 100
            : 0;

        $thisMonth = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        $totalSubsThisMonth = Subscription::whereMonth('start_date', $thisMonth)->count();
        $totalSubsLastMonth = Subscription::whereMonth('start_date', $lastMonth)->count();

        $totalActiveSubsThisMonth = Subscription::whereMonth('start_date', $thisMonth)
            ->where('status', 'active')
            ->count();
        $totalActiveSubsLastMonth = Subscription::whereMonth('start_date', $lastMonth)
            ->where('status', 'active')
            ->count();

        if ($totalActiveSubsLastMonth != 0) {
            $monthlyGrowth = ($totalActiveSubsThisMonth - $totalActiveSubsLastMonth) / $totalActiveSubsLastMonth * 100;
        } else {
            $monthlyGrowth = 0;
        }

        $monthlyDifference = $totalActiveSubsThisMonth - $totalActiveSubsLastMonth;

        $monthlyTrend = 'same';
        if ($monthlyDifference > 0) {
            $monthlyTrend = 'up';
        } elseif ($monthlyDifference < 0) {
            $monthlyTrend = 'down';
        }

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $totalTodayActiveSubs = Subscription::whereDate('start_date', $today)
            ->where('status', 'active')
            ->count();

        $totalYesterdayActiveSubs = Subscription::whereDate('start_date', $yesterday)
            ->where('status', 'active')
            ->count();

        if ($totalYesterdayActiveSubs != 0) {
            $dailyGrowth = ($totalTodayActiveSubs - $totalYesterdayActiveSubs) / $totalYesterdayActiveSubs * 100;
        } else {
            $dailyGrowth = 0;
        }

        $data = [
            'subscription_growth_percentage' => round($subscriptionGrowth, 2),
            'monthly_growth_percentage' => round($monthlyGrowth, 2),
            'monthly_difference' => $monthlyDifference,
            'monthly_trend' => $monthlyTrend, // 'up', 'down', or 'same'
            'daily_growth_percentage' => round($dailyGrowth, 2),
            'active_subscriptions_today' => $totalTodayActiveSubs,
            'active_subscriptions_yesterday' => $totalYesterdayActiveSubs,
            'total_active_subscriptions' => $activeSubscriptions,
            'total_subscriptions' => $totalSubscriptions,
            'total_subscriptions_this_month' => $totalSubsThisMonth,
            'total_subscriptions_last_month' => $totalSubsLastMonth,
        ];

        return response()->json([
            'status' => true,
            'message' => 'Get subscriptions growth successfully.',
            'data' => $data
        ], 200);
    }

    public function subscriptionsStatus()
    {
        $totalSubscriptions = Subscription::count();

        $statuses = ['active', 'cancel', 'pause'];

        $data = collect($statuses)->map(function ($status) use ($totalSubscriptions) {
            $count = Subscription::where('status', $status)->count();

            return [
                'status' => $status,
                'count' => $count,
                'percentage' => $this->calculatePercentage($count, $totalSubscriptions),
            ];
        });

        return response()->json([
            'status' => true,
            'message' => 'Get subscriptions growth successfully.',
            'data' => [
                'total' => $totalSubscriptions,
                'chart' => $data,
            ],
        ], 200);
    }

    private function calculatePercentage(int $count, int $total): float
    {
        return $total > 0 ? round(($count / $total) * 100, 2) : 0.0;
    }

    /**
     * Membuat data revenue bulanan berdasarkan data subscription yang dikelompokkan.
     */
    private function generateMonthlyRevenueData($subscriptionsByMonth, $startDate, $endDate)
    {
        $data = [];
        $currentMonth = $startDate->copy()->startOfMonth();

        while ($currentMonth <= $endDate) {
            $monthKey = $currentMonth->format('Y-m');

            $data[] = [
                'month' => $monthKey,
                'revenue' => optional($subscriptionsByMonth->get($monthKey))->sum('total_price') ?? 0,
            ];

            $currentMonth->addMonth();
        }

        return $data;
    }
}
