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
        Schema::create('langable', function (Blueprint $table) {
            $table->id();
			$table->string('lang',255)->nullable();
			$table->string('name',255)->nullable();
			$table->text('text')->nullable();
			$table->integer('langable_id')->nullable();
			$table->string('langable_type',255)->nullable();
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
        Schema::dropIfExists('langable');
    }
};
