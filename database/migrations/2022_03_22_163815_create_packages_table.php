<?php

use App\enums\PackageStatus;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->references('id')->on('companies');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('zipcode');
            $table->string('building_number');
            $table->string('street');
            $table->string('city');
            $table->string('country');
            $table->string('weight');
            $table->string('status')->default(PackageStatus::LOGGED->toString());
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
