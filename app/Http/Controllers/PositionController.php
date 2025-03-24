<?php

namespace App\Http\Controllers;

use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function __construct(protected PositionService $positionService) {}

    public function index()
    {
        $positions = $this->positionService->getAllPositions();

        return response()->json(['success' => true, 'positions' => $positions]);
    }
}
