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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('userid')->nullable();
            $table->string('title')->nullable();
            $table->string('hosted_by')->nullable();
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('description')->nullable();
            $table->string('venue')->nullable();
            $table->integer('event_type')->nullable();
            $table->string('offline_address')->nullable();
            $table->string('online_address')->nullable();
            $table->integer('event_category')->nullable();
            $table->string('addtional_details')->nullable();
            $table->string('fb')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('registration_text')->nullable();
            $table->string('redirect_link')->nullable();
            $table->string('contact_phone')->nullable();
            $table->integer('guest_signin')->nullable();
            $table->integer('guest_share')->nullable();
            $table->integer('guest_bring_guest')->nullable();
            $table->integer('email_reminder')->nullable();
            $table->integer('registration')->nullable();
            $table->string('event_recommendation')->nullable();
            $table->string('photo_url')->nullable();
            $table->string('event_url')->nullable();
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
        Schema::dropIfExists('events');
    }
};
