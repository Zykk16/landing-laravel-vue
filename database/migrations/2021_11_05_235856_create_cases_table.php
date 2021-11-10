<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('image')->nullable()->default('');
            $table->string('title')->nullable()->default('');
            $table->string('goal')->nullable()->default('');
            $table->string('geography')->nullable()->default('');
            $table->string('placement_format')->nullable()->default('');
            $table->string('period')->nullable()->default('');
            $table->string('gender')->nullable()->default('');
            $table->string('age')->nullable()->default('');
            $table->string('income')->nullable()->default('');
            $table->string('interest')->nullable()->default('');
            $table->string('shows')->nullable()->default('');
            $table->string('clicks')->nullable()->default('');
            $table->string('ctr')->nullable()->default('');
            $table->string('vtr')->nullable()->default('');
            $table->string('cpv')->nullable()->default('');
            $table->string('coverage')->nullable()->default('');
            $table->string('refusals')->nullable()->default('');
            $table->string('depth')->nullable()->default('');
            $table->string('duration_session')->nullable()->default('');
            $table->string('objectives')->nullable()->default('');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories_cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
