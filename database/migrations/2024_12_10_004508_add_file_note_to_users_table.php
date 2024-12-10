<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            //
            $table->string('file_note')->nullable();
            $table->string('is_new')->nullable();
        });

        Schema::table('folders', function (Blueprint $table) {
            //
            $table->longText('meta_path')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            //
            $table->dropColumn('file_note')->nullable();
            $table->string('is_new')->nullable();
        });

        Schema::table('folders', function (Blueprint $table) {
            //
            $table->longText('meta_path')->nullable()->change();
        });
    }
};
