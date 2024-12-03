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
        Schema::create('file_finances', function (Blueprint $table) {
            $table->id();
            $table->string('fn_file');
            $table->text('fn_title');
            $table->string('fn_amount');
            $table->string('fn_type');
            $table->string('fn_filename');
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_finances');
    }
};
