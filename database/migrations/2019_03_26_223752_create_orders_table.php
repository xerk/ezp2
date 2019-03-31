<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index();
			$table->string('billing_email');
			$table->string('billing_name');
			$table->string('billing_address');
			$table->integer('city_id')->unsigned()->index();
			$table->string('billing_phone');
			$table->string('billing_discount')->nullable();
			$table->string('billing_discount_code')->nullable();
			$table->integer('billing_subtotal');
			$table->integer('billing_tax');
			$table->integer('billing_total');
			$table->smallInteger('payment_gateway');
			$table->text('error')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
