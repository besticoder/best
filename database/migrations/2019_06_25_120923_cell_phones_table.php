<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CellPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_phones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cp_name',100)->nullable();
            $table->string('cp_img',100)->nullable();
            $table->string('cp_color',25);
            $table->string('cp_price',10);
            $table->string('cp_model_no',25);
            $table->string('cp_company');
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
        Schema::dropIfExists('cell_phones');
    }
}
