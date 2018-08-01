<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pastes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->string('title');
            $table->longText('content');
            $table->string('link')->unique();
            $table->integer('views');
            $table->string('ip');
            $table->string('syntax');
            $table->string('expiration');
            $table->string('privacy');
            $table->string('password');
            $table->boolean('burnAfter');
            $table->timestamps();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('pastes');
        Schema::dropIfExists('password_resets');
    }
}
