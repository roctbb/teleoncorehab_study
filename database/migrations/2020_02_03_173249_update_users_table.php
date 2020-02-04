<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
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

            $table->string('gender', 6);
            $table->string('country', 255);
            $table->string('address', 512);
            $table->string('phone', 100);
            $table->string('university_name', 512);
            $table->string('university_diploma', 100);
            $table->year('university_year');
            $table->string('internship_name', 512);
            $table->year('internship_year');
            $table->string('postgraduate_name', 512);
            $table->year('postgraduate_year');
            $table->string('courses', 2048);
            $table->string('certificate_number', 100);
            $table->string('certificate_specialty', 512);
            $table->year('certificate_year');
            $table->string('job_title', 100);
            $table->string('job_place', 512);

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
