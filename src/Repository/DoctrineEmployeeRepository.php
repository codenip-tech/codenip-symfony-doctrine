<?php

namespace App\Repository;

use App\Entity\Car;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

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

    public function createEmployeeAndCar(): void
    {
        $employee = new Employee('Oscar');
        $car = new Car('Ford', 'Ka', $employee);

        $this->getEntityManager()->persist($employee);
        $this->getEntityManager()->flush($employee);

        $this->getEntityManager()->persist($car);
        $this->getEntityManager()->flush($car);
    }

    public function createEmployeeAndCarWithTransaction(): void
    {
        $employee = new Employee('Oscar');
        $car = new Car('Ford', 'Ka', $employee);

        $this->getEntityManager()->transactional(function (EntityManagerInterface $entityManager) use ($employee, $car): void {
            $entityManager->persist($employee);
            $entityManager->persist($car);
            $entityManager->flush();
        });
    }
}
