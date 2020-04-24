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
            $table->foreignId('category_id');
            $table->timestamp('created_at')->useCurrent();
            $table->boolean('is_solved')->default(0);

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('solver_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
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
