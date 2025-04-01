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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('birthDate')->nullable()->after('password');
            $table->string('mobileNumber')->nullable()->after('birthDate');
            $table->string('gender')->nullable()->after('mobileNumber');
            $table->string('occupation')->nullable()->after('gender');
            $table->string('identityDocument')->nullable()->after('occupation');
            $table->string('idNumber')->nullable()->after('identityDocument');
            $table->string('issueLocation')->nullable()->after('idNumber');
            $table->string('expiryDate')->nullable()->after('issueLocation');
            $table->string('countryIssued')->nullable()->after('expiryDate');
            $table->string('issueAuthority')->nullable()->after('countryIssued');
            $table->string('county')->nullable()->after('issueAuthority');
            $table->string('subCounty')->nullable()->after('county');
            $table->string('ward')->nullable()->after('subCounty');
            $table->string('postalCode')->nullable()->after('ward');
            $table->string('address')->nullable()->after('postalCode');
            $table->string('town')->nullable()->after('address');
            $table->string('propertyId')->nullable()->after('town');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn(['birthDate', 'mobileNumber', 'gender', 'occupation', 'identityDocument', 'idNumber', 'issueLocation', 'expiryDate', 'countryIssued', 'issueAuthority', 'county', 'subCounty', 'ward', 'postalCode', 'address', 'town', 'propertyId']);
        });
    }
};
