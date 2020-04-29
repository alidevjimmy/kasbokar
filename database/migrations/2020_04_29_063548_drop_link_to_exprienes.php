<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropLinkToExprienes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exprieces', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('show');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exprieces', function (Blueprint $table) {
            $table->dropColumn('link');
            $table->dropColumn('show');
        });
    }
}
