<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAssocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_assocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->references("id")->on("products")->onDelete("cascade")->onUpdate("cascade");
            $table->string("attr_name");
            $table->string("attr_description");
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
        Schema::dropIfExists('product_assocs');
    }
}
