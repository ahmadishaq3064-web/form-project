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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('email',100);
            $table->integer('age');
            $table->string('country',100);
            $table->string('skills',100);
            $table->string('gender',100);
            $table->string('color',100);
            $table->string('salary',100);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('credentials');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
