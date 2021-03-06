<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('long_url');
            $table->string('short_key');
            $table->date('expire_date')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->integer('loadlimit')->default(3);
            $table->integer('within')->default(1);
            $table->integer('blockfor')->default(5);
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
        Schema::dropIfExists('links');
    }
};
