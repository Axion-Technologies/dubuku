<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProjectMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_project_mapping', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->constrained('companies')->onDelete('cascade');
            $table->unsignedInteger('project_id')->constrained('projects')->onDelete('cascade');
            $table->unsignedInteger('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_project_mapping');
    }
}
