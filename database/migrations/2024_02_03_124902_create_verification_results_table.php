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
    // dalam file migrasi (timestamp_create_verification_results_table.php)
public function up()
{
    Schema::create('verification_results', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('verification_success')->default(0);
        $table->unsignedBigInteger('verification_failure')->default(0);
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
        Schema::dropIfExists('verification_results');
    }
};
