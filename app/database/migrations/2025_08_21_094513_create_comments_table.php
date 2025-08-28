<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->constrained('companies');
            $table->integer('task_id')->constrained('tasks');
            $table->integer('created_by')->constrained('users');
            $table->tinyInteger('public')->default(0)->comment('0:yes|1:no');
            $table->text('comment');
            $table->dateTime('created_on');
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
        Schema::dropIfExists('comments');
    }
}
