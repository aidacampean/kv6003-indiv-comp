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
            $table->bigInteger('trip_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable(false);
            $table->longText('description')->nullable(true);
            $table->longText('notes')->nullable(true);
            $table->timestamp('date');
            $table->timestamps();
            $table->foreign('trip_id')->references('id')->on('trips');
            $table->foreign('user_id')->references('id')->on('users');
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
