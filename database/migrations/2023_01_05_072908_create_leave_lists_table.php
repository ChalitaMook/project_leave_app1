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
        Schema::create('leave_lists', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('detail');
            $table->date('start_date');
            $table->date('end_date');
            $table->double('totaldate',4,2);
            $table->string('phone_num');
            $table->string('contract_person')->nullable();
            $table->string('attachment')->nullable();
            $table->string('leader_status');
            $table->string('type_id');
            $table->string('user_id');
            $table->string('department');
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
        Schema::dropIfExists('leave_lists');
    }
};
