<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToExpriences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exprieces', function (Blueprint $table) {
            $table->string('link')->nullable();
            $table->boolean('show')->default(true);
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
            $table->string('link');
            $table->boolean('show')->default(true);
        });
    }
}
