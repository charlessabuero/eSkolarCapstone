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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->string('barangay_ids')->nullable();
            $table->string('sponsor_ids')->nullable();
            $table->string('scholarship_organization_ids')->nullable();
            $table->string('scholarship_program_ids')->nullable();
            $table->string('college_ids')->nullable();
            $table->string('program_ids')->nullable();
            $table->string('scholar_statuses')->nullable();
            $table->unsignedBigInteger('filterable_id');
            $table->string('filterable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filters');
    }
};
