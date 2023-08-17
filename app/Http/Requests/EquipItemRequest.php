<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Repositories\ItemLogRepository;
use Illuminate\Foundation\Http\FormRequest;

class EquipItemRequest extends FormRequest
{
    protected ItemLogRepository $itemLogRepository;

    public function __construct(ItemLogRepository $itemLogRepository)
    {
        parent::__construct();
        $this->itemLogRepository = $itemLogRepository;
    }

    public function rules(): array
    {
        return [
            'itemId' => 'required|exists:item_logs,id',
        ];
    }

    public function authorize(): bool
    {
        $itemLog = $this->itemLogRepository->find($this->itemId);

        return $itemLog && $itemLog->user_id === $this->user()->id;
    }
}
