<?php


namespace Lorenzschaef\PHPDDDMD;


use PHPMD\TextUI\Command;

class NoOutwardDependenciesRuleTest extends \PHPUnit_Framework_TestCase
{

    public function testRule()
    {
        $exitCode = Command::main([
            'vendor/bin/phpmd',
            __DIR__ . '/SampleCode',
            'text',
            __DIR__ . '/../rulesets/dddrules.xml'
        ]);

        $this->assertEquals(2, $exitCode, 'The phpmd exit code should be 2');
    }

}