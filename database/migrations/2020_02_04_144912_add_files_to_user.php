<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFilesToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('diploma_file', 512)->nullable();
            $table->string('surname_file', 512)->nullable();
            $table->string('postgraduate_file', 512)->nullable();
            $table->string('certificate_file', 512)->nullable();
            $table->string('snils_file', 512)->nullable();
            $table->string('passport_file', 512)->nullable();
            $table->string('request_file', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
