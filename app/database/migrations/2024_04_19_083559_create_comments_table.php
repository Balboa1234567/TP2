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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longtext('content'); 
            $table->timestamps();

            //$table->unsignedBigInteger('Article_id');
           // $table->foreign('Article_id')->references('id')->on('articles');

           $table->foreignId('articles_id')->constrained();
           $table->foreignId("user_id")->constrained();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
