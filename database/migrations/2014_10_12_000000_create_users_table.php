<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('phone');
            $table->integer('level')->default(1);
            $table->boolean('isAdmin')->default(false);
            $table->boolean('active')->default(false);
            $table->enum('workStatus' , ['EMPLOYEE' , 'HOMEKEEPER','STUDENT' , 'JOBKEEPER']);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
