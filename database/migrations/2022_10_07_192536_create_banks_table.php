<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('branch')->nullable();
            $table->string('swift')->nullable();
            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('account_number')->nullable();
            $table->string('iban')->nullable();
            $table->string('currency')->nullable();
            $table->string('beneficiary_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
