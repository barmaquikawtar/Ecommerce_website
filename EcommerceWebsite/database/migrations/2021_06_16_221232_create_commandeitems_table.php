<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandeitems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('commade_id')->unsigned();
            $table->foreign('commade_id')->on('commandes')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('pane_id')->unsigned();
            $table->foreign('pane_id')->on('panes')->references('id')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('commandeitems');
    }
}
