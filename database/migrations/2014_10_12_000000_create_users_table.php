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
            $table->string('lastname')->nullable();
            $table->string('nickname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default(1);
            $table->string('phone_num')->nullable();
            $table->string('department')->nullable();
            $table->date('birthdate')->default('2011-09-29');
            $table->date('startdate')->default('2011-09-29');
            $table->date('prodate')->default('2011-09-29');
            $table->double('annual_leave', 4, 2)->default(0);
            $table->double('sick_leave', 4, 2)->default(30);
            $table->double('business_leave', 4, 2)->default(3);
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
