<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Customers;

use App\Http\Resources\Api\V1\CustomerResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
    public function __invoke() : JsonResponse
    {
        $customers = DB::table('customers')->paginate(2);

        return response()->json([
            "status" => true,
            "data" => CustomerResource::collection($customers),
            "errors" => "",
            "message" => ""
        ]);
    }
}
