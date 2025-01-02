<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(1);
            $table->string('first_name', 255);
            $table->string('last_name', 255); // varchar(255) notnull
            $table->string('gender', 50); // tinyint notnull
            $table->string('email', 255); // varchar(255) notnull
            $table->string('tel', 255); // varchar(255) notnull
            $table->string('address', 255); // varchar(255) notnull
            $table->string('building', 255)->nullable(); // varchar(255), nullable
            $table->text('detail')->comment('問い合わせ内容'); //問い合わせ内容');
            $table->timestamps(); // created_at, updated_at

            // 外部キー制約
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
