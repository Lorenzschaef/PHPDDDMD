<?php


namespace Lorenzschaef\PHPDDDMD\SampleCode\Application;


use Lorenzschaef\PHPDDDMD\SampleCode\Domain\SampleRepository;
use Lorenzschaef\PHPDDDMD\SampleCode\Infrastructure\SampleRepositoryImplementation;

class SampleCommand
{

    /**
     * @var SampleRepository
     */
    private $repository;
    /**
     * @var SampleRepositoryImplementation
     */
    private $implementation;

    public function __construct(
        SampleRepository $repository,
        SampleRepositoryImplementation $implementation
    )
    {
        $this->repository = $repository;
        $this->implementation = $implementation;
    }

    public function execute()
    {
        // valid call from application to domain
        $this->repository->find(0);

        // invalid call to the concrete repository which is part of the infrastructure
        $this->implementation->find(0);
    }

}