<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('company_id')->unsigned()->index();
			$table->string('name');
			$table->string('featured');
			$table->integer('sku')->unique();
			$table->integer('price');
			$table->integer('discount_price');
			$table->string('image');
			$table->text('body')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
