<?php

namespace App\Repository;

use App\Entity\Profile;

class DoctrineProfileRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Profile::class;
    }

    public function findOneById(string $id): ?Profile
    {
        return $this->objectRepository->find($id);
    }
}
