<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpinionInfoToOpinionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opinion', function (Blueprint $table) {
            //
            $table->string('name',15); //opinionのニックネーム
            $table->string('opinionMesseges',400); //opinionのメッセージ

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opinion', function (Blueprint $table) {
            //
        });
    }
}
