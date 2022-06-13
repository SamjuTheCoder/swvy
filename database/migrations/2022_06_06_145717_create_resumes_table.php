<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('headline')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('dob')->nullable();
            $table->string('pob')->nullable();
            $table->string('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('website')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('driver_license_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resumes');
    }
};
