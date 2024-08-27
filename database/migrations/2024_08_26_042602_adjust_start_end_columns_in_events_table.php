<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustStartEndColumnsInEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // Check if 'start' and 'end' columns are not of type 'VARCHAR' and alter them
            if (Schema::hasColumn('events', 'start') && Schema::getColumnType('events', 'start') != 'string') {
                $table->string('start')->nullable()->change();
            }
            if (Schema::hasColumn('events', 'end') && Schema::getColumnType('events', 'end') != 'string') {
                $table->string('end')->nullable()->change();
            }
            
            // Add 'start_time' and 'end_time' columns if they don't already exist
            if (!Schema::hasColumn('events', 'start_time')) {
                $table->string('start_time')->nullable()->after('start');
            }
            if (!Schema::hasColumn('events', 'end_time')) {
                $table->string('end_time')->nullable()->after('end');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // Revert 'start' and 'end' columns back to 'DATE'
            if (Schema::hasColumn('events', 'start') && Schema::getColumnType('events', 'start') == 'string') {
                $table->date('start')->nullable()->change();
            }
            if (Schema::hasColumn('events', 'end') && Schema::getColumnType('events', 'end') == 'string') {
                $table->date('end')->nullable()->change();
            }

            // Drop 'start_time' and 'end_time' columns if they exist
            if (Schema::hasColumn('events', 'start_time')) {
                $table->dropColumn('start_time');
            }
            if (Schema::hasColumn('events', 'end_time')) {
                $table->dropColumn('end_time');
            }
        });
    }
}
