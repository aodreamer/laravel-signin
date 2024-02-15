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
    // dalam file database/migrations/xxxx_xx_xx_add_download_count_to_files_table.php

public function up()
{
    Schema::table('files', function (Blueprint $table) {
        $table->unsignedInteger('download_count')->default(0);
    });
}

public function down()
{
    Schema::table('files', function (Blueprint $table) {
        $table->dropColumn('download_count');
    });
}

};
