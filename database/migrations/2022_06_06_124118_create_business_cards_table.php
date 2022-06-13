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
        Schema::create('business_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('title_designation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('business_address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('description')->nullable();
            $table->string('background_color')->nullable();
            $table->integer('card_width')->nullable();
            $table->integer('card_height')->nullable();
            $table->string('text_color')->nullable();
            $table->integer('text_size')->nullable();
            $table->string('photo_url')->nullable();
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
        Schema::dropIfExists('business_cards');
    }
};
