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
        Schema::create('product_comments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('product_id');
            $table->string('user_id');
            $table->string('rate',5);
            $table->string('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_comments');
    }
};
