<?php

declare(strict_types=1);

use Robo\Result;

class RoboFile extends \Robo\Tasks
{
    public function tests(): void
    {
        $this->stopIfNotSuccessful(
            $this
                ->taskExec(__DIR__ . '/vendor/bin/ecs check --config ./config/ecs.yaml .')
                ->run()
        );

        $this->stopIfNotSuccessful(
            $this
                ->taskExec(__DIR__ . '/vendor/bin/phpstan analyse --level=8 src tests examples')
                ->run()
        );

        $this->stopIfNotSuccessful(
            $this
                ->taskPhpUnit(__DIR__ . '/vendor/bin/phpunit')
                ->file(__DIR__ . '/tests')
                ->run()
        );
    }

    public function fixStandards(): void
    {
        $this
            ->taskExec(__DIR__ . '/vendor/bin/ecs check --config ./config/ecs.yaml --fix .')
            ->run();
    }

    private function stopIfNotSuccessful(Result $result): void
    {
        if ($result->wasSuccessful() === false) {
            exit($result->getExitCode());
        }
    }
}
