<?php

namespace App\Service\User;

use App\Repository\DoctrineUserRepository;

class UpdateUserScoreService
{
    public function __construct(private DoctrineUserRepository $doctrineUserRepository)
    {
    }

    public function __invoke(): void
    {
        $this->doctrineUserRepository->updateAllWithIterable();
    }
}
