<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('parent')->default(0);
            $table->string('slug');
            $table->enum('is_active' , [0 , 1])->default('1');
            $table->string('view_order')->default(0);
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('article_category_article' , function (Blueprint $table){
            $table->unsignedBigInteger('article_id');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->unsignedBigInteger('category_article_id');
            $table->foreign('category_article_id')->references('id')->on('category_articles')->onDelete('cascade');
            $table->primary(['category_article_id' , 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_category_article');
        Schema::dropIfExists('category_articles');
    }
}
