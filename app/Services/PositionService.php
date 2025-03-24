<?php

namespace App\Services;

use App\Models\Position;
use App\Repositories\PositionRepository;
use Illuminate\Database\Eloquent\Collection;

class PositionService {

    public function __construct(protected PositionRepository $positionRepository) {}

    public function getPositionId(string $positionName): int
    {
        $position = Position::whereRaw('LOWER(name) = ?', strtolower($positionName))->first();

        if ($position) {
            return $position->id;
        }

        return $this->positionRepository->create(['name' => $positionName]);
    }

    public function getPositionById(int $positionId): Position
    {
        return $this->positionRepository->getPositionById($positionId);
    }

    public function getAllPositions(): Collection
    {
        return $this->positionRepository->getAllPositions();
    }
}
