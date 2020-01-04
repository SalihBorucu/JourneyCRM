<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaybookStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playbook_steps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('playbook_id');
            $table->unsignedInteger('step');
            $table->string('type');
            $table->integer('gap');
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
        Schema::dropIfExists('playbook_steps');
    }
}
