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
            $table->string('title', 64);
            $table->double('price', 8, 2);
            $table->text('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_approved')->default(false);
            $table->string('created_by',64);
            $table->string('updated_by',64)->nullable();
            $table->string('deleted_by',64)->nullable();
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
        Schema::dropIfExists('products');
    }
}
