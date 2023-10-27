<?php

namespace Services;

use App\DTO\EmployeeDTO;
use App\Services\FileStorageService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FileStorageServiceTest extends TestCase
{
    const STORAGE_FILE = '/app/test.xml';

    public function setUp(): void
    {
        unlink(self::STORAGE_FILE);
    }

    public function testEmptyEmployeeList()
    {
        $storageService = $this->getFileStorage();

        $this->assertEmpty($storageService->getList());
    }

    public function testSaveEmployeeToEmployeeList()
    {
        $storageService = $this->getFileStorage();

        $storageService->addEmployee((new EmployeeDTO())
            ->setName('testName')
            ->setSex('testSex')
            ->setAge(69)
        );

        $this->assertNotEmpty($storageService->getList());
    }

    public function testLoadEmployeeFromEmployeeList()
    {
        $storageService = $this->getFileStorage();

        $storageService->addEmployee((new EmployeeDTO())
            ->setName('testName')
            ->setSex('testSex')
            ->setAge(69)
        );

        $loadedEmployee = $storageService->getList()[0];

        $this->assertNotEmpty($storageService->getList());
        $this->assertEquals('testName', $loadedEmployee->getName());
        $this->assertEquals('testSex', $loadedEmployee->getSex());
        $this->assertEquals(69, $loadedEmployee->getAge());
    }

    private function getFileStorage():FileStorageService
    {
        return new FileStorageService(
            self::STORAGE_FILE,
            new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new XmlEncoder()])
        );
    }
}
