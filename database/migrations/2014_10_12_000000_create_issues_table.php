<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('user_id');
            $table->foreignId('solver_id')->nullable();
            $table->text('title');
            $table->text('comment')->nullable();
            $table->set('category', ['wiskunde', 'taal', 'geschiedenis']);
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_solved')->default(0);
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}
