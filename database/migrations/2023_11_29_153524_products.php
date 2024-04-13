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
        // Schema::create('product', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name',255);
        //     $table->string('keyword',255)->nullable();
        //     $table->string('desc',255)->nullable();
        //     $table->string('content',255)->nullable();
        //     $table->string('price',255)->nullable();
        //     $table->string('image',255)->nullable();
        //     $table->string('images',255)->nullable();
        //     $table->string('idcat',255)->nullable();
        //     $table->string('datecreate',255)->nullable();
        //     $table->string('dateedit',255)->nullable();
        //     $table->tinyInteger('status')->default(0);
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
