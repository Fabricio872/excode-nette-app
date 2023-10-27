<?php

namespace App\Services;

use App\DTO\EmployeeDTO;
use Symfony\Component\Serializer\SerializerInterface;

class FileStorageService implements StorageServiceInterface
{
    const FORMAT = 'xml';
    public function __construct(
        private string $storageFile,
        private SerializerInterface $serializer
    )
    {
    }

    public function getList(): array
    {
        $data = $this->getData();
        if (!$data){
            return [];
        }
        return $this->serializer->deserialize($this->getData(), EmployeeDTO::class.'[]',self::FORMAT);
    }

    public function addEmployee(EmployeeDTO $employee): self
    {
        $employeeList = $this->getList();
        $employeeList[] = $employee;

        $this->saveList($employeeList);

        return $this;
    }

    /**
     * @param array<int, EmployeeDTO> $employeeList
     * @return void
     */
    private function saveList(array $employeeList):void
    {
        file_put_contents($this->storageFile, $this->serializer->serialize($employeeList, self::FORMAT));
    }

    private function getData():?string
    {
        if (!file_exists($this->storageFile)){
            return null;
        }
        return file_get_contents($this->storageFile);
    }
}