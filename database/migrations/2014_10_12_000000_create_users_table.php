<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('lstname');
            $table->integer('document_type')->default(1); // 1 = Cedula, 2 = Documento de extranjeria
            $table->integer('document_number');
            $table->string('phone');
            $table->string('email');
            $table->string('password')->default(Hash::make("abcdefghijk123"));
            $table->unsignedInteger('categories_id');
            $table->string('country');
            $table->string('street');
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
