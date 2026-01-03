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
        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type')->default('weekly');
            $table->string('format')->default('stroke_play');
            $table->string('status')->default('upcoming');
            $table->decimal('registration_fee', 8, 2)->nullable();
            $table->dateTime('registration_starts_at')->nullable();
            $table->dateTime('registration_ends_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['course_id']);
            $table->dropColumn([
                'course_id',
                'type',
                'format',
                'status',
                'registration_fee',
                'registration_starts_at',
                'registration_ends_at'
            ]);
        });
    }
};