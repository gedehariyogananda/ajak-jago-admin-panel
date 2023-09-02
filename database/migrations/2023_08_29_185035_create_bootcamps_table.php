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
        Schema::create('bootcamps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('identifier')->unique();
            $table->text('description');
            $table->date('start_date_reg');
            $table->date('end_date_reg');
            $table->string('time_long');
            $table->string('place');
            $table->string('fee');
            $table->string('image_path');
            $table->string('wa_group_url');
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
        Schema::dropIfExists('bootcamps');
    }
};
