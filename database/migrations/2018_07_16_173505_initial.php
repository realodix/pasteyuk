<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('pastes', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('title');
            $table->longText('content');
            $table->string('link')->collation('utf8mb4_bin')->unique();
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
