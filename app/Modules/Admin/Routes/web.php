<?php

// ==========================================================================
// Code generated by gen:route CLI tool. DO NOT EDIT.
// ==========================================================================

declare(strict_types=1);

use App\Modules\Admin\Middleware\Privilege;
use Illuminate\Support\Facades\Route;

// Route start
Route::prefix('admin')->middleware(Privilege::class)->name('admin.')->group(function () {
    // 查询列表接口
    Route::post('department/query', [\App\Modules\Admin\Controllers\DepartmentController::class, 'query']);
    // 新增接口
    Route::post('department/store', [\App\Modules\Admin\Controllers\DepartmentController::class, 'store']);
    // 获取详情接口
    Route::get('department/show', [\App\Modules\Admin\Controllers\DepartmentController::class, 'show']);
    // 更新接口
    Route::put('department/update', [\App\Modules\Admin\Controllers\DepartmentController::class, 'update']);
    // 删除接口
    Route::delete('department/destroy', [\App\Modules\Admin\Controllers\DepartmentController::class, 'destroy']);
    // 查询列表接口
    Route::post('permission/query', [\App\Modules\Admin\Controllers\PermissionController::class, 'query']);
    // 新增接口
    Route::post('permission/store', [\App\Modules\Admin\Controllers\PermissionController::class, 'store']);
    // 获取详情接口
    Route::get('permission/show', [\App\Modules\Admin\Controllers\PermissionController::class, 'show']);
    // 更新接口
    Route::put('permission/update', [\App\Modules\Admin\Controllers\PermissionController::class, 'update']);
    // 删除接口
    Route::delete('permission/destroy', [\App\Modules\Admin\Controllers\PermissionController::class, 'destroy']);
    // 查询列表接口
    Route::post('role/query', [\App\Modules\Admin\Controllers\RoleController::class, 'query']);
    // 新增接口
    Route::post('role/store', [\App\Modules\Admin\Controllers\RoleController::class, 'store']);
    // 获取详情接口
    Route::get('role/show', [\App\Modules\Admin\Controllers\RoleController::class, 'show']);
    // 更新接口
    Route::put('role/update', [\App\Modules\Admin\Controllers\RoleController::class, 'update']);
    // 删除接口
    Route::delete('role/destroy', [\App\Modules\Admin\Controllers\RoleController::class, 'destroy']);
    // 查询列表接口
    Route::post('rolePermission/query', [\App\Modules\Admin\Controllers\RolePermissionController::class, 'query']);
    // 新增接口
    Route::post('rolePermission/store', [\App\Modules\Admin\Controllers\RolePermissionController::class, 'store']);
    // 获取详情接口
    Route::get('rolePermission/show', [\App\Modules\Admin\Controllers\RolePermissionController::class, 'show']);
    // 更新接口
    Route::put('rolePermission/update', [\App\Modules\Admin\Controllers\RolePermissionController::class, 'update']);
    // 删除接口
    Route::delete('rolePermission/destroy', [\App\Modules\Admin\Controllers\RolePermissionController::class, 'destroy']);
    // 查询列表接口
    Route::post('tenant/query', [\App\Modules\Admin\Controllers\TenantController::class, 'query']);
    // 新增接口
    Route::post('tenant/store', [\App\Modules\Admin\Controllers\TenantController::class, 'store']);
    // 获取详情接口
    Route::get('tenant/show', [\App\Modules\Admin\Controllers\TenantController::class, 'show']);
    // 更新接口
    Route::put('tenant/update', [\App\Modules\Admin\Controllers\TenantController::class, 'update']);
    // 删除接口
    Route::delete('tenant/destroy', [\App\Modules\Admin\Controllers\TenantController::class, 'destroy']);
    // 查询列表接口
    Route::post('tenantUser/query', [\App\Modules\Admin\Controllers\TenantUserController::class, 'query']);
    // 新增接口
    Route::post('tenantUser/store', [\App\Modules\Admin\Controllers\TenantUserController::class, 'store']);
    // 获取详情接口
    Route::get('tenantUser/show', [\App\Modules\Admin\Controllers\TenantUserController::class, 'show']);
    // 更新接口
    Route::put('tenantUser/update', [\App\Modules\Admin\Controllers\TenantUserController::class, 'update']);
    // 删除接口
    Route::delete('tenantUser/destroy', [\App\Modules\Admin\Controllers\TenantUserController::class, 'destroy']);
    // 查询列表接口
    Route::post('user/query', [\App\Modules\Admin\Controllers\UserController::class, 'query']);
    // 新增接口
    Route::post('user/store', [\App\Modules\Admin\Controllers\UserController::class, 'store']);
    // 获取详情接口
    Route::get('user/show', [\App\Modules\Admin\Controllers\UserController::class, 'show']);
    // 更新接口
    Route::put('user/update', [\App\Modules\Admin\Controllers\UserController::class, 'update']);
    // 删除接口
    Route::delete('user/destroy', [\App\Modules\Admin\Controllers\UserController::class, 'destroy']);
    // 查询列表接口
    Route::post('userPermission/query', [\App\Modules\Admin\Controllers\UserPermissionController::class, 'query']);
    // 新增接口
    Route::post('userPermission/store', [\App\Modules\Admin\Controllers\UserPermissionController::class, 'store']);
    // 获取详情接口
    Route::get('userPermission/show', [\App\Modules\Admin\Controllers\UserPermissionController::class, 'show']);
    // 更新接口
    Route::put('userPermission/update', [\App\Modules\Admin\Controllers\UserPermissionController::class, 'update']);
    // 删除接口
    Route::delete('userPermission/destroy', [\App\Modules\Admin\Controllers\UserPermissionController::class, 'destroy']);
    // 查询列表接口
    Route::post('userRole/query', [\App\Modules\Admin\Controllers\UserRoleController::class, 'query']);
    // 新增接口
    Route::post('userRole/store', [\App\Modules\Admin\Controllers\UserRoleController::class, 'store']);
    // 获取详情接口
    Route::get('userRole/show', [\App\Modules\Admin\Controllers\UserRoleController::class, 'show']);
    // 更新接口
    Route::put('userRole/update', [\App\Modules\Admin\Controllers\UserRoleController::class, 'update']);
    // 删除接口
    Route::delete('userRole/destroy', [\App\Modules\Admin\Controllers\UserRoleController::class, 'destroy']);
});
// end
