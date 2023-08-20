<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MapSeeder extends Seeder
{
    private int $currentXOffset = 0;
    private int $currentYOffset = 0;

    public function run(): void
    {
        $mainTownMapId = DB::table('maps')->insertGetId([
            'name' => 'Main Town',
            'width' => 5,
            'height' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->createTiles($mainTownMapId, false, 5, 5);

        $this->currentXOffset += 5;

        $startingZoneMapId = DB::table('maps')->insertGetId([
            'name' => 'Starting Zone',
            'width' => 5,
            'height' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->createTiles($startingZoneMapId, true, 5, 5);
    }

    private function createTiles($mapId, $encountersEnabled, $sizeX, $sizeY): void
    {
        for ($x = 0; $x < $sizeX; $x++) {
            for ($y = 0; $y < $sizeY; $y++) {
                $globalX = $x + $this->currentXOffset;
                $globalY = $y + $this->currentYOffset;

                DB::table('tiles')->insert([
                    'map_id' => $mapId,
                    'coordinates_x' => $globalX,
                    'coordinates_y' => $globalY,
                    'type' => 'plain',
                    'is_passable' => true,
                    'encounters_enabled' => $encountersEnabled,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
