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
            $table->integer('handicap')->default(0)->after('email');
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->integer('net_score')->nullable()->after('to_par');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('handicap');
        });

        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('net_score');
        });
    }
};
