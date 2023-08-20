<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id')->nullable()->after('speed');
            $table->foreign('map_id')->references('id')->on('maps');
            $table->integer('coordinates_x')->nullable()->after('map_id');
            $table->integer('coordinates_y')->nullable()->after('coordinates_x');
        });
    }
        public function down(): void
        {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['map_id']);
            $table->dropColumn(['map_id', 'coordinates_x', 'coordinates_y']);
        });
    }
};
