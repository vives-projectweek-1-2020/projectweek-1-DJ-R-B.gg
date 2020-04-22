<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileuploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fileupload', function (Blueprint $table) {
            $table->id()->unique();
            $table->foreignId('user_id');
            $table->string('path');
            $table->string('title');
            $table->string('comment')->nullabe(); //set this in http://localhost/phpmyadmin/tbl_structure.php?db=grademe&table=fileupload to default 0
            $table->set('category', ['wiskunde', 'taal', 'geschiedenis']);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fileupload');
    }
}
