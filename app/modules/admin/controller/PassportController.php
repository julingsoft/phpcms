<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\consts\GlobalConst;
use Juling\Foundation\Exception\CustomException;
use app\middleware\RedirectIfAuthenticated;
use app\modules\admin\request\passport\ForgetRequest;
use app\modules\admin\request\passport\LoginRequest;
use app\modules\admin\request\passport\ResetRequest;
use Juling\Foundation\Routing\Controller;
use think\exception\ValidateException;
use think\facade\Config;
use think\facade\Log;
use think\Request;
use think\response\Json;
use think\response\Redirect;
use think\response\View;
use Throwable;

class PassportController extends Controller
{
    protected array $middleware = [
        [RedirectIfAuthenticated::class, [GlobalConst::AdminAuthName]],
    ];

    protected function initialize(): void
    {
        Config::set([
            'view_path' => dirname(__DIR__) . '/view/',
        ], 'view');
    }

    public function index(): Redirect
    {
        return redirect('passport/login');
    }

    public function login(Request $request): Json|View
    {
        if ($request->isAjax()) {
            try {
                $formData = $request->post();

                $v = new LoginRequest();
                if (! $v->check($formData)) {
                    throw new CustomException($v->getError());
                }

                $loginInput = new LoginInput();
                $loginInput->setUsername($formData['username']);
                $loginInput->setPassword($formData['password']);
                $loginInput->setRememberMe($formData['remember'] === 'on');

                $loginBundleService = new LoginBundleService();
                if ($loginBundleService->login($loginInput)) {
                    return $this->success('ok');
                }

                throw new CustomException('登录失败');
            } catch (Throwable $e) {
                Log::error($e);

                if ($e instanceof CustomException || $e instanceof ValidateException) {
                    return $this->error($e->getMessage());
                }

                return $this->error('请求错误，请稍后再试。');
            }
        }

        $callback = $request->get('callback', '/');

        return view('login', ['callback' => urldecode($callback)]);
    }

    public function forget(Request $request): Json|View
    {
        if ($request->isAjax()) {
            try {
                $formData = $request->post();

                $v = new ForgetRequest();
                if (! $v->check($formData)) {
                    throw new CustomException($v->getError());
                }

                return $this->success('data');
            } catch (Throwable $e) {
                Log::error($e);

                if ($e instanceof CustomException || $e instanceof ValidateException) {
                    return $this->error($e->getMessage());
                }

                return $this->error('请求错误，请稍后再试。');
            }
        }

        return view('forget');
    }

    public function reset(Request $request): Json|View
    {
        if ($request->isAjax()) {
            try {
                $formData = $request->post();

                $v = new ResetRequest();
                if (! $v->check($formData)) {
                    throw new CustomException($v->getError());
                }

                return $this->success('data');
            } catch (Throwable $e) {
                Log::error($e);

                if ($e instanceof CustomException || $e instanceof ValidateException) {
                    return $this->error($e->getMessage());
                }

                return $this->error('请求错误，请稍后再试。');
            }
        }

        $token = $request->get('token');

        // todo check

        return view('reset');
    }
}
