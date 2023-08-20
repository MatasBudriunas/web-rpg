<?php

declare(strict_types=1);

use Database\Seeders\MapSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('width');
            $table->integer('height');
            $table->timestamps();
        });

        Schema::create('tiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('map_id')->constrained('maps')->cascadeOnDelete();
            $table->integer('coordinates_x');
            $table->integer('coordinates_y');
            $table->string('type');
            $table->boolean('is_passable');
            $table->boolean('encounters_enabled');
            $table->string('special_feature_type')->nullable();
            $table->string('special_feature_data')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => MapSeeder::class,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('tiles');
        Schema::dropIfExists('maps');
    }
};
