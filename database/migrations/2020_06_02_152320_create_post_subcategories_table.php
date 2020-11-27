<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_subcategories', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('subcategory_name_en');
            $table->string('subcategory_name_bn');
            $table->string('subcategory_slug_en');
            $table->string('subcategory_slug_bn');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('post_subcategories');
    }
}
