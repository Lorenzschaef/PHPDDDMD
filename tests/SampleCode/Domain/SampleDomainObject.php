<?php


namespace Lorenzschaef\PHPDDDMD\SampleCode\Domain;


use Lorenzschaef\PHPDDDMD\SampleCode\Infrastructure\SampleController;
use Lorenzschaef\PHPDDDMD\SampleCode\NonDDDClass;

class SampleDomainObject
{

    public function setSomething(SampleRepository $thing)
    {
        // illegal reference to infrastructure
        $x = new SampleController();

        // reference to class without layer is legal
        $y = new NonDDDClass();
    }

}