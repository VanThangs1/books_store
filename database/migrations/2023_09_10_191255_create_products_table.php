<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ISBN') -> uniqid();
            $table->unsignedBigInteger('added_by'); 
            $table->string('title');
            $table->string('slug');
            $table->string('image') -> default('');
            $table->string('thumbnail');
            $table->unsignedBigInteger('author_id'); 
            $table->unsignedBigInteger('category_id'); 
            $table->bigInteger('price');
            $table->bigInteger('quantity');
            $table->text('description') -> nullable();
            $table->text('content') -> nullable();
            $table->string('meta_title') -> nullable();
            $table->text('meta_description') -> nullable();
            $table->enum('type', [0, 1]) -> default(0);
            $table->enum('status', [0, 1]) -> default(1);
            $table->date('publication_date') -> nullable();
            $table->string('pdf_link') -> nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by')->references('id')->on('users');
            $table->foreign('author_id')->references('id')->on('authors');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
