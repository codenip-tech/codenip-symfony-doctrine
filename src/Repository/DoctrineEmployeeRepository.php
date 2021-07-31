<?php

namespace App\Repository;

use App\Entity\Employee;

class DoctrineEmployeeRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Employee::class;
    }

    /**
     * @return Employee[]
     */
    public function getAll(): array
    {
        return $this->objectRepository->findAll();
    }
}
