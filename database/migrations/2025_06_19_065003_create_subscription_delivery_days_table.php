<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_delivery_days', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('subscription_id')->nullable();
            $table->foreignUuid('delivery_day_id')->nullable();
            $table->timestamps();

            $table->foreign("subscription_id")->references("id")->on("subscriptions")->onDelete("SET NULL");
            $table->foreign("delivery_day_id")->references("id")->on("delivery_days")->onDelete("SET NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_delivery_days');
    }
};
