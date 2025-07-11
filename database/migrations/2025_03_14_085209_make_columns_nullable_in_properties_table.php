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
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->bigInteger('propertyId')->nullable()->change();
            $table->string('acquisitionStatus')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            //
            $table->bigInteger('propertyId')->nullable(false)->change();
            $table->string('acquisitionStatus')->nullable(false)->change();
        });
    }
};
