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
        Schema::create('subscription_meal_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('subscription_id')->nullable();
            $table->foreignUuid('meal_type_id')->nullable();
            $table->timestamps();

            $table->foreign("subscription_id")->references("id")->on("subscriptions")->onDelete("SET NULL");
            $table->foreign("meal_type_id")->references("id")->on("meal_types")->onDelete("SET NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_meal_types');
    }
};
