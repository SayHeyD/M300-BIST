<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surename');
            $table->string('street');
            $table->string('housenumber');
            $table->string('location');
            $table->string('zipcode');
            $table->string('email');
            $table->string('phonenumber');
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
        Schema::dropIfExists('book_entries');
    }
}
