<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderReplacementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * order replacement
         */
        Schema::create('order_replacement', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('reference_number', false, 12)->nullable();
            $table->dateTime('date')->nullable();

            $table->enum('market_place',array(
                'ebay','amazon', 'zaktag','flipcart','snapdeal','paytm'
            ))->nullable();

            $table->enum('rep_requested',array(
                'same','refund', 'new'
            ))->nullable();

            $table->enum('status',array(
                'raised', 'dispatched','delivered','close'
            ))->nullable();
            $table->string('order_number', 32)->nullable();

            //desc => description
            $table->text('desc')->nullable();
            $table->string('buyer_email_id',64)->nullable();
            $table->string('buyer_phone_number',16)->nullable();
            $table->float('order_amount', 11,2)->nullable();
            $table->text('discussion_with_buyer')->nullable();

            $table->text('rep_order_desc')->nullable();
            $table->string('new_product_name',64)->nullable();
            $table->string('rep_delivery_address',64)->nullable();
            $table->string('rep_refund_cost',64)->nullable();
            $table->string('airway_bill_number',32)->nullable();
            $table->string('courier_company',64)->nullable();

            $table->integer('created_by', false, 11);
            $table->integer('updated_by', false, 11);
            $table->timestamps();
            $table->engine = 'InnoDB';
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_replacement');
    }
}
