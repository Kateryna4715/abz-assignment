<?php

namespace App\Repositories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository {

    public function create(array $data): int
    {
        $position = new Position($data);
        $position->save();

        return $position->id;
    }

    public function getPositionById(int $positionId): Position
    {
        return Position::find($positionId);
    }

    public function getAllPositions(): Collection
    {
        return Position::all();
    }
}
