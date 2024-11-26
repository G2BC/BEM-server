<?php

namespace App\Http\Controllers;

use App\Services\GeneralInfoResponse;
use App\Services\Contracts\GeneralInfoContract;

use Illuminate\Http\Request;

class GeneralInfoController extends Controller
{
    private GeneralInfoContract $generalInfoService;

    public function __construct(GeneralInfoContract $generalInfoService)
    {
        $this->generalInfoService = $generalInfoService;
    }

    public function getGeneralInfo()
    {
        try {
            $response = $this->generalInfoService->getGeneralInfo();
            return response()->json($response);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
