<?php

namespace src\Visitor;

interface VisiteeInterface
{
    public function accept(VisitorInterface $visitorIn);
}