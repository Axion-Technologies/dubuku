<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
           $table->increments('id');
           $table->unsignedInteger('company_id')->constrained('companies')->onDelete('cascade');
           $table->unsignedInteger('project_id')->constrained('projects')->onDelete('cascade');
           $table->string('title');
           $table->text('description')->nullable();
           $table->dateTime('start_date');
           $table->dateTime('end_date');
           $table->tinyInteger('status')->default(0)->comment('0:draft|1:live|2:cancelled|3:finished');
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
        Schema::dropIfExists('sprints');
    }
}
