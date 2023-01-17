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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 25);
            $table->string('last_name', 25);


            $table->string('email', 50)->unique()->nullable();
            $table->string('phone', 30)->nullable();

            #metode after
            $table->text('address')->nullable();
            $table->string('city', 50)->nullable();

            $table->string('region', 50)->nullable();
            $table->enum('country', ['id', 'us'])->nullable();
            $table->integer('postal_code', 10)->nullable();

            $table->boolean('active')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
