<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('companyName')->nullable();
            $table->integer('phone');
            $table->string('email');
            $table->string('city');
            $table->string('addressLine1');
            $table->string('addressLine2')->nullable();
            $table->string('zip')->nullable();
            $table->string('orderNotes')->nullable();
            $table->integer('viewed')->default(0);
            $table->integer('delivered')->default(0);
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
        Schema::dropIfExists('checkouts');
    }
}
