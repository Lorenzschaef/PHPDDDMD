<?php


namespace Lorenzschaef\PHPDDDMD\SampleCode\Infrastructure;


use Lorenzschaef\PHPDDDMD\SampleCode\Domain\SampleDomainObject;
use Lorenzschaef\PHPDDDMD\SampleCode\Domain\SampleRepository;

class SampleRepositoryImplementation implements SampleRepository
{

    public function find($id)
    {
        return new SampleDomainObject();
    }

}