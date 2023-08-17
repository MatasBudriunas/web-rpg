<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipItemRequest;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PlayerResource;
use App\Repositories\ItemRepository;
use App\Services\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlayerController extends Controller
{
    private ItemRepository $itemRepository;
    private EquipmentService $equipmentService;

    public function __construct(
        ItemRepository $itemRepository,
        EquipmentService $equipmentService
    ) {
        $this->itemRepository = $itemRepository;
        $this->equipmentService = $equipmentService;
    }

    public function getPlayer(Request $request): PlayerResource
    {
        return new PlayerResource($request->user());
    }

    public function getPlayerItems(Request $request): AnonymousResourceCollection
    {
        $items = $this->itemRepository->findGroupedItemsByUser($request->user()->id);

        return ItemResource::collection(collect($items));
    }

    public function equipItem(EquipItemRequest $request): ItemResource
    {
        $item = $this->equipmentService->equipItem($request->itemId);

        return new ItemResource($item);
    }
}
