<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_1')->nullable();
            $table->string('field_2')->nullable();
            $table->string('field_3')->nullable();
            $table->string('field_4')->nullable();
            $table->string('field_5')->nullable();
            $table->string('field_6')->nullable();
            $table->string('field_7')->nullable();
            $table->string('field_8')->nullable();
            $table->string('field_9')->nullable();
            $table->string('field_10')->nullable();
            $table->string('field_11')->nullable();
            $table->string('field_12')->nullable();
            $table->string('field_13')->nullable();
            $table->string('field_14')->nullable();
            $table->string('field_15')->nullable();
            $table->string('field_16')->nullable();
            $table->string('field_17')->nullable();
            $table->string('field_18')->nullable();
            $table->string('field_19')->nullable();
            $table->string('field_20')->nullable();
            $table->string('field_21')->nullable();
            $table->string('field_22')->nullable();
            $table->string('field_23')->nullable();
            $table->string('field_24')->nullable();
            $table->string('field_25')->nullable();

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
        Schema::dropIfExists('forms');
    }
}
