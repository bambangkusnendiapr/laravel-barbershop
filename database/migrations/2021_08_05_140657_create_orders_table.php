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
            $table->string('code');
            $table->integer('customer');
            $table->integer('staff');
            $table->foreignId('location_id');
            $table->foreignId('payment_id');
            $table->date('date');
            $table->foreignId('time_id');
            $table->integer('net');
            $table->integer('tax')->nullable();
            $table->integer('gross');
            $table->enum('lunas', ['Order', 'Payment', 'Approved'])->default('Order');
            $table->text('note')->nullable();
            $table->string('images')->nullable();
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
