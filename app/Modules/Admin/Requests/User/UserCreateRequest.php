<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserCreateRequest',
    required: [
        self::getName,
        self::getEmail,
        self::getEmailVerifiedAt,
        self::getPassword,
        self::getRememberToken,
    ],
    properties: [
        new OA\Property(property: self::getName, description: '', type: 'string'),
        new OA\Property(property: self::getEmail, description: '', type: 'string'),
        new OA\Property(property: self::getEmailVerifiedAt, description: '', type: 'string'),
        new OA\Property(property: self::getPassword, description: '', type: 'string'),
        new OA\Property(property: self::getRememberToken, description: '', type: 'string'),
    ]
)]
class UserCreateRequest extends FormRequest
{
    const string getName = 'name';

    const string getEmail = 'email';

    const string getEmailVerifiedAt = 'email_verified_at';

    const string getPassword = 'password';

    const string getRememberToken = 'remember_token';

    public function rules(): array
    {
        return [
            self::getName => 'require',
            self::getEmail => 'require',
            self::getEmailVerifiedAt => 'require',
            self::getPassword => 'require',
            self::getRememberToken => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getName.'.require' => '请设置',
            self::getEmail.'.require' => '请设置',
            self::getEmailVerifiedAt.'.require' => '请设置',
            self::getPassword.'.require' => '请设置',
            self::getRememberToken.'.require' => '请设置',
        ];
    }
}
