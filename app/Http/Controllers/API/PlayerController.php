<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PlayerResource;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PlayerController extends Controller
{
    private ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository) {
        $this->itemRepository = $itemRepository;
    }

    public function getPlayer(Request $request): PlayerResource
    {
        return new PlayerResource($request->user());
    }

    public function getPlayerItems(Request $request): AnonymousResourceCollection
    {
        return ItemResource::collection($this->itemRepository->findGroupedItemsByUser($request->user()->id));
    }
}
