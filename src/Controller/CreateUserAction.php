<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\CreateUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserAction
{
    public function __construct(private CreateUserService $createUserService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $data = \json_decode($request->getContent(), true);

        $user = $this->createUserService->__invoke($data['name'], $data['email']);

        return new JsonResponse(
            [
                'user' => [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'createdOn' => $user->getCreatedOn()->format(\DateTime::RFC3339),
                ],
            ],
            JsonResponse::HTTP_CREATED
        );
    }
}
