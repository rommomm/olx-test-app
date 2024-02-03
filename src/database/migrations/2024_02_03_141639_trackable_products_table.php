<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trackable_products', function (Blueprint $table) {
            $table->id();
            $table->decimal('initial_price', 10, 2);
            $table->decimal('new_price', 10, 2)->nullable();
            $table->string('product_link');
            $table->string('product_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trackable_products');
    }
};
