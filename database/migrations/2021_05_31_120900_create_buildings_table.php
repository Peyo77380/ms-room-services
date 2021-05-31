<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->json('location');
            $table->int('surface');
            $table->json('openingHours');
            $table->string('description');
            $table->id('pictures'); // à remplacer par foreign key quand upload image est prêt
            $table->json('characteristics');
            $table->int('state');
            $table->boolean('enabled');
            $table->json('floor');
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
        Schema::dropIfExists('buildings');
    }
}
