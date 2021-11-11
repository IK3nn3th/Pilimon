<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentModule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserID');
            $table->longText('comment');
            $table->unsignedBigInteger('PostID');
            $table->timestamps();
            $table->foreign('PostID')
            ->references('id')
            ->on('guides');
            $table->foreign('UserID')
            ->references('id')  
            ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_module');
    }
}
