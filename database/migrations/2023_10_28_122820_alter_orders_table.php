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
        Schema::table("orders", function (Blueprint $table) {
            $table->enum('payment_status', ['paid', 'not_paid'])->after('subtotal')->default('not_paid');
            $table->enum('order_status', ['pending', 'shiped', 'delivered', 'cancelled'])->after('payment_status')->default('pending');
            $table->text('admin_notes')->after('notes');
        });      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("orders", function (Blueprint $table) {
            $table->dropColumn('payment_status');
            $table->dropColumn('order_status');
            $table->dropColumn('admin_notes');
        });
    }
};
