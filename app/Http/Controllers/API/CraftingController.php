<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;
use App\Services\CraftingService;
use Illuminate\Http\Request;

class CraftingController
{

    private CraftingService $craftingService;

    public function __construct(CraftingService $craftingService) {
        $this->craftingService = $craftingService;
    }
    public function craft(Request $request) {
        //TODO implement crafting logic
    }
}
