<?php

declare(strict_types=1);

namespace App\Factories;

use App\Models\Item;

interface ItemFactory
{
    public function create(array $attributes): Item;
}
