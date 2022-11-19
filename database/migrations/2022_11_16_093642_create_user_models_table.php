<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_models', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('walletAddress');
            $table->text('profileImage');
            $table->text('bannerImage');
            $table-> string('bankName1')->nullable();
            $table->string('accountNumber1')->nullable();
            $table->string('accountName1')->nullable();
            $table->string('bankName2')->nullable();
            $table->string('accountNumber2')->nullable();
            $table->string('accountName2')->nullable();
            $table->string('bankName3')->nullable();
            $table->string('accountNumber3')->nullable();
            $table->string('accountName3')->nullable();
            $table->text('twitterURL')->nullable();
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
        Schema::dropIfExists('user_models');
    }
}
