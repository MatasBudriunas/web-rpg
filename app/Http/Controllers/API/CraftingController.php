<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Resources\ItemResource;
use App\Services\CraftingService;
use Exception;
use Illuminate\Http\Request;

class CraftingController
{
    private CraftingService $craftingService;

    public function __construct(CraftingService $craftingService)
    {
        $this->craftingService = $craftingService;
    }

    /**
     * @throws Exception
     */
    public function craft(Request $request): ItemResource
    {
        $userId = $request->user()->id;
        $item = $this->craftingService->craftItem($userId);

        return new ItemResource($item);
    }
}
