<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('theatres', function (Blueprint $table) {
$table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade')->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('theatres', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};

