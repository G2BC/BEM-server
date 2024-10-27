<?php

namespace App\Services\Contracts;

use App\Http\Responses\GeneralInfoResponse;


interface GeneralInfoContract
{
    public function getGeneralInfo(): GeneralInfoResponse;
}
