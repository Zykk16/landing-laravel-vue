<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
        });

        Schema::table('cases', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('slug')->nullable();

            $table->foreign('status_id')->references('id')->on('cases_statuses')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropForeign('cases_status_id_foreign');
        });

        Schema::dropIfExists('cases_statuses');
    }
}
