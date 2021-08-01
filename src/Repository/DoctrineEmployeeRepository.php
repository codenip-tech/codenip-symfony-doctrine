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

    public function removeCarFromEmployee(string $employeeId, string $carId): void
    {
        $params = [
            ':ownerId' => $this->connection->quote($employeeId),
            ':carId' => $this->connection->quote($carId),
        ];

        $query = 'DELETE FROM car WHERE id = :carId AND owner_id = :ownerId';

        $this->connection->executeQuery(strtr($query, $params));
    }
}
