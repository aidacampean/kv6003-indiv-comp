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
        Schema::create('user_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('trip_id');
            $table->unsignedInteger('user_id');
            $table->enum('role', [
                'admin',
                'collaborator'
            ]);
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
        Schema::dropIfExists('user_trips');
    }
};
