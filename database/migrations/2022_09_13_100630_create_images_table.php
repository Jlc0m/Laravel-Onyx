<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('post_id', 'image_post_idx');
            $table->foreign('post_id', 'image_post_fk')->on('posts')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
