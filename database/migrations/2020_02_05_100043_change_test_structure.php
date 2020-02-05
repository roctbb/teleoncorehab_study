<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTestStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('step_id');
            $table->dropColumn('task_id');
            $table->dropColumn('answer');


            $table->integer('sort_id')->default(0);
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')->references('id')
                ->on('courses')->onDelete('cascade');
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
