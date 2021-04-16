<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeReturnDateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->datetime('return_by')->after('return_date');
            $table->datetime('returned_on')->nullable()->after('return_by');
            $table->dropColumn('return_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->timestamp('return_date')->after('returned_on');
            $table->dropColumn('return_by');
            $table->dropColumn('returned_on');
        });
    }
}
