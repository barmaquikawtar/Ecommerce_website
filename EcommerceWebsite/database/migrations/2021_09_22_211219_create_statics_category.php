<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statics_category', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('child_category')->references('id')->on('child_categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->bigInteger('child_category',false,true,);
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
        Schema::dropIfExists('statics_category');
    }
}
