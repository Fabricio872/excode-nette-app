<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\EmployeeDTO;

interface StorageServiceInterface
{
    /**
     * @return array<int, EmployeeDTO>
     */
    public function getList(): array;

    public function addEmployee(EmployeeDTO $employee): self;

    public function editEmployee(int $id, EmployeeDTO $employee): self;

    public function removeEmployee(int $id): self;
}
