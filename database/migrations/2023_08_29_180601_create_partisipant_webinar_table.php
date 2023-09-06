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
        Schema::create('partisipant_webinar', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('webinar_id')->constrained('webinars')->cascadeOnDelete();
            $table->primary(['user_id','webinar_id']);
            $table->enum('info', ['Instagram', 'Others','Teman','Linkedin']);
            $table->string('bukti_follow');
            $table->string('bukti_share');
            $table->string('next_idea');
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
        Schema::dropIfExists('webinar_partisipants');
    }
};
