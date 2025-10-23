<?php

declare(strict_types=1);

namespace app\bundles\user\entity;

use Juling\Foundation\Support\ArrayHelper;

class UserEntity
{
    use ArrayHelper;

    const string getId = 'id'; // 用户ID

    const string getEmail = 'email'; // 电子邮箱

    const string getUserName = 'user_name'; // 用户名

    const string getPassword = 'password'; // 登录密码

    const string getQuestion = 'question'; // 安全问题

    const string getAnswer = 'answer'; // 安全问题答案

    const string getSex = 'sex'; // 性别(0未知 1男 2女)

    const string getBirthday = 'birthday'; // 生日

    const string getUserMoney = 'user_money'; // 用户资金

    const string getFrozenMoney = 'frozen_money'; // 冻结资金

    const string getPayPoints = 'pay_points'; // 消费积分

    const string getRankPoints = 'rank_points'; // 等级积分

    const string getAddressId = 'address_id'; // 默认地址ID

    const string getRegTime = 'reg_time'; // 注册时间戳

    const string getLastLogin = 'last_login'; // 最后登录时间戳

    const string getLastTime = 'last_time'; // 最后活动时间

    const string getLastIp = 'last_ip'; // 最后登录IP

    const string getVisitCount = 'visit_count'; // 访问次数

    const string getUserRank = 'user_rank'; // 用户等级

    const string getIsSpecial = 'is_special'; // 是否特殊用户

    const string getEcSalt = 'ec_salt'; // 加密盐值

    const string getSalt = 'salt'; // 密码盐值

    const string getParentId = 'parent_id'; // 推荐人ID

    const string getFlag = 'flag'; // 用户标记

    const string getAlias = 'alias'; // 昵称

    const string getMsn = 'msn'; // MSN账号

    const string getQq = 'qq'; // QQ号码

    const string getOfficePhone = 'office_phone'; // 办公电话

    const string getHomePhone = 'home_phone'; // 家庭电话

    const string getMobilePhone = 'mobile_phone'; // 手机号码

    const string getIsValidated = 'is_validated'; // 是否已验证

    const string getCreditLine = 'credit_line'; // 信用额度

    const string getPasswdQuestion = 'passwd_question'; // 密码提示问题

    const string getPasswdAnswer = 'passwd_answer'; // 密码提示答案

    const string getCreatedTime = 'created_time'; // 创建时间

    const string getUpdatedTime = 'updated_time'; // 更新时间

    const string getDeletedTime = 'deleted_time'; // 删除时间

    private int $id;

    private string $email;

    private string $userName;

    private string $password;

    private string $question;

    private string $answer;

    private int $sex;

    private string $birthday;

    private float $userMoney;

    private float $frozenMoney;

    private int $payPoints;

    private int $rankPoints;

    private int $addressId;

    private int $regTime;

    private int $lastLogin;

    private string $lastTime;

    private string $lastIp;

    private int $visitCount;

    private int $userRank;

    private int $isSpecial;

    private string $ecSalt;

    private string $salt;

    private int $parentId;

    private int $flag;

    private string $alias;

    private string $msn;

    private string $qq;

    private string $officePhone;

    private string $homePhone;

    private string $mobilePhone;

    private int $isValidated;

    private float $creditLine;

    private string $passwdQuestion;

    private string $passwdAnswer;

    private string $createdTime;

    private string $updatedTime;

    private string $deletedTime;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function getSex(): int
    {
        return $this->sex;
    }

    public function setSex(int $sex): void
    {
        $this->sex = $sex;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getUserMoney(): float
    {
        return $this->userMoney;
    }

    public function setUserMoney(float $userMoney): void
    {
        $this->userMoney = $userMoney;
    }

    public function getFrozenMoney(): float
    {
        return $this->frozenMoney;
    }

    public function setFrozenMoney(float $frozenMoney): void
    {
        $this->frozenMoney = $frozenMoney;
    }

    public function getPayPoints(): int
    {
        return $this->payPoints;
    }

    public function setPayPoints(int $payPoints): void
    {
        $this->payPoints = $payPoints;
    }

    public function getRankPoints(): int
    {
        return $this->rankPoints;
    }

    public function setRankPoints(int $rankPoints): void
    {
        $this->rankPoints = $rankPoints;
    }

    public function getAddressId(): int
    {
        return $this->addressId;
    }

    public function setAddressId(int $addressId): void
    {
        $this->addressId = $addressId;
    }

    public function getRegTime(): int
    {
        return $this->regTime;
    }

    public function setRegTime(int $regTime): void
    {
        $this->regTime = $regTime;
    }

    public function getLastLogin(): int
    {
        return $this->lastLogin;
    }

    public function setLastLogin(int $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }

    public function getLastTime(): string
    {
        return $this->lastTime;
    }

    public function setLastTime(string $lastTime): void
    {
        $this->lastTime = $lastTime;
    }

    public function getLastIp(): string
    {
        return $this->lastIp;
    }

    public function setLastIp(string $lastIp): void
    {
        $this->lastIp = $lastIp;
    }

    public function getVisitCount(): int
    {
        return $this->visitCount;
    }

    public function setVisitCount(int $visitCount): void
    {
        $this->visitCount = $visitCount;
    }

    public function getUserRank(): int
    {
        return $this->userRank;
    }

    public function setUserRank(int $userRank): void
    {
        $this->userRank = $userRank;
    }

    public function getIsSpecial(): int
    {
        return $this->isSpecial;
    }

    public function setIsSpecial(int $isSpecial): void
    {
        $this->isSpecial = $isSpecial;
    }

    public function getEcSalt(): string
    {
        return $this->ecSalt;
    }

    public function setEcSalt(string $ecSalt): void
    {
        $this->ecSalt = $ecSalt;
    }

    public function getSalt(): string
    {
        return $this->salt;
    }

    public function setSalt(string $salt): void
    {
        $this->salt = $salt;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function getFlag(): int
    {
        return $this->flag;
    }

    public function setFlag(int $flag): void
    {
        $this->flag = $flag;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): void
    {
        $this->alias = $alias;
    }

    public function getMsn(): string
    {
        return $this->msn;
    }

    public function setMsn(string $msn): void
    {
        $this->msn = $msn;
    }

    public function getQq(): string
    {
        return $this->qq;
    }

    public function setQq(string $qq): void
    {
        $this->qq = $qq;
    }

    public function getOfficePhone(): string
    {
        return $this->officePhone;
    }

    public function setOfficePhone(string $officePhone): void
    {
        $this->officePhone = $officePhone;
    }

    public function getHomePhone(): string
    {
        return $this->homePhone;
    }

    public function setHomePhone(string $homePhone): void
    {
        $this->homePhone = $homePhone;
    }

    public function getMobilePhone(): string
    {
        return $this->mobilePhone;
    }

    public function setMobilePhone(string $mobilePhone): void
    {
        $this->mobilePhone = $mobilePhone;
    }

    public function getIsValidated(): int
    {
        return $this->isValidated;
    }

    public function setIsValidated(int $isValidated): void
    {
        $this->isValidated = $isValidated;
    }

    public function getCreditLine(): float
    {
        return $this->creditLine;
    }

    public function setCreditLine(float $creditLine): void
    {
        $this->creditLine = $creditLine;
    }

    public function getPasswdQuestion(): string
    {
        return $this->passwdQuestion;
    }

    public function setPasswdQuestion(string $passwdQuestion): void
    {
        $this->passwdQuestion = $passwdQuestion;
    }

    public function getPasswdAnswer(): string
    {
        return $this->passwdAnswer;
    }

    public function setPasswdAnswer(string $passwdAnswer): void
    {
        $this->passwdAnswer = $passwdAnswer;
    }

    public function getCreatedTime(): string
    {
        return $this->createdTime;
    }

    public function setCreatedTime(string $createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    public function getUpdatedTime(): string
    {
        return $this->updatedTime;
    }

    public function setUpdatedTime(string $updatedTime): void
    {
        $this->updatedTime = $updatedTime;
    }

    public function getDeletedTime(): string
    {
        return $this->deletedTime;
    }

    public function setDeletedTime(string $deletedTime): void
    {
        $this->deletedTime = $deletedTime;
    }
}
