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
        Schema::table('page_sections', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            
            $table->foreign('page_id')->references('id')
            ->on( 'pages') 
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->unsignedBigInteger('page_section_template_id');

            $table->foreign('page_section_template_id')->references('id')
            ->on('page_section_templates') 
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
