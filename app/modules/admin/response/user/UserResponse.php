<?php

declare(strict_types=1);

namespace app\modules\admin\response\user;

use Juling\Foundation\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'UserResponse')]
class UserResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'id', description: 'ID', type: 'integer')]
    private int $id;

    #[OA\Property(property: 'username', description: '登录用户名', type: 'string')]
    private string $username;

    #[OA\Property(property: 'reset_token', description: '密码重置hash', type: 'string')]
    private string $resetToken;

    #[OA\Property(property: 'name', description: '昵称', type: 'string')]
    private string $name;

    #[OA\Property(property: 'avatar', description: '头像', type: 'string')]
    private string $avatar;

    #[OA\Property(property: 'birthday', description: '生日', type: 'string')]
    private string $birthday;

    #[OA\Property(property: 'motto', description: '座右铭', type: 'string')]
    private string $motto;

    #[OA\Property(property: 'email', description: '电子邮箱', type: 'string')]
    private string $email;

    #[OA\Property(property: 'email_verified_time', description: '电子邮箱验证时间', type: 'string')]
    private string $emailVerifiedTime;

    #[OA\Property(property: 'mobile', description: '手机号码', type: 'string')]
    private string $mobile;

    #[OA\Property(property: 'mobile_verified_time', description: '手机号码验证时间', type: 'string')]
    private string $mobileVerifiedTime;

    #[OA\Property(property: 'remember_token', description: 'Remember Token', type: 'string')]
    private string $rememberToken;

    #[OA\Property(property: 'last_login_ip', description: '最后登录IP', type: 'string')]
    private string $lastLoginIp;

    #[OA\Property(property: 'last_login_time', description: '最后登录时间', type: 'string')]
    private string $lastLoginTime;

    #[OA\Property(property: 'status', description: '状态：1正常，2禁用', type: 'integer')]
    private int $status;

    #[OA\Property(property: 'create_time', description: '', type: 'string')]
    private string $createTime;

    #[OA\Property(property: 'update_time', description: '', type: 'string')]
    private string $updateTime;

    #[OA\Property(property: 'delete_time', description: '', type: 'string')]
    private string $deleteTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    public function setResetToken(string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getMotto(): string
    {
        return $this->motto;
    }

    public function setMotto(string $motto): void
    {
        $this->motto = $motto;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmailVerifiedTime(): string
    {
        return $this->emailVerifiedTime;
    }

    public function setEmailVerifiedTime(string $emailVerifiedTime): void
    {
        $this->emailVerifiedTime = $emailVerifiedTime;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getMobileVerifiedTime(): string
    {
        return $this->mobileVerifiedTime;
    }

    public function setMobileVerifiedTime(string $mobileVerifiedTime): void
    {
        $this->mobileVerifiedTime = $mobileVerifiedTime;
    }

    public function getRememberToken(): string
    {
        return $this->rememberToken;
    }

    public function setRememberToken(string $rememberToken): void
    {
        $this->rememberToken = $rememberToken;
    }

    public function getLastLoginIp(): string
    {
        return $this->lastLoginIp;
    }

    public function setLastLoginIp(string $lastLoginIp): void
    {
        $this->lastLoginIp = $lastLoginIp;
    }

    public function getLastLoginTime(): string
    {
        return $this->lastLoginTime;
    }

    public function setLastLoginTime(string $lastLoginTime): void
    {
        $this->lastLoginTime = $lastLoginTime;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    public function setCreateTime(string $createTime): void
    {
        $this->createTime = $createTime;
    }

    public function getUpdateTime(): string
    {
        return $this->updateTime;
    }

    public function setUpdateTime(string $updateTime): void
    {
        $this->updateTime = $updateTime;
    }

    public function getDeleteTime(): string
    {
        return $this->deleteTime;
    }

    public function setDeleteTime(string $deleteTime): void
    {
        $this->deleteTime = $deleteTime;
    }
}
