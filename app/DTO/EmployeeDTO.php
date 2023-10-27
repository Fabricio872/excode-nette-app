<?php

namespace App\DTO;

class EmployeeDTO
{
    public string $name;
    public string $sex;
    public string $age;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): EmployeeDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getSex(): string
    {
        return $this->sex;
    }

    public function setSex(string $sex): EmployeeDTO
    {
        $this->sex = $sex;
        return $this;
    }

    public function getAge(): string
    {
        return $this->age;
    }

    public function setAge(string $age): EmployeeDTO
    {
        $this->age = $age;
        return $this;
    }
}
