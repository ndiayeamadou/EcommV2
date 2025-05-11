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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('name');
            $table->string('reference')->nullable();
            $table->string('slug')->unique();
            $table->string('brand')->nullable();
            $table->string('barcode')->nullable();
            $table->mediumText('short_description')->nullable();
            $table->longText('description')->nullable();

            //$table->integer('original_price');
            $table->decimal('promotional_price', 11)->nullable();
            $table->decimal('original_price', 11)->nullable();
            $table->decimal('selling_price', 11);
            //$table->decimal('price', 11, 2)->default(0);
            $table->decimal('quantity');
            //$table->string('etat_produit')->nullable(); // occasion | neuf
            //$table->tinyInteger('trending')->default('0')->comment('0=not-trending,1=trending');
            /* OR */
            $table->boolean('is_trending')->default(false);
            //$table->tinyInteger('featured')->default('0')->comment('0=not-featured,1=featured');
            /* OR */
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true); //= status
            //$table->tinyInteger('status')->default('0')->comment('0=visible,1=hidden');

            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keywords')->nullable();
            $table->mediumText('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
