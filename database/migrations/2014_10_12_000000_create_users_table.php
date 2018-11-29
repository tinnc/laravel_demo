<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->increments('id')->notNull();
                $table->string('name')->notNull();
                $table->string('email')->unique();
                $table->string('password')->notNull();
                $table->rememberToken();
                $table->timestamps();
            });

            Schema::create('sessions', function (Blueprint $table) {
                $table->string('id')->unique();
                $table->unsignedInteger('user_id')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->text('payload');
                $table->integer('last_activity');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
        // Schema::drop('users');
    }
}
