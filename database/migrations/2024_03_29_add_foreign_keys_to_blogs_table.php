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
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id');
            
            $table->foreign('category_id')->references('id')
            ->on( 'blog_categories') 
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('author_id');

            $table->foreign('author_id')->references('id')
            ->on('users') 
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
};
