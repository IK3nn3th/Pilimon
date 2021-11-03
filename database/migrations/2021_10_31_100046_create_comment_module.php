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
        Schema::create('comment_module', function (Blueprint $table) {
            $table->id();
            $table->foreign('UserID')
            ->references('id')
            ->on('users');
            $table->longText('comment');
            $table->foreign('PostID')
            ->references('id')
            ->on('guides');
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
        Schema::dropIfExists('comment_module');
    }
}
