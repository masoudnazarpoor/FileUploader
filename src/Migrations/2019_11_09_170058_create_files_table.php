<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('M74_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('fileable_id');
            $table->string('fileable_type');
            $table->string('name');
            $table->integer('size')->comment('base on byte');
            $table->integer('time')->nullable()->comment('base on seconds');
            $table->string('type');
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
        Schema::dropIfExists('M74_files');
    }
}
