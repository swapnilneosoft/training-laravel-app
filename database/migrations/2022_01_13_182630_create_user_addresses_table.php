<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->string("fullname")->nullable();
            $table->text("address")->nullable();
            $table->string("state")->nullable();
            $table->string("city")->nullable();
            $table->integer("pincode")->nullable();
            $table->bigInteger("mobile_no")->nullable();
            $table->boolean("status")->default(1); // just disabeling the status while deleting the address

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
