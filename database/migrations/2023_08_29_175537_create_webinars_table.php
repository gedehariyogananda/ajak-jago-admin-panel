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
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('identifier')->unique();
            $table->text('description');
            $table->dateTime('datetime');
            $table->string('place');
            $table->string('fee');
            $table->string('image_path');
            $table->enum('status', ['open','closed']);
            $table->string('video_url')->nullable();
            $table->string('meet_url')->nullable();
            $table->string('poster_url');
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
        Schema::dropIfExists('webinars');
    }
};
