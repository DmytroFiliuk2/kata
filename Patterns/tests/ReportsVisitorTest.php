<?php

use src\Visitor\CompanyVisitee;
use src\Visitor\ReportsVisitor;
use src\Visitor\Employee;
use PHPUnit\Framework\TestCase;

class ReportsVisitorTest extends TestCase
{
    public function testNumberOfEmployeePerDepartmentReport(): void
    {
        $employee = new Employee('dimas', 322, 'it');
        $employee2 = new Employee('dimas', 322, 'sell');
        $employee3 = new Employee('dimas', 322, 'marketing');

        $company = new CompanyVisitee(array($employee, $employee2, $employee3), 'GaleraSoftware');
        $reportsVisitor = new ReportsVisitor();
        $company->accept($reportsVisitor);

        $this->assertEquals(
            array(
                'marketing' => 1,
                'sell' => 1,
                'it' => 1
            ),
            $reportsVisitor->numberOfEmployeePerDepartmentReport()
        );
    }

    public function testTotalSalaryReport(): void
    {
        $employee = new Employee('dimas', 1000, 'it');
        $employee2 = new Employee('dimas', 1000, 'sell');
        $employee3 = new Employee('dimas', 1000, 'marketing');
        $employee4 = new Employee('dimas', 1000, 'marketing');

        $company = new CompanyVisitee(array($employee, $employee2, $employee3 ,$employee4), 'GaleraSoftware');
        $reportsVisitor = new ReportsVisitor();
        $company->accept($reportsVisitor);

        $this->assertEquals(4000, $reportsVisitor->totalSallaryReport());
        $this->assertEquals(1000, $reportsVisitor->averageSalaryReport());
        $this->assertEquals(4, $reportsVisitor->totalNumberOfEmployeesReport());
    }
}
