<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EquipItemRequest;
use App\Http\Resources\ItemResource;
use App\Http\Resources\PlayerResource;
use App\Repositories\ItemRepository;
use App\Services\EquipmentService;
use App\Services\MapService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;

class PlayerController extends Controller
{
    private ItemRepository $itemRepository;
    private EquipmentService $equipmentService;
    private MapService $mapService;

    public function __construct(
        ItemRepository   $itemRepository,
        EquipmentService $equipmentService,
        MapService $mapService
    )
    {
        $this->itemRepository = $itemRepository;
        $this->equipmentService = $equipmentService;
        $this->mapService = $mapService;
    }

    public function getPlayer(Request $request): PlayerResource
    {
        $user = $request->user()->load('map');

        return new PlayerResource($user);
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

    /**
     * @throws Exception
     */
    public function movePlayer(Request $request): JsonResponse
    {
        $newCoordinates = $this->mapService->movePlayer(
            (int) $request->get('coordinates_x'),
            (int) $request->get('coordinates_y'),
            (int) $request->get('map_id'),
            $request->user()
        );

        return Response()->json(['coordinates' => $newCoordinates], Response::HTTP_OK);
    }
}
