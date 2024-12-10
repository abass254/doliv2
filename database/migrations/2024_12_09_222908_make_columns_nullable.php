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
        //
        Schema::table('folders', function (Blueprint $table) {
            $table->string('file')->nullable()->change();
            $table->string('folder_name')->nullable()->change();
            $table->string('primary_folder')->nullable()->change();
            $table->string('folder_path')->nullable()->change();
            $table->string('folder_type')->nullable()->change();
            $table->string('folder_status')->nullable()->change();
            $table->string('meta_name')->nullable();
            $table->string('meta_primary')->nullable();
            $table->string('meta_type')->nullable();
            $table->string('meta_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('folders', function (Blueprint $table) {
            $table->string('file')->nullable()->change();
            $table->string('folder_name')->nullable()->change();
            $table->string('primary_folder')->nullable()->change();
            $table->string('folder_path')->nullable()->change();
            $table->string('folder_type')->nullable()->change();
            $table->string('folder_status')->nullable()->change();
            $table->string('meta_name')->nullable();
            $table->string('meta_primary')->nullable();
            $table->string('meta_type')->nullable();
            $table->string('meta_path')->nullable();
        });
    }
};
