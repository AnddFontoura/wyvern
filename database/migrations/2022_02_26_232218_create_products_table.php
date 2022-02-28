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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sub_category_id');
            $table->string('name', 1000);
            $table->string('nickname', 1000)->nullable(true);
            $table->text('description', 10000)->nullable(true);
            $table->string('isbn', 100)->nullable(true);
            $table->string('codebar', 100)->nullable(true);
            $table->float('weight', 12,3)->nullable(true);
            $table->float('width', 12,3)->nullable(true);
            $table->float('height', 12,2)->nullable(true);
            $table->float('depth', 12,3)->nullable(true);
            $table->float('price', 12,2)->nullable(true);
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('sub_category_id')->references('id')->on('sub_categories');
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
