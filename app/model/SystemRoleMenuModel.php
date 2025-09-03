<?php

declare(strict_types=1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

class SystemRoleMenuModel extends Model
{
    /**
     * 设置表
     */
    protected $name = 'system_role_menu';


    /**
     * 设置字段
     */
    protected $field = [
        'id',
        'create_time',
        'update_time',
        'delete_time',
    ];
}
