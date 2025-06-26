<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndTodaySubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:end-today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update subscription status to "end" if end_date is before today and status is active or pause';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info("🔁 Cron job running at " . now());

        try {
            $today = Carbon::today();

            $subscriptions = Subscription::whereIn('status', ['active', 'pause'])
                ->whereDate('end_date', '<=', $today)
                ->get();

            $updatedCount = 0;

            foreach ($subscriptions as $subscription) {
                $subscription->status = 'end';
                $subscription->save();
                $updatedCount++;
            }

            \Log::info("✅ Success: {$updatedCount} subscription(s) updated to 'end'.");
            
            return Command::SUCCESS;
        } catch (\Throwable $th) {
            \Log::info("❌ Failed: " . $th->getMessage());
            \Log::error('Failed to end subscriptions: ' . $th->getMessage(), [
                'trace' => $th->getTraceAsString(),
            ]);

            return Command::FAILURE;
        }
    }
}
