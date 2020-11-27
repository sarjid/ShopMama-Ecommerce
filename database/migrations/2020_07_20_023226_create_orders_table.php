<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('payment_type');
            $table->string('payment_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_number')->nullable();
            $table->string('stripe_order_id')->nullable();
            $table->string('paying_amount')->nullable();
            $table->string('subtotal')->nullable();
            $table->integer('coupon_discount')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('return_order_status')->default(0);
            $table->string('return_reason')->nullable();
            $table->string('return_request_date')->nullable();
            $table->string('return_accept_date')->nullable();
            $table->string('return_request_month')->nullable();
            $table->string('return_accept_month')->nullable();
            $table->string('return_request_year')->nullable();
            $table->string('return_accept_year')->nullable();
            $table->string('confirmed_by')->nullable();
            $table->string('processing_by')->nullable();
            $table->string('picked_by')->nullable();
            $table->string('shipped_by')->nullable();
            $table->string('delivered_by')->nullable();
            $table->string('confirmed_date')->nullable();
            $table->string('processing_date')->nullable();
            $table->string('picked_date')->nullable();
            $table->string('shipped_date')->nullable();
            $table->string('delivered_date')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->string('cancel_date')->nullable();
            $table->integer('status')->default(0);
            $table->string('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->string('order_year')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
