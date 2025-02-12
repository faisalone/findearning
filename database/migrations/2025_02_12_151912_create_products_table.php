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
			$table->bigInteger('category_id')->unsigned()->nullable();
            $table->text('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->integer('quantity')->nullable();
            $table->boolean('status')->default(1); // Add status column
            $table->timestamps();

            // Foreign Key
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('set null') // Allow deleting a category by setting category_id to null in products
                  ->onUpdate('cascade');
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
