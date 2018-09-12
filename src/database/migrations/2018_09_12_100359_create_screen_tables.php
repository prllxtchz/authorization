<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        /**
         * This table is used for categorizing the permissions.
         */
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('order', FALSE, TRUE)->nullable();
            $table->unsignedTinyInteger('active', FALSE)->default(1);
            $table->timestamps();
        });

        Schema::create('screens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('order', FALSE, TRUE)->nullable();
            $table->unsignedTinyInteger('active', FALSE)->default(1);

            $table->integer('module_id', FALSE, TRUE);
            $table->foreign('module_id')
                ->references('id')
                ->on('screens')
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->unsignedInteger('screen_id', FALSE)->after('guard_name');
            $table->foreign('screen_id')
                ->references('id')
                ->on('screens')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
