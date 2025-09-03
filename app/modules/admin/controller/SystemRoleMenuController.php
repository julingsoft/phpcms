<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\system\service\SystemRoleMenuBundleService;
use app\entity\SystemRoleMenuEntity;
use app\modules\admin\request\systemRoleMenu\SystemRoleMenuCreateRequest;
use app\modules\admin\request\systemRoleMenu\SystemRoleMenuQueryRequest;
use app\modules\admin\request\systemRoleMenu\SystemRoleMenuUpdateRequest;
use app\modules\admin\response\systemRoleMenu\SystemRoleMenuQueryResponse;
use app\modules\admin\response\systemRoleMenu\SystemRoleMenuResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class SystemRoleMenuController extends BaseController
{
    #[OA\Post(path: '/systemRoleMenu/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleMenuQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRoleMenuQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new SystemRoleMenuQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $systemRoleMenuBundleService = new SystemRoleMenuBundleService();
            $result = $systemRoleMenuBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new SystemRoleMenuResponse();
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

    #[OA\Post(path: '/systemRoleMenu/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleMenuCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRoleMenuCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRoleMenuEntity = new SystemRoleMenuEntity();
            $systemRoleMenuEntity->setData($request);

            $systemRoleMenuBundleService = new SystemRoleMenuBundleService();
            $insertId = $systemRoleMenuBundleService->save($systemRoleMenuEntity->toArray());
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

    #[OA\Get(path: '/systemRoleMenu/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRoleMenuResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemRoleMenuBundleService = new SystemRoleMenuBundleService();
            $systemRoleMenu = $systemRoleMenuBundleService->getOne($condition);

            if (empty($systemRoleMenu)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new SystemRoleMenuResponse();
            $response->setData($systemRoleMenu);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/systemRoleMenu/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRoleMenuUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRoleMenuUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRoleMenuBundleService = new SystemRoleMenuBundleService();
            $systemRoleMenu = $systemRoleMenuBundleService->getById($request['id']);
            if (empty($systemRoleMenu)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $systemRoleMenuEntity = new SystemRoleMenuEntity();
            $systemRoleMenuEntity->setData($request);

            $systemRoleMenuBundleService->update($systemRoleMenuEntity->toArray(), [
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

    #[OA\Delete(path: '/systemRoleMenu/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
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

            $systemRoleMenuBundleService = new SystemRoleMenuBundleService();
            if ($systemRoleMenuBundleService->remove($condition)) {
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
