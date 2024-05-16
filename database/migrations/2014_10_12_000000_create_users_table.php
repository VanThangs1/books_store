<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table -> string('phone_number') -> nullable();
            $table -> string('address') -> nullable();
            $table -> enum('gender', ['male', 'female']) -> nullable();
            $table -> date('date_of_birth') -> nullable();
            $table -> string('image') -> default('');
            $table->string('thumbnail');
            $table->enum('is_admin', [0, 1]) -> default(0);
            $table->enum('status', [0, 1]) -> default(1);

            
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
