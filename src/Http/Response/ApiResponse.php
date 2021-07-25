<?php

namespace App\Http\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(array $data, int $status = JsonResponse::HTTP_OK)
    {
        parent::__construct($data, $status);
    }
}
