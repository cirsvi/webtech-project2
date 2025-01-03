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
        Schema::table('paintings', function (Blueprint $table) {
            //Adding if statements because made a mistake in the first migration.
            if (!Schema::hasColumn('paintings', 'style_id')) {
                $table->unsignedBigInteger('style_id')->nullable()->after('artist_id');
                $table->foreign('style_id')->references('id')->on('styles');
            }

            if (!Schema::hasColumn('paintings', 'location_id')) {
                $table->unsignedBigInteger('location_id')->nullable()->after('style_id');
                $table->foreign('location_id')->references('id')->on('locations');
            }
        });
    }

        /**
         * Reverse the migrations.
         */
    public function down(): void
    {
        Schema::table('paintings', function (Blueprint $table) {
            if (Schema::hasColumn('paintings', 'style_id')) {
                $table->dropForeign(['style_id']);
                $table->dropColumn('style_id');
            }

            if (Schema::hasColumn('paintings', 'location_id')) {
                $table->dropForeign(['location_id']);
                $table->dropColumn('location_id');
            }
        });
    }
};
