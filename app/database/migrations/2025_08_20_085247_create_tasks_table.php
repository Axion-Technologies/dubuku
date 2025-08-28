<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->constrained('companies')->onDelete('cascade');
            $table->unsignedInteger('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('ticket_type');
            $table->integer('created_by')->constrained('users')->onDelete('cascade');
            $table->dateTime('created_on');
            $table->string('heading');
            $table->text('description');
            $table->tinyInteger('priority')->default(0)->comment('0:low|1:medium|2:high|3:critical');
            $table->tinyInteger('status')->default(0)->comment('0:new|1:inprogress|2:onhold|3:resolved|4:deleted|5:merged');
            $table->integer('owned_by')->nullable();
            $table->dateTime('resolved_on')->nullable();
            $table->integer('resolved_by')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
