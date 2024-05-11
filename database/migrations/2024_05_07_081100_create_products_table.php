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
            $table->integer('category_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_name_slug')->nullable();
            $table->string('code')->nullable();
            $table->string('quantity')->nullable();
            $table->string('price')->nullable();
            $table->string('hot_deal')->nullable();
            $table->string('hot_new')->nullable();
            $table->string('image')->nullable();
            $table->text('short_desc')->nullable();
            $table->longtext('description')->nullable();
            $table->integer('status')->default(1);
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