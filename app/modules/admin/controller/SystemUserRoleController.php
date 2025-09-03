<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\system\service\SystemUserRoleBundleService;
use app\entity\SystemUserRoleEntity;
use app\modules\admin\request\systemUserRole\SystemUserRoleCreateRequest;
use app\modules\admin\request\systemUserRole\SystemUserRoleQueryRequest;
use app\modules\admin\request\systemUserRole\SystemUserRoleUpdateRequest;
use app\modules\admin\response\systemUserRole\SystemUserRoleQueryResponse;
use app\modules\admin\response\systemUserRole\SystemUserRoleResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class SystemUserRoleController extends BaseController
{
    #[OA\Post(path: '/systemUserRole/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemUserRoleQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemUserRoleQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new SystemUserRoleQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $systemUserRoleBundleService = new SystemUserRoleBundleService();
            $result = $systemUserRoleBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new SystemUserRoleResponse();
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

    #[OA\Post(path: '/systemUserRole/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemUserRoleCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemUserRoleCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemUserRoleEntity = new SystemUserRoleEntity();
            $systemUserRoleEntity->setData($request);

            $systemUserRoleBundleService = new SystemUserRoleBundleService();
            $insertId = $systemUserRoleBundleService->save($systemUserRoleEntity->toArray());
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

    #[OA\Get(path: '/systemUserRole/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemUserRoleResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemUserRoleBundleService = new SystemUserRoleBundleService();
            $systemUserRole = $systemUserRoleBundleService->getOne($condition);

            if (empty($systemUserRole)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new SystemUserRoleResponse();
            $response->setData($systemUserRole);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/systemUserRole/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemUserRoleUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemUserRoleUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemUserRoleBundleService = new SystemUserRoleBundleService();
            $systemUserRole = $systemUserRoleBundleService->getById($request['id']);
            if (empty($systemUserRole)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $systemUserRoleEntity = new SystemUserRoleEntity();
            $systemUserRoleEntity->setData($request);

            $systemUserRoleBundleService->update($systemUserRoleEntity->toArray(), [
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

    #[OA\Delete(path: '/systemUserRole/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
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

            $systemUserRoleBundleService = new SystemUserRoleBundleService();
            if ($systemUserRoleBundleService->remove($condition)) {
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
