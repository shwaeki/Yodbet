<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
//            $table->date('start_date');
//            $table->date('end_date');
            $table->integer('hour_cost');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->enum('status', ['pending', 'canceled', 'completed'])->default('pending');
            $table->foreignId('manager_id')->nullable()->references('id')->on('contacts')->constrained()->onDelete('cascade');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('projects');
    }
}
