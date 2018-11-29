<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('id', true);
            $table->integer('category_id')->notNull();
            $table->string('name',64)->notNull();
            $table->text('summary')->notNull();
            $table->text('detail')->notNull();
            $table->integer('price')->notNull();
            $table->boolean('is_new' )->notNull()->defaultValue(1);
            $table->integer('views')->notNull()->defaultValue(0);
            $table->date('created_at')->nullable();
            $table->smallInteger('status')->notNull()->defaultValue(1);
            $table->text('discount')->nullable();
            $table->string('image', 255)->nullable();
            $table->string('alias', 255)->notNull();
            $table->date('updated_at')->nullable();
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
