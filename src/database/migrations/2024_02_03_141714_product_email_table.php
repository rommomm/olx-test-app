<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('product_email', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tracking_email_id');
            $table->unsignedBigInteger('trackable_product_id');
            $table->foreign('tracking_email_id')->references('id')->on('tracking_emails')->onDelete('cascade');
            $table->foreign('trackable_product_id')->references('id')->on('trackable_products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_email');
    }
};
