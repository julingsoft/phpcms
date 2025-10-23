<?php

use think\migration\Migrator;

class CreateUserTable extends Migrator
{
    public function change(): void
    {
        $this->table('user')
            ->addTimestamps()
            ->addSoftDelete()
            ->save();
    }
}
