<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GetUserByIdService
{
    public function __construct(private DoctrineUserRepository $doctrineUserRepository)
    {
    }

    public function __invoke(string $id): User
    {
        if (null === $user = $this->doctrineUserRepository->findOneById($id)) {
            throw new NotFoundHttpException(sprintf('User with id %s not found', $id));
        }

        return $user;
    }
}
