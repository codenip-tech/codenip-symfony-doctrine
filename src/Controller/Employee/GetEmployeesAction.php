<?php

namespace App\Controller\Employee;

use App\Controller\ApiController;
use App\Entity\Employee;
use App\Http\Response\ApiResponse;
use App\Service\Employee\GetEmployeesService;

class GetEmployeesAction extends ApiController
{
    public function __construct(private GetEmployeesService $getEmployeesService)
    {
    }

    public function __invoke(): ApiResponse
    {
        $employees = $this->getEmployeesService->__invoke();

        $result = array_map(function (Employee $employee): array {
            return $employee->toArray();
        }, $employees);

        return $this->createResponse(['employees' => $result]);
    }
}
