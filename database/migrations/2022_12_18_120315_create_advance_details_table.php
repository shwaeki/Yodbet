<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('advance_id')->constrained()->onDelete('cascade');
            $table->foreignId('worker_id')->references('id')->on('workers')->constrained()->onDelete('cascade');
            $table->date('payment_date');
            $table->double('amount');
            $table->boolean('paid')->default(false);
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
        Schema::dropIfExists('advance_details');
    }
}
