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
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('price', 10, 2);
            $table->decimal('discount_percentage', 5, 2)->nullable();
            $table->float('rating')->default(0);
            $table->integer('stock')->default(0);
            $table->float('weight')->nullable();
            $table->float('width')->nullable();
            $table->float('height')->nullable();
            $table->float('depth')->nullable();
            $table->string('warranty_information')->nullable();
            $table->string('shipping_information')->nullable();
            $table->string('availability_status')->default('In Stock');
            $table->string('return_policy')->nullable();
            $table->unsignedInteger('minimum_order_quantity')->default(1);
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('thumbnail')->nullable();
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
