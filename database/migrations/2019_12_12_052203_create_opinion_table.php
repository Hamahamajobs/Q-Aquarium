<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('aqua');
            $table->string('email');
            $table->string('opinionMessege');
            $table->timestamps();
        });

        Schema::table('opinion', function (Blueprint $table) {
                        $table->string('email');
                    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinion');
    }


    
}
