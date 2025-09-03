<?php

declare(strict_types=1);

namespace app\middleware;

use app\consts\GlobalConst;
use Closure;
use think\Request;
use think\Response;

class RedirectIfAuthenticated
{
    /**
     * 处理请求
     */
    public function handle(Request $request, Closure $next, string $guard = GlobalConst::UserAuthName): Response
    {
        if (session('?' . $guard)) {
            if (str_contains($request->pathinfo(), 'api/') || $request->isAjax()) {
                return json([
                    'code' => 40001,
                    'message' => 'Forbidden',
                    'data' => null,
                ]);
            } else {
                $prefix = match ($guard) {
                    GlobalConst::AdminAuthName => 'admin',
                    default => 'user',
                };

                return redirect('/' . $prefix);
            }
        }

        return $next($request);
    }
}
