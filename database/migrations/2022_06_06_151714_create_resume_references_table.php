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
        Schema::create('resume_references', function (Blueprint $table) {
            $table->id();
            $table->integer('resumeid');
            $table->integer('userid');
            $table->string('ref_name')->nullable();
            $table->string('ref_position')->nullable();
            $table->string('ref_phone')->nullable();
            $table->string('ref_email')->nullable();
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
        Schema::dropIfExists('resume_references');
    }
};
