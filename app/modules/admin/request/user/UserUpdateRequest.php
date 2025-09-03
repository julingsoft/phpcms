<?php

declare(strict_types=1);

namespace app\modules\admin\request\user;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'UserUpdateRequest',
    required: [
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
    ],
    properties: [
        new OA\Property(property: 'id', description: 'ID', type: 'integer'),
        new OA\Property(property: 'username', description: '登录用户名', type: 'string'),
        new OA\Property(property: 'password', description: '登录用户密码', type: 'string'),
        new OA\Property(property: 'password_salt', description: '用户密码盐值', type: 'string'),
        new OA\Property(property: 'reset_token', description: '密码重置hash', type: 'string'),
        new OA\Property(property: 'name', description: '昵称', type: 'string'),
        new OA\Property(property: 'avatar', description: '头像', type: 'string'),
        new OA\Property(property: 'birthday', description: '生日', type: 'string'),
        new OA\Property(property: 'motto', description: '座右铭', type: 'string'),
        new OA\Property(property: 'email', description: '电子邮箱', type: 'string'),
        new OA\Property(property: 'email_verified_time', description: '电子邮箱验证时间', type: 'string'),
        new OA\Property(property: 'mobile', description: '手机号码', type: 'string'),
        new OA\Property(property: 'mobile_verified_time', description: '手机号码验证时间', type: 'string'),
        new OA\Property(property: 'remember_token', description: 'Remember Token', type: 'string'),
        new OA\Property(property: 'last_login_ip', description: '最后登录IP', type: 'string'),
        new OA\Property(property: 'last_login_time', description: '最后登录时间', type: 'string'),
        new OA\Property(property: 'status', description: '状态：1正常，2禁用', type: 'integer'),
        new OA\Property(property: 'create_time', description: '', type: 'string'),
        new OA\Property(property: 'update_time', description: '', type: 'string'),
        new OA\Property(property: 'delete_time', description: '', type: 'string'),
    ]
)]
class UserUpdateRequest extends Validate
{
    protected $rule = [
        'id' => 'require',
        'username' => 'require',
        'password' => 'require',
        'password_salt' => 'require',
        'reset_token' => 'require',
        'name' => 'require',
        'avatar' => 'require',
        'birthday' => 'require',
        'motto' => 'require',
        'email' => 'require',
        'email_verified_time' => 'require',
        'mobile' => 'require',
        'mobile_verified_time' => 'require',
        'remember_token' => 'require',
        'last_login_ip' => 'require',
        'last_login_time' => 'require',
        'status' => 'require',
        'create_time' => 'require',
        'update_time' => 'require',
        'delete_time' => 'require',
    ];

    protected $message = [
        'id.require' => '请设置ID',
        'username.require' => '请设置登录用户名',
        'password.require' => '请设置登录用户密码',
        'password_salt.require' => '请设置用户密码盐值',
        'reset_token.require' => '请设置密码重置hash',
        'name.require' => '请设置昵称',
        'avatar.require' => '请设置头像',
        'birthday.require' => '请设置生日',
        'motto.require' => '请设置座右铭',
        'email.require' => '请设置电子邮箱',
        'email_verified_time.require' => '请设置电子邮箱验证时间',
        'mobile.require' => '请设置手机号码',
        'mobile_verified_time.require' => '请设置手机号码验证时间',
        'remember_token.require' => '请设置Remember Token',
        'last_login_ip.require' => '请设置最后登录IP',
        'last_login_time.require' => '请设置最后登录时间',
        'status.require' => '请设置状态：1正常，2禁用',
        'create_time.require' => '请设置',
        'update_time.require' => '请设置',
        'delete_time.require' => '请设置',
    ];
}
