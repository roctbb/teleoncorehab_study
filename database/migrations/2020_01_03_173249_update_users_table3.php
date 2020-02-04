<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('school');
            $table->dropColumn('grade_year');
            $table->dropColumn('hobbies');
            $table->dropColumn('interests');
            $table->dropColumn('git');
            $table->dropColumn('vk');
            $table->dropColumn('telegram');
            $table->dropColumn('comments');
            $table->dropColumn('is_trainee');
            $table->dropColumn('rank_id');
            $table->dropColumn('city');

            $table->string('gender', 6)->nullable();
            $table->string('country', 255)->nullable();
            $table->string('address', 512)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('university_name', 512)->nullable();
            $table->string('university_diploma', 100)->nullable();
            $table->year('university_year')->nullable();
            $table->string('internship_name', 512)->nullable();
            $table->year('internship_year')->nullable();
            $table->string('postgraduate_name', 512)->nullable();
            $table->year('postgraduate_year')->nullable();
            $table->string('courses', 2048)->nullable();
            $table->string('certificate_number', 100)->nullable();
            $table->string('certificate_specialty', 512)->nullable();
            $table->year('certificate_year')->nullable();
            $table->string('job_title', 100)->nullable();
            $table->string('job_place', 512)->nullable();

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
