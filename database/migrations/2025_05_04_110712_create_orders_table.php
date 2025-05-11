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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('tracking_no')->nullable();
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('pincode')->nullable();
            $table->string('address')->nullable();
            $table->string('status_message')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('payment_id')->nullable();
            //$table->integer('agent_id')->nullable();    // l'agent qui a enregistré
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('users');//->onDelete('cascade');
            $table->enum('back',[0,1])->nullable(); // 0=back || 1=front
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
