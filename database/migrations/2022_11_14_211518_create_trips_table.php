<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('customer_name')->nullable(false);
            $table->text('address')->nullable(false);
            $table->text('vessel')->nullable(false);
            $table->text('port')->nullable(false);
            $table->date('eta')->nullable(false);
            $table->date('ata')->nullable(true);
            $table->date('ats')->nullable(true);
            $table->text('terminal')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
