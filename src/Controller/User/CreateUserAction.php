<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Service\User\CreateUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserAction extends ApiController
{
    public function __construct(private CreateUserService $createUserService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);

        $user = $this->createUserService->__invoke($data['name'], $data['email']);

        return $this->createResponse(['user' => $user->toArray()], ApiResponse::HTTP_CREATED);
    }
}
