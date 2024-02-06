<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() : void
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('code', 4)->unique();
            $table->integer('capacity');
            $table->string('status', 10);

            $table->timestamps();
        });
    }
};
