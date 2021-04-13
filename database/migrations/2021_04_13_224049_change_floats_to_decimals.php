<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFloatsToDecimals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->decimal('rental_price')->change();
            $table->decimal('sale_price')->change();
        });

        Schema::table('rentals', function (Blueprint $table) {
            $table->decimal('unit_price')->change();
            $table->decimal('penalty')->change();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->decimal('unit_price')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            $table->float('rental_price')->change();
            $table->float('sale_price')->change();
        });

        Schema::table('rentals', function (Blueprint $table) {
            $table->float('unit_price')->change();
            $table->float('penalty')->change();
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->float('unit_price')->change();
        });
    }
}
