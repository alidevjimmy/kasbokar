<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
           // $table->dropColumn('commentable_type');
           // $table->dropColumn('commentable_id');
            $table->string('body');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('commentable_type');
            $table->string('commentable_id');
            $table->index(['commentable_type', 'commentable_id']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //$table->dropColumn('commentable_type');
            //$table->dropColumn('commentable_id');
            $table->string('body');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('commentable_type');
            $table->string('commentable_id');
            $table->index(['commentable_type', 'commentable_id']);
            $table->softDeletes();
        });
    }
}
