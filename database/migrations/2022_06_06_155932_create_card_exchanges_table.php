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
        Schema::create('card_exchanges', function (Blueprint $table) {
            $table->id();
            $table->integer('senderid')->nullable();
            $table->integer('receiverid')->nullable();
            $table->integer('cardid')->nullable();
            $table->string('connection_code')->nullable();
            $table->string('exchange_status')->default(0);
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
        Schema::dropIfExists('card_exchanges');
    }
};
