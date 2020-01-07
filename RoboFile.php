<?php

declare(strict_types=1);

class RoboFile extends \Robo\Tasks
{
    public function tests(): void
    {
        $this
            ->taskExec(__DIR__ . '/vendor/bin/ecs check --config ./config/ecs.yaml .')
            ->run();
    }

    public function fixStandards(): void
    {
        $this
            ->taskExec(__DIR__ . '/vendor/bin/ecs check --config ./config/ecs.yaml --fix .')
            ->run();
    }
}
