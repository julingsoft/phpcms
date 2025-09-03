<?php

declare(strict_types=1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

class UserOauthModel extends Model
{
    /**
     * 设置表
     */
    protected $name = 'user_oauth';


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
