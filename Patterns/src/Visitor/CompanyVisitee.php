<?php

namespace src\Visitor;

class CompanyVisitee implements VisiteeInterface
{
    private  $companyName;
    private  $employees;

    /**
     * @param array<Employee> $employees
     * @param string $companyName
     */
    public function __construct(array $employees, string $companyName)
    {
        $this->employees = $employees;
        $this->companyName = $companyName;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return array
     */
    public function getEmployees(): array
    {
        return $this->employees;
    }

    /**
     * @param VisitorInterface $visitorIn
     */
    public function accept(VisitorInterface $visitorIn)
    {
        $visitorIn->visitCompany($this);
    }
}
