<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableGeneralAddNameAndDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general', function (Blueprint $table) {
            $table->string('site_name');
            $table->text('site_description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general', function (Blueprint $table) {
            $table->dropColumn(['site_name', 'site_description']);
        });
    }
}
