<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIsosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('isos', function (Blueprint $table) {
            $table->id();
            $table->string('business_name'); // adjust as needed
            $table->string('contact_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->json('emails')->nullable();
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
        Schema::dropIfExists('isos');
    }
}