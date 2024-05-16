<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table -> unsignedBigInteger('added_by');
            $table -> string('title');
            $table -> string('slug');
            $table -> text('description') -> nullable();
            $table -> text('content')  -> nullable();
            $table -> unsignedBigInteger('parent_id')  -> nullable();
            $table -> string('meta_title')  -> nullable();
            $table -> string('meta_description')  -> nullable();
            $table -> string('image') -> default('') ;
            $table->string('thumbnail') ;
            $table->enum('status', [0, 1]) -> default(1);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
