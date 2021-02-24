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
            $table->string('name',100);
            $table->string('email',100);
            $table->string('password',100);
            $table->string('address',100)->nullable();
            $table->integer('phone')->nullable();
            $table->integer('status')->default(0);
            $table->enum('role',['admin','user'])->default('user');
            $table->timestamps();
        });
        //insert inc_admin
        DB::table('users')->insert(
            array(
                'name' => 'Karima-Admin',
                'email' => 'admin@admin.com',
                'role' => 'admin',
                'password'=>\Illuminate\Support\Facades\Hash::make('admin123')
            )
        );
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
