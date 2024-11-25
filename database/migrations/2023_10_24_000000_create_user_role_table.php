<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tenant_id')->default(0)->comment('租户ID');
            $table->unsignedInteger('user_id')->nullable(false)->comment('用户ID');
            $table->unsignedInteger('role_id')->nullable(false)->comment('角色ID');
            $table->unique(['user_id', 'role_id'], 'user_role_unique');
            $table->comment('用户角色表');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_role');
    }
};
