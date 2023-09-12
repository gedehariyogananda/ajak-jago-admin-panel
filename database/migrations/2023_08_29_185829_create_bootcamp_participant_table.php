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
        Schema::create('bootcamp_participant', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('bootcamp_id')->constrained('bootcamps')->cascadeOnDelete();
            $table->string('jurusan');
            $table->text('description');
            $table->text('pengembangan');
            $table->text('ekspetasi');
            $table->string('file_cv');
            $table->string('bukti_follows');
            $table->string('bukti_shared');
            $table->timestamps();
            $table->primary(['user_id','bootcamp_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bootcamp_participants');
    }
};
