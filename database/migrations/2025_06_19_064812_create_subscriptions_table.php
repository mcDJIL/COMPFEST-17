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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable();
            $table->string('phone');
            $table->foreignUuid('meal_plan_id')->nullable();
            $table->string('allergies')->nullable();
            $table->integer('total_price');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'pause', 'cancel', 'end']);
            $table->date('pause_start');
            $table->date('pause_end');
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("SET NULL");
            $table->foreign("meal_plan_id")->references("id")->on("meal_plans")->onDelete("SET NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
