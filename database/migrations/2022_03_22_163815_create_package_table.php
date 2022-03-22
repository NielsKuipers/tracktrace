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
        Schema::create('package', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('adress');
            $table->string('zipcode');
            $table->string('country');
            $table->string('receiver_email');
            $table->string('receiver_name');
            $table->string('receiver_adress');
            $table->string('receiver_zipcode');
            $table->string('receiver_country');
            $table->string('weight');
            $table->string('tracking_code');
            $table->string('status');
            $table->id('pickup_id')->nullable(true);
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
        Schema::dropIfExists('package');
    }
};
