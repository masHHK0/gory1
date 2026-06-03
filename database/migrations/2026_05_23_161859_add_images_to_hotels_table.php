<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('hotels', 'images')) {
            Schema::table('hotels', function (Blueprint $table) {
                $table->text('images')->nullable()->after('description');
            });
        }
        
        if (!Schema::hasColumn('hotel_rooms', 'images')) {
            Schema::table('hotel_rooms', function (Blueprint $table) {
                $table->text('images')->nullable()->after('amenities');
            });
        }
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn('images');
        });
        
        Schema::table('hotel_rooms', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};