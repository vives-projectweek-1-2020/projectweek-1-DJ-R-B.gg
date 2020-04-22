<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration{
    public function up(){
        Schema::create('Issues', function(Blueprint $table){
            $table->id()->unique();
            
            $table->string('name')->unique();
            $table->string('category');
            $table->timestamp('IssueCreate');

        });
    }
    public function down(){
        Schema::dropIfExists('Issues');
    }
}