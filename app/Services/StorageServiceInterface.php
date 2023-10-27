<?php

namespace App\Services;

use App\DTO\EmployeeDTO;

interface StorageServiceInterface
{
    /**
     * @return array<int, EmployeeDTO>
     */
    public function getList():array;

    public function addEmployee(EmployeeDTO $employee):self;
//    public function removeEmployee(EmployeeDTO $employee):self;
}