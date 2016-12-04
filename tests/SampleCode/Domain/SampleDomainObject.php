<?php


namespace Lorenzschaef\PHPDDDMD\SampleCode\Domain;


use Lorenzschaef\PHPDDDMD\SampleCode\Infrastructure\SampleController;

class SampleDomainObject
{

    public function setSomething(SampleRepository $thing)
    {
        $x = new SampleController();
    }

}