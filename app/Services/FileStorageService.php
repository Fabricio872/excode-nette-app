<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\EmployeeDTO;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;

class FileStorageService implements StorageServiceInterface
{
    final public const FORMAT = 'xml';

    public function __construct(
        private readonly string $storageFile,
        private readonly SerializerInterface $serializer
    ) {
    }

    public function getList(): array
    {
        $data = $this->getData();
        if (! $data) {
            return [];
        }
        try {
            return $this->serializer->deserialize($data, EmployeeDTO::class . '[]', self::FORMAT);
        } catch (NotNormalizableValueException) {
            return [];
        }
    }

    public function addEmployee(EmployeeDTO $employee): self
    {
        $employeeList = $this->getList();
        $employeeList[] = $employee;

        $this->saveList($employeeList);

        return $this;
    }

    public function editEmployee(int $id, EmployeeDTO $employee): StorageServiceInterface
    {
        $employeeList = $this->getList();
        $employeeList[$id] = $employee;

        $this->saveList($employeeList);

        return $this;
    }

    public function removeEmployee(int $id): StorageServiceInterface
    {
        $employeeList = $this->getList();
        unset($employeeList[$id]);

        $this->saveList($employeeList);

        return $this;
    }

    /**
     * @param array<int, EmployeeDTO> $employeeList
     * @return void
     */
    private function saveList(array $employeeList): void
    {
        file_put_contents($this->storageFile, $this->serializer->serialize($employeeList, self::FORMAT));
    }

    private function getData(): ?string
    {
        if (! file_exists($this->storageFile)) {
            return null;
        }
        return file_get_contents($this->storageFile);
    }
}
