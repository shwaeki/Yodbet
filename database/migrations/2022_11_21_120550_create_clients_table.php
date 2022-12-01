<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_key');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone',10)->nullable();;
            $table->string('phone2',10)->nullable();;
            $table->string('taxID');
            $table->string('city')->nullable();;
            $table->string('address')->nullable();;
            $table->foreignId('added_by')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('clients');
    }
}
