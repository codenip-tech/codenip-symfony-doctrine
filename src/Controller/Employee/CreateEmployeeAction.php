<?php

namespace App\Controller\Employee;

use App\Controller\ApiController;
use App\Http\Response\ApiResponse;
use App\Repository\DoctrineEmployeeRepository;

class CreateEmployeeAction extends ApiController
{
    public function __construct(private DoctrineEmployeeRepository $doctrineEmployeeRepository)
    {
    }

    public function __invoke(): ApiResponse
    {
        $this->doctrineEmployeeRepository->createEmployeeAndCar();

        return $this->createResponse(['status' => 'ok']);
    }
}
