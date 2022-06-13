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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->string('google_id')->nullable();
            $table->integer('email_verify_status')->default(0);
            $table->string('phone')->nullable();
            $table->integer('is_terms_conditions')->nullable();
            $table->string('title_designation')->nullable();
            $table->string('company_name')->nullable();
            $table->string('location')->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->integer('city')->nullable();
            $table->date('dob')->nullable();
            $table->integer('notify_dob')->nullable();
            $table->string('fb')->nullable();
            $table->string('wap')->nullable();
            $table->string('tw')->nullable();
            $table->string('lnkd')->nullable();
            $table->string('connection_code')->nullable();
            $table->string('photo_url')->nullable();
            $table->integer('user_type')->nullable();
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
        Schema::dropIfExists('users');
    }
};
