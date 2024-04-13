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
        // Schema::create('categorie', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name',255);
        //     $table->string('keyword',255)->nullable();
        //     $table->string('desc',255)->nullable();
        //     $table->string('level',10)->nullable();
        //     $table->string('status')->nullable();
        // });

        // Schema::create('account', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('username',150);
        //     $table->string('address',255)->nullable();
        //     $table->string('email')->unique();
        //     $table->string('password');
        //     $table->tinyInteger('status')->default(1);
        //     $table->rememberToken();
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
