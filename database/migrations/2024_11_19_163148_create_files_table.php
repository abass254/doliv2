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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('1');
            $table->string('file_type')->nullable();
            $table->string('file_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('tort')->nullable();
            $table->string('date_of_loss')->nullable();
            $table->string('opened')->nullable();
            $table->string('claim_no')->nullable();
            $table->string('policy_no')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_phone_no')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('drivers_license')->nullable();
            $table->string('ins_company')->nullable();
            $table->string('ins_address')->nullable();
            $table->string('adj_name')->nullable();
            $table->string('adj_phone_no')->nullable();
            $table->string('adj_fax_no')->nullable();
            $table->string('family_doctor')->nullable();
            $table->string('doctor_address')->nullable();
            $table->string('doctor_phone_no')->nullable();
            $table->string('doc_fax_no')->nullable();
            $table->string('rehab')->nullable();
            $table->string('rehab_phone_no')->nullable();
            $table->string('rehab_fax_no')->nullable();
            $table->string('assessment_center')->nullable();
            $table->string('assessment_fax_no')->nullable();
            $table->string('ohip_no')->nullable();
            $table->string('sin_no')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
