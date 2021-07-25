<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\DoctrineUserRepository;

class UpdateUserService
{
    public function __construct(private DoctrineUserRepository $doctrineUserRepository)
    {
    }

    public function __invoke(string $id, string $name): User
    {
        if (null !== $user = $this->doctrineUserRepository->findOneById($id)) {
            $user->setName($name);

            $this->doctrineUserRepository->save($user);

            return $user;
        }
    }
}
