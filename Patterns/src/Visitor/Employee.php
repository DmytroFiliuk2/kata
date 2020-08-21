<?php

namespace src\Visitor;

class Employee
{
    private  $name;

    private  $salary;

    private  $department;

    /**
     * @param string $name
     * @param int $salary
     * @param string $department
     */
    public function __construct(string $name, int $salary, string $department)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }
}
