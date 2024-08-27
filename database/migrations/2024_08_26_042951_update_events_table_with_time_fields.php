<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEventsTableWithTimeFields extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // If the columns already exist as a different type, convert them to varchar
            if (!Schema::hasColumn('events', 'start_time')) {
                $table->string('start_time', 5)->nullable()->after('start'); // "HH:mm"
            }

            if (!Schema::hasColumn('events', 'end_time')) {
                $table->string('end_time', 5)->nullable()->after('end'); // "HH:mm"
            }
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }
}

