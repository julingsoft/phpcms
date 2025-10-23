<?php

declare(strict_types=1);

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class Hello extends Command
{
    protected function configure(): void
    {
        $this->setName('hello')
            ->setDescription('the hello command');
    }

    protected function execute(Input $input, Output $output): void
    {
        $output->writeln('hello');
    }
}
