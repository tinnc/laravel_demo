<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(!Schema::hasTable('news')){
			Schema::create('news', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('category_id')->nullable();
				$table->string('title', 200)->nullable();
				$table->text('summary', 65535)->nullable();
				$table->text('detail', 65535)->nullable();
				$table->dateTime('created_at')->nullable();
				$table->integer('views')->nullable();
				$table->boolean('status')->nullable();
				$table->string('image', 255)->nullable();
			});

			Schema::create('worker', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name',64)->notNull();
				$table->string('email',128)->notNull()->unique();
				$table->string('phone',16);
				$table->string('auth_key',32)->notNull();
				$table->string('password_hash')->notNull();
				$table->string('password_reset_token')->unique();
				$table->smallInteger('status' )->notNull()->defaultValue(10);
				$table->integer('created_at')->nullable();
				$table->integer('updated_at')->nullable();
				$table->string('image', 255)->nullable();

			});

			Schema::create('banner', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name',64)->notNull();
				$table->smallInteger('status')->notNull()->defaultValue(1);
				$table->string('link',128)->nullable();
				$table->string('image', 255)->nullable();
			});

			Schema::create('news_category', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name',64)->notNull();
				$table->integer('parent_id')->notNull();
			});

			Schema::create('product_category', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name',64)->notNull();
				$table->integer('parent_id')->notNull();
			});

			Schema::create('product', function(Blueprint $table)
			{
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
			});

			Schema::create('invoice', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name',64)->notNull();
				$table->boolean('gender')->nullable();;
				$table->date('birthday')->notNull();
				$table->string('email',128)->notNull();
				$table->string('address',128)->notNull();
				$table->string('phone',16)->notNull();
				$table->date('created_at')->nullable();
				$table->boolean('status')->notNull()->defaultValue(0);
				$table->text('remark')->nullable();;
				$table->integer('total')->nullable();
			});

			Schema::create('invoice_detail', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('invoice_id')->notNull();
				$table->integer('product_id')->notNull();
				$table->integer('quantity')->notNull();
				$table->integer('price')->notNull();
				$table->integer('total')->notNull();
			});

			Schema::create('image', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->string('name')->notNull();
				$table->string('url')->notNull();
			});

			Schema::create('comment', function(Blueprint $table)
			{
				$table->integer('id', true);
				$table->integer('product_id')->notNull();
				$table->integer('worker_id')->notNull();
				$table->text('content')->notNull();
				$table->datetime('created_at')->nullable();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('news');
		Schema::drop('worker');
		Schema::drop('banner');
		Schema::drop('news_category');
		Schema::drop('product_category');
		Schema::drop('product');
		Schema::drop('invoice');
		Schema::drop('invoice_detail');
		Schema::drop('image');
		Schema::drop('comment');
	}

}
