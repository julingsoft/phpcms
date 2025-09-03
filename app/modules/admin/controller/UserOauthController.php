<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\user\service\UserOauthBundleService;
use app\entity\UserOauthEntity;
use app\modules\admin\request\userOauth\UserOauthCreateRequest;
use app\modules\admin\request\userOauth\UserOauthQueryRequest;
use app\modules\admin\request\userOauth\UserOauthUpdateRequest;
use app\modules\admin\response\userOauth\UserOauthQueryResponse;
use app\modules\admin\response\userOauth\UserOauthResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class UserOauthController extends BaseController
{
    #[OA\Post(path: '/userOauth/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: UserOauthQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: UserOauthQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new UserOauthQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $userOauthBundleService = new UserOauthBundleService();
            $result = $userOauthBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new UserOauthResponse();
                $response->setData($item);
                $result['data'][$key] = $response->toArray();
            }

            return $this->success($result);
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('查询列表错误');
        }
    }

    #[OA\Post(path: '/userOauth/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: UserOauthCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new UserOauthCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $userOauthEntity = new UserOauthEntity();
            $userOauthEntity->setData($request);

            $userOauthBundleService = new UserOauthBundleService();
            $insertId = $userOauthBundleService->save($userOauthEntity->toArray());
            if ($insertId > 0) {
                DB::commit();

                return $this->success('新增数据成功');
            }

            throw new CustomException('新增数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('新增数据错误');
        }
    }

    #[OA\Get(path: '/userOauth/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: UserOauthResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $userOauthBundleService = new UserOauthBundleService();
            $userOauth = $userOauthBundleService->getOne($condition);

            if (empty($userOauth)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new UserOauthResponse();
            $response->setData($userOauth);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/userOauth/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: UserOauthUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new UserOauthUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $userOauthBundleService = new UserOauthBundleService();
            $userOauth = $userOauthBundleService->getById($request['id']);
            if (empty($userOauth)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $userOauthEntity = new UserOauthEntity();
            $userOauthEntity->setData($request);

            $userOauthBundleService->update($userOauthEntity->toArray(), [
                ['id', '=', $request['id']],
            ]);

            DB::commit();

            return $this->success('更新数据成功');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('更新数据错误');
        }
    }

    #[OA\Delete(path: '/userOauth/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK')]
    public function destroy(): Response
    {
        DB::startTrans();
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $userOauthBundleService = new UserOauthBundleService();
            if ($userOauthBundleService->remove($condition)) {
                DB::commit();

                return $this->success('删除数据成功');
            }

            throw new CustomException('删除数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('删除数据错误');
        }
    }
}
