<?php

namespace src\Visitor;

class ReportsVisitor implements VisitorInterface
{
    private $totalSallary = 0;
    private $totalNumberOfEmployees = 0;
    private $numberOfEmployeePerDepartment = array();

    /**
     * @return int
     */
    public function totalSallaryReport(): int
    {
       return $this->totalSallary;
    }

    /**
     * @return array
     */
    public function totalNumberOfEmployeesReport(): int
    {
        return  $this->totalNumberOfEmployees;
    }

    /**
     * @return float
     */
    public function averageSalaryReport(): float
    {
        return $this->totalSallary / $this->totalNumberOfEmployees;
    }

    /**
     * @return array
     */
    public function numberOfEmployeePerDepartmentReport(): array
    {
        return  $this->numberOfEmployeePerDepartment;
    }

    /**
     * @param CompanyVisitee $company
     */
    public function visitCompany(CompanyVisitee $company): void
    {
        /**@var Employee $employee */
        foreach ($company->getEmployees() as $employee) {
            $this->totalSallary += $employee->getSalary();
            $this->totalNumberOfEmployees++;

            if (!array_key_exists($employee->getDepartment(), $this->numberOfEmployeePerDepartment)) {
                $this->numberOfEmployeePerDepartment[$employee->getDepartment()] = 0;
            }

            $this->numberOfEmployeePerDepartment[$employee->getDepartment()]++;
        }
    }
}