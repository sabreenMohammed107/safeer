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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('image', 250)->nullable();
            $table->string('en_title', 250)->nullable();
            $table->string('ar_title', 250)->nullable();
            $table->longText('en_text')->nullable();
            $table->longText('ar_text')->nullable();
            $table->date('blog_date')->nullable();
            $table->unsignedBigInteger('blog_category_id')->nullable();
            $table->foreign('blog_category_id')->references('id')->on('blogs_categories');
            $table->integer('active')->default(1);
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
        Schema::dropIfExists('blogs');
    }
};
