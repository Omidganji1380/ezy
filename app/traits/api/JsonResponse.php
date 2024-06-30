<?php

namespace App\traits\api;

use App\Responses\Errors;

trait JsonResponse
{
    public function throwError($error_code) {

        return response()->json(Errors::exception($error_code));
    }
}