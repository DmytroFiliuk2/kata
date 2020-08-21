<?php

namespace src\Visitor;

interface VisitorInterface
{
    /**
     * @param CompanyVisitee $visitorIn
     * @return mixed
     */
    public function visitCompany(CompanyVisitee $visitorIn);

}
