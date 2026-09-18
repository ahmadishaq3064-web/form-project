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
        Schema::create('company_info', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->unsignedbigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('credentials');
            $table->string('company_name',100);
            $table->string('owner_name',100);
            $table->string('contact',100);
            $table->string('email',100);
            $table->string('address',100);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_info');
    }
};
