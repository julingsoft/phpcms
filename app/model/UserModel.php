<?php

declare(strict_types=1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

class UserModel extends Model
{
    /**
     * 设置表
     */
    protected $name = 'user';

    /**
     * 设置字段
     */
    protected array $field = [
        'id',
        'username',
        'password',
        'password_salt',
        'reset_token',
        'name',
        'avatar',
        'birthday',
        'motto',
        'email',
        'email_verified_time',
        'mobile',
        'mobile_verified_time',
        'remember_token',
        'last_login_ip',
        'last_login_time',
        'status',
        'create_time',
        'update_time',
        'delete_time',
    ];
}
