<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    public function withResponse($request, $response): void
    {
        $data = json_decode($response->getContent(), true);
        $response->setContent(json_encode($data['data']));
    }
}
