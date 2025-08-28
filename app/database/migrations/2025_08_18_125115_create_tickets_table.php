<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->constrained('companies')->onDelete('cascade');
            $table->unsignedInteger('project_id')->constrained('projects')->onDelete('cascade');
            $table->unsignedInteger('ticket_type_id')->constrained('ticket_type');
            $table->integer('created_by')->constrained('users');
            $table->dateTime('created_on');
            $table->string('heading');
            $table->text('description');
            $table->enum('priority', ['critical', 'high', 'medium', 'low'])->default('low');
            $table->enum('status', ['new', 'inprogress', 'onhold', 'resolved', 'deleted', 'merged'])->default('new');
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
        Schema::dropIfExists('tickets');
    }
}
