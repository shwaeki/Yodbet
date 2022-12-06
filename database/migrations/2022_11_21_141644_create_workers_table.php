<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone1',10)->nullable();
            $table->string('phone2',10)->nullable();
            $table->string('email')->nullable();
            $table->string('identification',9);
            $table->integer('hour_cost')->nullable();
            $table->date('license_expiration_date')->nullable();
            $table->date('course_date')->nullable();
            $table->date('course_end_date')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_organizer')->default(0);
            $table->foreignId('organizer_id')->nullable()->references('id')->on('workers')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('workers');
    }
}
