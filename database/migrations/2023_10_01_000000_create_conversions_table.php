<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->integer('integer_value')->unique();
            $table->string('roman_value');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('conversions');
    }
};
