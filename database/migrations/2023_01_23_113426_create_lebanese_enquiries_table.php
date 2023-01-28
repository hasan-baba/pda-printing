<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLebaneseEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lebanese_enquiries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('da_nb')->nullable(false);
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->string('status')->default('Pending Approval');
            $table->json('data');
            $table->double('advanced_payment')->default(0);
            $table->string('payment_reference')->nullable();
            $table->double('advanced_payment_lb')->default(0);
            $table->string('payment_reference_lb')->nullable();
            $table->string('statement')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lebanese_enquiries');
    }
}
