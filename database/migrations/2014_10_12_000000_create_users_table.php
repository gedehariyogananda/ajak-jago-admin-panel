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
            $table->string('name');
            $table->string('identifier')->unique();
            $table->string('email')->unique();
            $table->enum('level_education',['Gap Year','High School/Vocational School Equivalent', 'Bachelor Degree', 'Fresh Graduate']);
            $table->string('provincial_origin');
            $table->bigInteger('wa_number');
            $table->string('institusi');
            $table->string('profile_picture');
            $table->integer('age');
            $table->string('subteam')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('team_id')->nullable()->constrained('teams')->cascadeOnDelete()->nullOnDelete();
            $table->rememberToken();
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
