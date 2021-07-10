<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UpdateUserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(string $id, string $name): User
    {
        if (null !== $user = $this->userRepository->findOneById($id)) {
            $user->setName($name);

            $this->userRepository->save($user);

            return $user;
        }
    }
}
