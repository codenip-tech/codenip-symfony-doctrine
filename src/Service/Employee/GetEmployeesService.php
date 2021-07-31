<?php

namespace App\Service\Employee;

use App\Repository\DoctrineEmployeeRepository;

class GetEmployeesService
{
    public function __construct(private DoctrineEmployeeRepository $doctrineEmployeeRepository)
    {
    }

    public function __invoke(): array
    {
        return $this->doctrineEmployeeRepository->getAll();
    }
}
