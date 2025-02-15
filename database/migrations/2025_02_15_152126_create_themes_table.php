<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            //
            $table->string('bgColour');
            $table->string('bgTextColour');
            //
            $table->string('secondBgColour');
            $table->string('secondBgHoverColour');
            $table->string('secondColour');
            $table->string('secondBgTextColour');
            $table->string('secondFocusColour');
            $table->string('secondHoverColour');
            //
            $table->string('textColour');
            $table->string('textHoverColour');
            $table->string('textBgHoverColour');
            //
            $table->string('secondTextColour');
            $table->string('secondTextHoverColour');
            //
            $table->string('thirdTextColour');
            //
            $table->string('mainButtonColour');
            $table->string('mainButtonHoverColour');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

     /** 
      * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('themes');
    }
};
