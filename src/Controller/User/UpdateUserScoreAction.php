<?php

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\UpdateUserScoreService;

class UpdateUserScoreAction extends ApiController
{
    public function __construct(private UpdateUserScoreService $updateUserScoreService)
    {
    }

    public function __invoke(): ApiResponse
    {
        $this->updateUserScoreService->__invoke();

        return $this->createResponse(['status' => 'ok']);
    }
}
