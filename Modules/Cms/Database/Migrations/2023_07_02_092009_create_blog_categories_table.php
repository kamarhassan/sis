<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateBlogCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->increments('id')->nullable();
         
            $table->string('title')->nullable();
            $table->integer('position_order')->nullable();
            $table->boolean('status')->nullable()->default(1);
            $table->integer('parent_id')->nullable()->default(0);
          
            $table->text('tags')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('blog_categories');
    }
}
