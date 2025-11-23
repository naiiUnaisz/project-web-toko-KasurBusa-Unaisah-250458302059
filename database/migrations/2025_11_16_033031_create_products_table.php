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
            $table->foreignId('kategori_id')->nullable()->constrained('kategories')->onDelete('set null'); 
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');    
            $table->foreignId('foam_type_id')->nullable()->constrained('foam_types')->onDelete('set null'); 
            $table->foreignId('size_id')->nullable()->constrained('sizes')->onDelete('set null');
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->decimal('price', 12, 2);
            $table->integer('stock_quantity')->default(0);
            $table->string('sku', 100)->unique()->nullable();
            $table->text('deskripsi')->nullable();
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
