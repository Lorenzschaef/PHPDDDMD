<?php


namespace Lorenzschaef\PHPDDDMD\SampleCode\Infrastructure;


use Lorenzschaef\PHPDDDMD\SampleCode\Application\SampleCommand;
use Lorenzschaef\PHPDDDMD\SampleCode\Domain\SampleRepository;

class SampleController
{

    public function sampleAction(
        SampleRepository $repository,
        SampleCommand $command
    )
    {
        // invalid call directly to the domain
        $repository->find(1);

        // valid call to an application command
        $command->execute();
    }

}