<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->string('number')->unique()->nullable();
        });

        if (Schema::hasColumn('workers', 'organizer_id')) {
            Schema::table('workers', function (Blueprint $table) {
                $table->dropForeign(['organizer_id']);
                $table->dropColumn(['is_organizer']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workers', function (Blueprint $table) {
            $table->dropColumn(['number']);
        });
    }
}
